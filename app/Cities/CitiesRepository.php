<?php

namespace These\Cities;

/**
 * Interface CitiesRepository.
 */
interface CitiesRepository
{
    /**
     * Search a city by name or postal code.
     *
     * @param $search
     *
     * @return mixed
     */
    public function whereNameOrPostalCodeIs($search);
}
