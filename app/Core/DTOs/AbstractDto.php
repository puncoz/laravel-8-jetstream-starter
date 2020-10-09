<?php

namespace App\Core\DTOs;

use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

/**
 * Class AbstractDto
 * @package App\Core\DTOs
 */
abstract class AbstractDto
{
    /**
     * AbstractDto constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $validator = Validator::make($data, $this->validationRules());

        if ( $validator->fails() ) {
            throw new InvalidArgumentException('Error: '.$validator->errors()->first());
        }

        $this->map($data);
    }

    /**
     * @return array
     */
    abstract protected function validationRules(): array;

    /**
     * @param array $data
     */
    abstract protected function map(array $data): void;
}
