<?php

namespace These\MedicalCenter;

interface MedicalCenterRepository
{
    /**
     * Find out if there is a medical center with the given token.
     *
     * @param $token
     *
     * @return mixed
     */
    public function withTokenExists($token);

    /**
     * Get the medical center Id with a given token.
     *
     * @param $token
     *
     * @return int
     */
    public function getIdWithToken($token);
}
