<?php

namespace These\MedicalCenter;

use These\BaseRepository;

/**
 * Class MedicalCenterDBRepository.
 */
class MedicalCenterDBRepository extends BaseRepository implements MedicalCenterRepository
{
    /**
     * Constructor.
     *
     * @param MedicalCenter $medicalCenter
     */
    public function __construct(MedicalCenter $medicalCenter)
    {
        $this->entity = $medicalCenter;
    }

    /**
     * Find out if there is a medical center with the given token.
     *
     * @param $token
     *
     * @return mixed
     */
    public function withTokenExists($token)
    {
        return $this->entity->where('token', $token)->count();
    }

    /**
     * Get the medical center Id with a given token.
     *
     * @param $token
     *
     * @return int
     */
    public function getIdWithToken($token)
    {
        if (!$this->withTokenExists($token)) {
            return $this->entity->getUnknownMedicalCenterId();
        }

        return $this->entity->where('token', $token)->first()->id;
    }

    /**
     * Get All Records where token is not set, without Unknown medical center.
     *
     * @return mixed
     */
    public function getWithTokenNotSetButUnknownMedicalCenter()
    {
        return $this->entity
                ->where('token', null)
                ->where('id', '!=', MedicalCenter::UNKNOWN_MEDICAL_CENTER_ID)
                ->get();
    }

    /**
     * Get all records withou Unknown Medical Center.
     *
     * @return mixed
     */
    public function getAllButUnknownMedicalCenter()
    {
        return $this->entity
                ->where('id', '!=', MedicalCenter::UNKNOWN_MEDICAL_CENTER_ID)
                ->get();
    }
}
