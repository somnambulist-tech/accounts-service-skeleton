<?php declare(strict_types=1);

namespace App\Users\Domain\Models;

use Assert\Assert;
use Somnambulist\Domain\Entities\AbstractValueObject;

/**
 * Class Name
 *
 * @package    App\Users\Domain\Models
 * @subpackage App\Users\Domain\Models\Name
 */
final class Name extends AbstractValueObject
{

    private string $value;

    public function __construct(string $value)
    {
        Assert::that($value, null, 'name')->notEmpty()->notBlank()->notNull()->maxLength(255);

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
