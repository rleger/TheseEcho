<?php

namespace These\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use These\Answers\AnswersRepository;
use These\Transformers\AnswersTransformer;

/**
 * Class ApiController.
 */
class ApiController extends BaseApiController
{
    /**
     * @var AnswersRepository
     */
    protected $answersRepository;

    /**
     * @var AnswersTransformer
     */
    private $answersTransformer;

    /**
     * @param AnswersRepository  $answersRepository
     * @param AnswersTransformer $answersTransformer
     */
    public function __construct(AnswersRepository $answersRepository, AnswersTransformer $answersTransformer)
    {
        $this->answersRepository = $answersRepository;

        $this->answersTransformer = $answersTransformer;
    }

    /**
     * @return array
     */
    public function answers()
    {
        $answers = $this->answersRepository->all();

        return $this->respond([
            'data' => $this->answersTransformer->transformCollection($answers->toArray()),
        ]);
    }

    /**
     * @return array
     */
    public function answer($answerId)
    {
        try {
            $answer = $this->answersRepository->find($answerId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound("No answer found with an id=$answerId");
        }

        return $this->respond([
            'data' => $this->answersTransformer->transform($answer->toArray()),
        ]);
    }
}
