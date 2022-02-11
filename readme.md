# Accounts Service Skeleton

Provides a skeleton project for an Accounts microservice. This service provides:

 * Symfony 6 application running under [PHP-PM](https://github.com/php-pm/php-pm)
 * Accounts model
 * User model
 * Roles and Permissions
 * Docker containers and Traefik mappings
 * [SyncIt](https://github.com/somnambulist-tech/sync-it) configuration
 
This project is intended to be used as a starting point for your User / Account service.
You should modify it to suit your needs. See later for the domain model.

## Exposed Services

 * http://accounts.example.dev/

## Getting Started / Usage

Create a new repository using this one as a template (one-click via GitHub), or download the files and
create a new project.

Edit at least:

 * .env
 * docker-compose.yml
 
Be sure to set your domain details and the container project name.

Optionally: change the root namespace to something else.

In the data-services project be sure to add a database service for the `accounts` database that this
service needs for storage:

```yaml
services:
  db-accounts:
    build:
      context: .
      dockerfile: config/docker/postgres/Dockerfile
    environment:
      POSTGRES_DB: accounts
      POSTGRES_USER: mycompany
      POSTGRES_PASSWORD: secret
    volumes:
      - accounts_db:/var/lib/postgresql/data
    ports:
      - "54321:5432"
    networks:
      - backend

volumes:
  accounts_db:
    name: mycompany_volumes_accounts-db
```

Restart data-services to bring up the storage and then start the services: `docker-compose up`. The
containers will be built and started. If all goes to plan; the database migrations will be run and
then the services should be available shortly afterwards.

The api will be available at: `https://accounts.example.dev` or whatever domain you set.

### API End Points

All end points are versioned via the URL. Whenever possible backwards compatibility will be maintained.

Any error should be returned as a JSON response with an appropriate header:

 * 200 - OK
 * 400 - invalid arguments to the end point e.g.: invalid UUID string
 * 404 - requested entity was not found (e.g.: listing)
 * 500 - internal error, details in error message

When in debug mode, the error response will contain debug information including the stack trace from
the error (if any). This should be passed to the backend devs to debug what went wrong.

### Debugging Information

The following are only available when running in debug mode:

 * X-Debug-Token - Symfony Profiler debug token for the request
 * X-Debug-Token-Link - a link to access the profiler data 

## Domain Structure

There are two main domain concepts:

 * Account
 * User
 
### Account

An Account acts as a group for multiple users. It could be extended to include sub-accounts, or
subscription data etc.

### User

The User belongs to an Account and represents a subject that can be authenticated and authorised
while using any domain service.

The following rules apply to the User:

 * A User must have an email address, name and password
 * A user must belong to an account
 * A User can have one or more Roles
 * A User can have specific permissions.
 * A Role can be granted permissions that the User will inherit.

What the permissions are and how these relate to Roles is up to the service implementing the authorisation
logic.

Similarly: this service does not provide password hashing - all passwords are expected to be hashed and
sent hashed to the service. It is recommended to use at least bcrypt with a work factor of 14 at a minimum,
or use a more modern hashing algorithm (e.g.: Argon2).

The Role is implemented as an aggregate root, however in this implementation it does not raise events.

A Role can have related Roles that it is capable of granting. By default the "root" Role is allowed to
grant all other Roles.

The following Roles are created automatically:

 * User - a standard User (all Users that will log in should receive this Role)
 * Root - the master role that can perform any action (like Unix root)
 * Admin - a lower privilege role for performing admin actions
 * Switch User - a role inherited from Symfony to indicate a User that can impersonate another user

Any number of Roles can be added. One suggestion is to have a role per business activity, and another
for API users etc etc.

__Note:__ this accounts service should not be confused with a Customer service. It is more geared for
Users of an administration system; however it can be readily adapted to other situations. 

### Interacting with the Domain

All domain changes are made through Commands dispatched through the command bus. These may or may not
raise domain events. Any events are broadcast to a domain_events queue. Commands manipulate the main
domain models to create changes. All changes are "valid" i.e.: you cannot put the domain into an
invalid state through normal usage. State is enforced by type checks and assertions or other logic.

Querying the domain is performed via Queries, dispatched to the query bus. A query will return a "view"
or other data structure of the current domain representation. It does _not_ return the raw domain objects.
Any returned data is a read-only model that cannot impact on the state of the domain. Generally view models
are returned that are light-weight active-record'ish models that look a little like the domain objects
except that they have accessor and can have additional attribute mutators to be able to create view
specific output.

View models use the Doctrine Type casting sub-system along with custom type casters allowing complex
objects to be hydrated as needed, or completely different structures if required. See the docs for
[read-models](https://github.com/somnambulist-tech/read-models) and the [attribute-model](https://github.com/somnambulist-tech/attribute-model)

Background jobs can be dispatched via the job queue.

## Tests

Tests are included for all models and API end points used in this service. The tests can be run both
locally and in the docker context. For docker, run `bin/dc-phpunit`. All tests should pass. No fixture
data is needed before running the tests as the tests will run the necessary fixtures.

For local test running; you must create a `.env.test.local` and set the URLs for: database, rabbit,
syslog and redis before the tests will run.
