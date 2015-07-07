<?php

namespace These\Http\Controllers;

use These\Cities\CitiesRepository;

class CityController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param $city
     *
     * @internal param int $id
     *
     * @return Response
     */
    public function show($search, CitiesRepository $city)
    {
        return $city->whereNameOrPostalCodeIs($search)->toJson();
    }
}
