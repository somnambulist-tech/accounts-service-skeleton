<?php declare(strict_types=1);

namespace App\Users\Delivery\ViewModels;

use Somnambulist\Collection\Contracts\Collection;
use Somnambulist\Components\ReadModels\Model;
use Somnambulist\Components\ReadModels\Relationships\BelongsToMany;
use Somnambulist\Domain\Entities\Types\DateTime\DateTime;
use Somnambulist\Domain\Entities\Types\Identity\Uuid;

/**
 * Class RoleView
 *
 * @package    App\Users\Delivery\ViewModels
 * @subpackage App\Users\Delivery\ViewModels\RoleView
 *
 * @property-read Uuid                        $id
 * @property-read string                      $name
 * @property-read DateTime                    $created_at
 * @property-read DateTime                    $updated_at
 *
 * @property-read Collection|PermissionView[] $permissions
 * @property-read Collection|RoleView[]       $roles
 */
class RoleView extends Model
{

    protected string $table = 'roles';

    protected ?string $tableAlias = 'r';

    protected ?string $foreignKey = 'role_id';

    protected array $casts = [
        'id'         => 'uuid',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected array $exports = [
        'attributes'    => [
            'id', 'name', 'created_at', 'updated_at',
        ],
        'relationships' => [

        ],
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(PermissionView::class, 'role_permissions');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(RoleView::class, 'role_grantable_roles', 'role_source', 'role_target');
    }
}
