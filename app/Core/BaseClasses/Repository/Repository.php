<?php

namespace App\Core\BaseClasses\Repository;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class Repository
 * @package App\Core\BaseClasses\Repository
 */
abstract class Repository extends BaseRepository
{
    /**
     * @param string $slug
     * @param array  $columns
     *
     * @return mixed
     * @throws RepositoryException
     */
    public function findBySlug(string $slug, array $columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();
        $data = $this->model->where('slug', '=', $slug)->get($columns);
        $this->resetModel();

        if ( $data->isEmpty() ) {
            throw (new ModelNotFoundException())->setModel(
                get_class($this->model),
                "slug:{$slug}"
            );
        }

        return $this->parserResult($data->first());
    }
}
