<?php declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\Types;

use App\Users\Domain\Models\UserName;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use InvalidArgumentException;

class AbstractNameType extends Type
{
    protected string $name = 'name';
    protected string $class = UserName::class;

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getStringTypeDeclarationSQL($column);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        if (empty($value)) {
            return null;
        }

        if ($value instanceof $this->class) {
            return $value;
        }

        try {
            $ret = new $this->class($value);
        } catch (InvalidArgumentException) {
            throw ConversionException::conversionFailed($value, $this->name);
        }

        return $ret;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (empty($value)) {
            return null;
        }

        try {
            return (string)$value;
        } catch (InvalidArgumentException $e) {

        }

        throw ConversionException::conversionFailed($value, $this->name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
