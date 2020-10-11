<?php

namespace App\Core\Actions\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\FailedTwoFactorLoginResponse as FailedTwoFactorLoginResponseInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FailedTwoFactorLoginResponse
 * @package App\Core\Actions\Auth
 */
class FailedTwoFactorLoginResponse implements FailedTwoFactorLoginResponseInterface
{

    /**
     * Create an HTTP response that represents the object.
     *
     * @param Request $request
     *
     * @return Response
     * @throws ValidationException
     */
    public function toResponse($request)
    {
        $message = __('The provided two factor authentication code was invalid.');

        if ( $request->wantsJson() ) {
            throw ValidationException::withMessages(
                [
                    'code' => [$message],
                ]
            );
        }

        return redirect()->route('login')->withErrors(['error' => $message]);
    }
}
