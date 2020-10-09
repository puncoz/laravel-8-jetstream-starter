<?php

namespace App\Core\Actions\Auth;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LogoutResponse
 * @package App\Core\Actions\Auth
 */
class LogoutResponse implements LogoutResponseInterface
{
    /**
     * @param Request $request
     *
     * @return Application|JsonResponse|RedirectResponse|Redirector|Response
     */
    public function toResponse($request)
    {
        return $request->wantsJson() ? new JsonResponse('', 204) : inertia()->forceRedirect(route('login'));
    }
}
