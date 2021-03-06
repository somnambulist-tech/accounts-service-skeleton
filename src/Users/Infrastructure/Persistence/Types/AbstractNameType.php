<?php declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\Types;

use App\Users\Domain\Models\UserName;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use InvalidArgumentException;

/**
 * Class AbstractNameType
 *
 * @package    App\Users\Infrastructure\Persistence\Types
 * @subpackage App\Users\Infrastructure\Persistence\Types\AbstractNameType
 */
class AbstractNameType extends Type
{

    protected string $name = 'name';
    protected string $class = UserName::class;

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }

        if ($value instanceof $this->class) {
            return $value;
        }

        try {
            $ret = new $this->class($value);
        } catch (InvalidArgumentException $e) {
            throw ConversionException::conversionFailed($value, $this->name);
        }

        return $ret;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
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

    public function getName()
    {
        return $this->name;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}
