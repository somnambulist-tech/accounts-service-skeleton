<?php declare(strict_types=1);

namespace App\Tests\Support\Fixtures;

use App\Tests\Support\Behaviours\UseObjectFactoryHelper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class AccountFixture
 *
 * @package    App\Tests\Support\Fixtures
 * @subpackage App\Tests\Support\Fixtures\AccountFixture
 */
class AccountFixture extends Fixture
{
    use UseObjectFactoryHelper;

    public function load(ObjectManager $manager)
    {
        $account = $this->factory->account->account();
        $manager->persist($account);

        $manager->flush();
    }
}
