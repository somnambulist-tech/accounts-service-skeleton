<?php declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\Types;

use App\Users\Domain\Models\UserName;

/**
 * Class UserNameType
 *
 * @package    App\Users\Infrastructure\Persistence\Types
 * @subpackage App\Users\Infrastructure\Persistence\Types\UserNameType
 */
class UserNameType extends AbstractNameType
{

    protected string $name = 'user_name';
    protected string $class = UserName::class;
}
