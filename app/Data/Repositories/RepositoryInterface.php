<?php

namespace App\Data\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface as BaseRepositoryInterface;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Interface RepositoryInterface
 * @package App\Data\Repositories
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
}
