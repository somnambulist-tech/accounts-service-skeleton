<?php declare(strict_types=1);

namespace App\Users\Domain\Models;

use Assert\Assert;
use Somnambulist\Components\Domain\Entities\AbstractValueObject;

/**
 * Class RoleName
 *
 * @package    App\Users\Domain\Models
 * @subpackage App\Users\Domain\Models\RoleName
 */
final class RoleName extends AbstractValueObject
{

    private string $value;

    public function __construct(string $value)
    {
        Assert::that($value, null, 'role_name')->notEmpty()->notBlank()->notNull()->minLength(3)->maxLength(50)->regex('/[a-z0-9_]/');

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
