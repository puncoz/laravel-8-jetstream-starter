<?php

namespace App\Domain\Admin\Controllers;

use App\Domain\Common\AdminController;
use Inertia\Response;
use Inertia\ResponseFactory;

/**
 * Class DashboardController
 * @package App\Domain\Admin\Controllers
 */
class DashboardController extends AdminController
{
    /**
     * @return Response|ResponseFactory
     */
    public function __invoke()
    {
        return inertia('Dashboard/Dashboard');
    }
}
