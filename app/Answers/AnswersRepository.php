<?php

namespace These\Answers;

/**
 * Interface AnswersRepository.
 */
interface AnswersRepository
{
    /**
     * Create and save an answer if email is unique.
     *
     * @param $data
     *
     * @return mixed
     */
    public function createAndSaveIfUnique($data);
}
