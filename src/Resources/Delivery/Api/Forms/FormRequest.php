<?php declare(strict_types=1);

namespace App\Resources\Delivery\Api\Forms;

use Somnambulist\Bundles\ApiBundle\Request\Behaviours\GetIncludesFromParameterBag;
use Somnambulist\Bundles\ApiBundle\Request\Behaviours\GetOrderByFromParameterBag;
use Somnambulist\Bundles\ApiBundle\Request\Behaviours\GetPaginationFromParameterBag;
use Somnambulist\Bundles\FormRequestBundle\Http\FormRequest as BaseFormRequest;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class FormRequest
 *
 * @package    App\Resources\Delivery\Api\Forms
 * @subpackage App\Resources\Delivery\Api\Forms\FormRequest
 */
abstract class FormRequest extends BaseFormRequest
{

    use GetIncludesFromParameterBag;
    use GetOrderByFromParameterBag;
    use GetPaginationFromParameterBag;

    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->perPage    = 50;
        $this->maxPerPage = 100;
        $this->limit      = 1000;
    }

    public function includes(): array
    {
        return $this->doGetIncludes($this->query);
    }

    public function orderBy(string $default = null): array
    {
        return $this->doGetOrderBy($this->query, $default);
    }

    public function page(): int
    {
        return $this->doGetPage($this->query);
    }

    public function perPage(int $default = null, int $max = null): int
    {
        return $this->doGetPerPage($this->query, $default, $max);
    }

    public function limit(int $default = null, int $max = null): int
    {
        return $this->doGetLimit($this->query, $default, $max);
    }

    public function offset(int $limit = null): int
    {
        return $this->doGetOffset($this->query, $limit);
    }
}
