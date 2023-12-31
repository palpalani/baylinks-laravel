<?php

namespace PalPalani\BayLinks\Contracts;

/**
 * @template T of array
 */
interface DataTransferObject
{
    /**
     * @param  T  $data
     * @return self<T>
     */
    public static function from(array $data): self;
}
