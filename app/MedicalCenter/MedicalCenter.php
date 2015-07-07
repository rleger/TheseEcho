<?php

namespace These\MedicalCenter;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MedicalCenter.
 */
class MedicalCenter extends Model
{
    /**
     * Unknown Medical center Id.
     */
    const UNKNOWN_MEDICAL_CENTER_ID = 1;

    /**
     * @var string
     */
    protected $table = 'medical_center';

    /**
     * @var array
     */
    protected $fillable = ['token', 'name', 'email', 'fonction'];

    public function getUnknownMedicalCenterId()
    {
        return Self::UNKNOWN_MEDICAL_CENTER_ID;
    }

    public function Answers()
    {
        return $this->hasMany('These\Answers\Answers');
    }
}
