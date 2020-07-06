<?php

namespace App\Domain\BackOffice\Presenters\User;

use App\Domain\BackOffice\Transformers\User\UserTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class UserPresenter
 * @package App\Domain\BackOffice\Presenters\User
 */
class UserPresenter extends FractalPresenter
{
    /**
     * @inheritDoc
     */
    public function getTransformer()
    {
        return new UserTransformer();
    }
}
