<?php declare(strict_types=1);

namespace App\Accounts\Delivery\ViewModels;

use App\Users\Delivery\ViewModels\UserView;
use Somnambulist\Components\Collection\Contracts\Collection;
use Somnambulist\Components\Models\Types\DateTime\DateTime;
use Somnambulist\Components\Models\Types\Identity\Uuid;
use Somnambulist\Components\ReadModels\Model;
use Somnambulist\Components\ReadModels\Relationships\HasOneToMany;

/**
 * @property-read Uuid                  $id
 * @property-read string                $name
 * @property-read bool                  $active
 * @property-read string                $type
 * @property-read DateTime              $created_at
 * @property-read DateTime              $updated_at
 *
 * @property-read Collection|UserView[] $users
 *
 * @method static AccountView findOrFail($id)
 */
class AccountView extends Model
{
    protected string $table = 'accounts';

    protected ?string $tableAlias = 'a';

    protected ?string $foreignKey = 'account_id';

    protected array $casts = [
        'id'         => 'uuid',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected array $exports = [
        'attributes'    => [
            'id',
            'name',
            'active',
            'type',
            'created_at',
            'updated_at',
        ],
        'relationships' => [

        ],
    ];

    public function users(): HasOneToMany
    {
        return $this->hasMany(UserView::class, 'account_id', 'id');
    }
}
