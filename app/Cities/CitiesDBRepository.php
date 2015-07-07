<?php

namespace These\Cities;

/*
 * Class CitiesDBRepository
 * @package These\Cities
 */

/**
 * Class CitiesDBRepository.
 */
class CitiesDBRepository implements CitiesRepository
{
    /**
     * @var Cities
     */
    protected $cities;

    /**
     * Constructor.
     *
     * @param Cities $cities
     */
    public function __construct(Cities $cities)
    {
        $this->cities = $cities;
    }

    /**
     * @param $search
     */
    public function getPostalCode($search)
    {
        return $this->getCityProperty($search, 'ville_code_postal');
    }

    /**
     * @param $search
     * @param $property
     */
    protected function getCityProperty($search, $property)
    {
        return $this->getProperty($this->firstWhereNameOrPostalCodeIs($search), $property);
    }

    /**
     * @param $collection
     * @param $property
     */
    protected function getProperty($collection, $property)
    {
        if ($collection) {
            return $collection->$property;
        }

        return;
    }

    /**
     * @param $search
     *
     * @return mixed|null
     */
    public function firstWhereNameOrPostalCodeIs($search)
    {
        if (!$search) {
            return;
        }

        return $this->whereNameOrPostalCodeIs($search)->first();
    }

    /**
     * Search a city by name or postal code.
     *
     * @param $search
     *
     * @return \Illuminate\Support\Collection
     */
    public function whereNameOrPostalCodeIs($search)
    {
        return $this->cities->where('ville_nom', 'LIKE', "$search%")
            ->orWhere('ville_nom_simple', 'LIKE', "$search%")
            ->orWhere('ville_nom_reel', 'LIKE', "$search%")
            ->orWhere('ville_code_postal', 'LIKE', "$search%")
            ->orderBy('ville_population_2012', 'DESC')
            ->get();
    }

    /**
     * @param $search
     */
    public function getDepartement($search)
    {
        return $this->getCityProperty($search, 'ville_departement');
    }

    /**
     * @param $search
     */
    public function getName($search)
    {
        return $this->getCityProperty($search, 'ville_nom_reel');
    }
}
