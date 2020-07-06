<?php

namespace App\Core\BaseClasses\Repository;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Contracts\RepositoryInterface as BaseRepositoryInterface;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Interface RepositoryInterface
 * @package App\Core\BaseClasses\Repository
 */
interface RepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Push Criteria for filter the query
     *
     * @param $criteria
     *
     * @return $this
     * @throws RepositoryException
     */
    public function pushCriteria($criteria);

    /**
     * @param string $slug
     *
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findBySlug(string $slug);
}
