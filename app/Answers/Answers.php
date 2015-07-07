<?php

namespace These\Answers;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    /**
     * @var [type]
     */
    protected $guarded = ['id', 'subscribeToResult', 'created_at', 'updated_at'];

    /**
     * @var string
     */
    protected $table = 'answers';

    public function MedicalCenter()
    {
        return $this->belongsTo('These\MedicalCenter\MedicalCenter');
    }
}
