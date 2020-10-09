<?php

namespace App\Domain\Admin\View;

use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * Class AuthLayout
 * @package App\Domain\Admin\View
 */
class AuthLayout extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('layouts.auth');
    }
}
