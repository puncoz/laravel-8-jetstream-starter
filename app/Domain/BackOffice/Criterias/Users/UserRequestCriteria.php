<?php

namespace App\Domain\BackOffice\Criterias\Users;

use App\Core\BaseClasses\Repository\BaseRequestCriteria;
use Illuminate\Database\Query\Builder;

/**
 * Class UserRequestCriteria
 * @package App\Domain\BackOffice\Criterias\Users
 */
class UserRequestCriteria extends BaseRequestCriteria
{
    /**
     * @param Builder $model
     * @param string  $search
     *
     * @return Builder
     */
    public function searchFilter($model, string $search)
    {
        return $model->where(
            function ($query) use ($search) {
                /** @var Builder $query */
                $query->orWhere('username', 'ilike', "%{$search}%");
                $query->orWhere('email', 'ilike', "%{$search}%");
                $query->orWhere(
                    \DB::raw("concat(full_name->>'first_name', ' ', full_name->>'last_name')"),
                    'ilike',
                    "%{$search}%"
                );
            }
        );
    }

    /**
     * @param Builder $model
     * @param array   $filter
     *
     * @return Builder
     */
    public function postQuery($model, array $filter)
    {
        return $model->orderBy(\DB::raw("full_name->>'first_name'"), 'asc');
    }
}
