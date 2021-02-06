<?php declare(strict_types=1);

namespace App\Users\Domain\Models;

use Assert\Assert;
use Somnambulist\Components\Domain\Entities\AbstractValueObject;

/**
 * Class PermissionName
 *
 * @package    App\Users\Domain\Models
 * @subpackage App\Users\Domain\Models\PermissionName
 */
final class PermissionName extends AbstractValueObject
{

    private string $value;

    public function __construct(string $value)
    {
        Assert::that($value, null, 'permission_name')->notEmpty()->notBlank()->notNull()->maxLength(255);

        $this->value = $value;
    }

    public function toString(): string
    {
        return $this->value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
