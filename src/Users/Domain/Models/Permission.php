<?php declare(strict_types=1);

namespace App\Users\Domain\Models;

use Somnambulist\Domain\Entities\Types\DateTime\DateTime;

/**
 * Class Permission
 *
 * @package    App\Users\Domain\Models
 * @subpackage App\Users\Domain\Models\Permission
 */
class Permission
{

    private ?int $id = null;
    private Name $name;
    private DateTime $createdAt;

    public function __construct(Name $name)
    {
        $this->name = $name;
        $this->createdAt = DateTime::now();
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }
}
