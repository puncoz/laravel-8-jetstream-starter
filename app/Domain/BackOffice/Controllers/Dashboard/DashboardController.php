<?php

namespace App\Domain\BackOffice\Controllers\Dashboard;

use App\Core\BaseClasses\Controller\BackOfficeController;
use Inertia\Response;
use Inertia\ResponseFactory;

/**
 * Class DashboardController
 * @package App\Domain\BackOffice\Controllers\Dashboard
 */
class DashboardController extends BackOfficeController
{
    /**
     * @return Response|ResponseFactory
     */
    public function index()
    {
        return inertia('dashboard/Dashboard');
    }
}
