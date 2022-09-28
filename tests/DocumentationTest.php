<?php declare(strict_types=1);

namespace App\Tests;

use App\Tests\Support\Behaviours\BootTestClient;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @group docs
 */
class DocumentationTest extends WebTestCase
{
    use BootTestClient;

    public function testCanActivate(): void
    {
        $dom = $this->__kernelBrowserClient->request('GET', '/docs');
        $res = $this->__kernelBrowserClient->getResponse();

        $this->assertResponseIsSuccessful();
        $this->assertStringContainsString('<script id="openapi-data" type="application/json">{"openapi":"3.0.3","info":{"title":"Accounts Service","version":"1.0.0","description":"API documentation for the accounts service."}', $res->getContent());
        // @todo add other tests and maybe look into Panther to test that the docs are valid
    }
}
