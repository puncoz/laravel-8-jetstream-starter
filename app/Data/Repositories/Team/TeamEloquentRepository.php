<?php

namespace App\Data\Repositories\Team;

use App\Data\Models\Entities\Team;
use App\Data\Repositories\Repository;

/**
 * Class TeamEloquentRepository
 * @package App\Data\Repositories\Team
 */
class TeamEloquentRepository extends Repository implements TeamRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Team::class;
    }
}
