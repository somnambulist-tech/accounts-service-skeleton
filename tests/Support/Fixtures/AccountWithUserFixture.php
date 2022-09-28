<?php declare(strict_types=1);

namespace App\Tests\Support\Fixtures;

use App\Tests\Support\Behaviours\UseObjectFactoryHelper;
use App\Users\Domain\Models\AccountId;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Somnambulist\Components\Domain\Entities\Types\Identity\EmailAddress;

class AccountWithUserFixture extends Fixture
{
    use UseObjectFactoryHelper;

    public function load(ObjectManager $manager)
    {
        for ($i=0; $i<2; $i++) {
            $account = $this->factory()->account->account();
            $manager->persist($account);

            $user = $this->factory()->user->user(
                $id = new AccountId($account->id()->toString()),
                new EmailAddress($this->factory()->faker()->email),
                $this->factory()->user->password()
            );
            $manager->persist($user);

            $user = $this->factory()->user->user(
                $id,
                new EmailAddress($this->factory()->faker()->email),
                $this->factory()->user->password()
            );
            $manager->persist($user);
        }

        $manager->flush();
    }
}
