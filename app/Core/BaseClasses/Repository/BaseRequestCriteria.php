<?php

namespace App\Core\BaseClasses\Repository;

use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class BaseRequestCriteria
 * @package App\Core\BaseClasses\Repository
 */
class BaseRequestCriteria implements CriteriaInterface
{
    /**
     * @var array
     */
    protected $filters;

    /**
     * BaseRequestCriteria constructor.
     *
     * @param array $filters
     */
    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    /**
     * @inheritDoc
     */
    public function apply($model, RepositoryInterface $repository)
    {
        /** @var Builder $model */
        if ( method_exists($this, "preQuery") ) {
            $model = $this->preQuery($model, $this->filters);
        }

        collect($this->filters)->each(
            function ($value, $key) use (&$model) {
                $method = "{$key}Filter";
                if ( $value && method_exists($this, $method) ) {
                    $model = $this->$method($model, $value);
                }
            }
        );

        if ( method_exists($this, "postQuery") ) {
            $model = $this->postQuery($model, $this->filters);
        }

        return $model;
    }
}
