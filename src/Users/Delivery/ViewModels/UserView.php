<?php declare(strict_types=1);

namespace App\Users\Delivery\ViewModels;

use App\Accounts\Delivery\ViewModels\AccountView;
use Somnambulist\Components\Collection\Contracts\Collection;
use Somnambulist\Components\Models\Types\DateTime\DateTime;
use Somnambulist\Components\Models\Types\Identity\Uuid;
use Somnambulist\Components\ReadModels\Model;
use Somnambulist\Components\ReadModels\Relationships\BelongsTo;
use Somnambulist\Components\ReadModels\Relationships\BelongsToMany;

/**
 * @property-read Uuid                        $uuid
 * @property-read Uuid                        $account_id
 * @property-read string                      $email
 * @property-read string                      $password
 * @property-read string                      $name
 * @property-read bool                        $active
 * @property-read DateTime                    $created_at
 * @property-read DateTime                    $updated_at
 *
 * @property-read AccountView                 $account
 * @property-read Collection|PermissionView[] $permissions
 * @property-read Collection|RoleView[]       $roles
 */
class UserView extends Model
{
    protected string $table = 'users';

    protected ?string $tableAlias = 'u';

    protected ?string $foreignKey = 'user_id';

    protected array $casts = [
        'id'         => 'uuid',
        'account_id' => 'uuid',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected array $exports = [
        'attributes'    => [
            'id',
            'account_id',
            'email',
            'password',
            'name',
            'active',
            'created_at',
            'updated_at',
        ],
        'relationships' => [

        ],
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(AccountView::class, 'account_id', 'id');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(PermissionView::class, 'user_permissions');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(RoleView::class, 'user_roles');
    }
}
