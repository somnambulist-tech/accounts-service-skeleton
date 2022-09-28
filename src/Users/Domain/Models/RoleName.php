<?php declare(strict_types=1);

namespace App\Users\Domain\Models;

use Assert\Assert;
use Somnambulist\Components\Models\AbstractValueObject;

final class RoleName extends AbstractValueObject
{
    public function __construct(private string $value)
    {
        Assert::that($value, null, 'role_name')->notEmpty()->notBlank()->notNull()->minLength(3)->maxLength(50)->regex('/[a-z0-9_]/');
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
