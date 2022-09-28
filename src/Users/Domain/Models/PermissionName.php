<?php declare(strict_types=1);

namespace App\Users\Domain\Models;

use Assert\Assert;
use Somnambulist\Components\Models\AbstractValueObject;

final class PermissionName extends AbstractValueObject
{
    public function __construct(private string $value)
    {
        Assert::that($value, null, 'permission_name')->notEmpty()->notBlank()->notNull()->maxLength(255);
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
