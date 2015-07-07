<?php

namespace These\Results;

use These\Answers\AnswersRepository;
use These\Cities\CitiesRepository;
use These\MedicalCenter\MedicalCenterRepository;

/**
 * Class ResultsService.
 */
class ResultsService
{
    /**
     * Remove fields from results.
     *
     * @var array
     */
    protected $removeFromGrouppedResults = ['id', 'medical_center_id', 'ville', 'client_ip_address', 'age', 'experience', 'email', 'commentaires', 'created_at', 'updated_at'];

    /**
     * Don't try to parse (cannot be separated by a ',').
     *
     * @var array
     */
    protected $dontExplodeValue = ['id', 'medical_center_id', 'created_at', 'updated_at', 'age', 'experience', 'client_ip_address', 'email', 'metier', 'tps_passage', 'type_structure', 'echec', 'ville', 'bif_dose_lido', 'bif_dose_ropi', 'bif_dose_mepi', 'bif_dose_chiro', 'bif_dose_cata', 'fem_dose_lido', 'fem_dose_ropi', 'fem_dose_mepi', 'fem_dose_chiro', 'fem_dose_cata', 'fem_obtu_dose_lido', 'fem_obtu_dose_ropi', 'fem_obtu_dose_mepi', 'fem_obtu_dose_chiro', 'fem_obtu_dose_cata'];

    /**
     * Answers Repository.
     *
     * @var AnswersRepository
     */
    protected $answers;

    /**
     * Medical Center Repository.
     *
     * @var MedicalCenterRepository
     */
    protected $medicalCenterRepository;

    /**
     * @var CitiesRepository
     */
    protected $citiesRepository;

    /**
     * Constructor.
     *
     * @param AnswersRepository       $answers
     * @param MedicalCenterRepository $medicalCenterRepository
     * @param CitiesRepository        $citiesRepository
     *
     * @internal param ResultsRepository $results
     */
    public function __construct(AnswersRepository $answers, MedicalCenterRepository $medicalCenterRepository, CitiesRepository $citiesRepository)
    {
        $this->answers = $answers;

        $this->medicalCenterRepository = $medicalCenterRepository;

        $this->citiesRepository = $citiesRepository;
    }

    /**
     * Return the number of answerer.
     *
     * @return mixed
     */
    public function nbAnswer()
    {
        return $this->answers->count();
    }

    /**
     * Lists id.
     *
     * @return array
     */
    public function listIds()
    {
        return $this->answers->lists('id');
    }

    /**
     * Get an array of groupped results.
     *
     * @return array
     */
    public function grouppedResults()
    {
        $groupped = [];

        foreach ($this->answers->all()->toArray() as $index => $answer) {
            foreach ($answer as $key => $value) {
                if ($value == null || $value == '' || in_array($key, $this->removeFromGrouppedResults)) {
                    continue;
                }

                // Ignore if value is an array
                if (!is_array($value)) {
                    $values = (!in_array($key, $this->dontExplodeValue)) ? explode(',', $value) : [$value];

                    foreach ($values as $value) {
                        if (array_key_exists($key, $groupped) && array_key_exists($value, $groupped[$key])) {
                            $groupped[$key][$value] = $groupped[$key][$value] + 1;
                        } else {
                            $groupped[$key][$value] = 1;
                        }
                    }
                }
            }
        }

        // Sorting the answers by number descending
        foreach ($groupped as $key => $value) {
            array_multisort($groupped[$key], SORT_NUMERIC, SORT_DESC);
        }

        return $groupped;
    }

    /**
     * Return an array of answers.
     *
     * @return array
     */
    public function answersArray()
    {
        $groupped = [];

        foreach ($this->answers->allWithMedicalCenters()->toArray() as $answer) {
            foreach ($answer as $key => $value) {
                // If we find a nested array, ignore it
                if (is_array($answer[$key])) {
                    continue;
                }

                // When we are at medical_center_id, substitute it for its name and id
                if ($key === 'medical_center_id') {
                    $groupped['medical_center_id'][] = $answer['medical_center']['id'];
                    $groupped['medical_center_email'][] = $answer['medical_center']['email'];
                    $groupped['medical_center'][] = $answer['medical_center']['name'];
                    continue;
                }

                // Add it to the groupped array
                $groupped[$key][] = $value;
            }
        }

        return $groupped;
    }

    /**
     * Return an array of answers.
     *
     * @return array
     */
    public function answersExplodedArray()
    {
        $groupped = [];

        foreach ($this->answers->allWithMedicalCenters()->toArray() as $answer) {
            foreach ($answer as $key => $value) {
                $answer_id = $answer['id'];
                // If we find a nested array, ignore it
                if (is_array($answer[$key])) {
                    continue;
                }

                // When we are at medical_center_id, substitute it for its name and id
                if ($key === 'medical_center_id') {
                    $groupped['medical_center_id'][$answer_id] = $answer['medical_center']['id'];
                    $groupped['medical_center_email'][$answer_id] = $answer['medical_center']['email'];
                    $groupped['medical_center'][$answer_id] = $answer['medical_center']['name'];
                    continue;
                }
                // if (!is_array($value)) {
                //     $values = (!in_array($key, $this->dontExplodeValue)) ? explode(',', $value) : [$value];
                // }
                // Add it to the groupped array
                $group = array_filter(explode(',', $value));

                if (!in_array($key, $this->dontExplodeValue)) {
                    // if (count($group) > 1) {
                    foreach ($group as $val) {
                        // Ignore specific field
                        if (in_array($key, ['commentaires'])) {
                            continue;
                        }
                        $str = new \Illuminate\Support\Str();
                        $val = substr($str->slug($val), 0, 35);

                        $groupped[$key.'_'.$val][$answer_id] = 1;
                    }
                } else {
                    $groupped[$key][$answer_id] = $value;
                }
            }
        }

        return $groupped;
    }

    /**
     * Resolve medical center name.
     *
     * @param $value
     *
     * @return mixed
     */
    public function resolveMedicalCenterIdName($value)
    {
        return $this->medicalCenterRepository->find($value)->name;
    }
}
