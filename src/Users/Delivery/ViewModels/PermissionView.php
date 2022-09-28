<?php declare(strict_types=1);

namespace App\Users\Delivery\ViewModels;

use Somnambulist\Components\Models\Types\DateTime\DateTime;
use Somnambulist\Components\ReadModels\Model;

/**
 * @property-read int      $int
 * @property-read string   $name
 * @property-read DateTime $created_at
 */
class PermissionView extends Model
{

    protected string $table = 'permissions';

    protected ?string $tableAlias = 'p';

    protected ?string $foreignKey = 'permission_id';

    protected array $casts = [
        'created_at' => 'datetime',
    ];

    protected array $exports = [
        'attributes'    => [
            'name', 'created_at',
        ],
        'relationships' => [

        ],
    ];
}
