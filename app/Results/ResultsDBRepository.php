<?php

namespace These\Results;

use DB;
use Illuminate\Support\Collection;
use These\Answers\AnswersRepository as AnswersRepository;

/**
 * Class ResultsDBRepository.
 */
class ResultsDBRepository implements ResultsRepository
{
    /**
     * @var AnswersRepository
     */
    protected $answersRepository;

    /**
     * @param AnswersRepository $repo
     */
    public function __construct(AnswersRepository $repo)
    {
        $this->answersRepository = $repo;
    }

    /**
     * Nombre de centre participants.
     *
     * @return Collection
     */
    public function centres_participants()
    {
        $centers = DB::select(
            'SELECT *
            FROM medical_center
            WHERE medical_center.id IN (
                SELECT answers.medical_center_id FROM answers WHERE medical_center.name <> "inconnu"
                ) AND medical_center.name <> "inconnu"');

        return (new Collection($centers));
    }

    /**
     * Nombre de centres non participants.
     *
     * @return Collection
     */
    public function centres_non_participants()
    {
        $centers = DB::select(
            'SELECT *
            FROM medical_center
            WHERE medical_center.id NOT IN (
                SELECT answers.medical_center_id FROM answers WHERE medical_center.name <> "inconnu"
                ) AND medical_center.name <> "inconnu"'
        );

        return (new Collection($centers));
    }

    /**
     * Get how many fields have that value.
     *
     * @param        $field
     * @param        $value
     * @param string $valueType
     *
     * @return float
     */
    public function howMany($field, $value, $valueType = 'absolute', $operator = '=')
    {
        $query = sprintf('SELECT count(*) as finalCount FROM answers WHERE %s'.$operator."'%s'", $field, $value);

        $answersWith = DB::select($query);

        if ($valueType === 'percentage') {
            return $this->percentage($answersWith[0]->finalCount);
        }

        return $answersWith[0]->finalCount;
    }

    /**
     * Get a value in percentage.
     *
     * @param $value
     *
     * @return float
     */
    protected function percentage($value)
    {
        if ($this->participants() === 0) {
            return false;
        }

        return $value * 100 / $this->participants();
    }

    /**
     * Nombre de participants.
     *
     * @return mixed
     */
    public function participants()
    {
        return $this->answersRepository->count();
    }

    public function getFieldsAndValList()
    {
    }
}
