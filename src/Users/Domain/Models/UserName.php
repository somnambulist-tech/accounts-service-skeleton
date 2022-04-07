<?php declare(strict_types=1);

namespace App\Users\Domain\Models;

use Assert\Assert;
use Somnambulist\Components\Domain\Entities\AbstractValueObject;

/**
 * Class UserName
 *
 * @package    App\Users\Domain\Models
 * @subpackage App\Users\Domain\Models\UserName
 */
final class UserName extends AbstractValueObject
{
    public function __construct(private string $value)
    {
        Assert::that($value, null, 'user_name')->notEmpty()->notBlank()->notNull()->minLength(3)->maxLength(100);
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
