<?php

namespace These\Answers;

use These\Answers\Exceptions\EmailExistsException;
use These\Answers\Exceptions\NoAnswerFoundWithThisMailException;
use These\BaseRepository;

/**
 * Class AnswersDBRepository.
 */
class AnswersDBRepository extends BaseRepository implements AnswersRepository
{
    /**
     * Constructor.
     *
     * @param Answers $answers
     */
    public function __construct(Answers $answers)
    {
        $this->entity = $answers;
    }

    /**
     * Get All answers, eager load medical centers.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allWithMedicalCenters()
    {
        return $this->entity->with('MedicalCenter')->get();
    }

    /**
     * Create and save an answer if email is unique.
     *
     * @param $data
     *
     * @return bool
     *
     * @throws EmailExistsException
     */
    public function createAndSaveIfUnique($data)
    {
        if ($this->emailWasEntered($data) and $this->alreadyAnsweredWithThisEmail($data)) {
            throw new EmailExistsException();
        }

        return $this->entity->create($data);
    }

    /**
     * Returns if an email was entered.
     *
     * @param array $data
     *
     * @return bool
     */
    protected function emailWasEntered(array $data)
    {
        return (array_key_exists('email', $data) && !is_null($data['email']) && $data['email'] !== '');
    }

    /**
     * Update email record for an id.
     *
     * @param $id
     * @param $email
     *
     * @return mixed
     */
    public function updateEmailFor($id, $email)
    {
        return $this->entity->find($id)->fill(compact('email'))->save();
    }

    /**
     * Update database record to subscribe a user to results.
     *
     * @param $email
     *
     * @return bool
     */
    public function subscribeToResults($email)
    {
        $answer = $this->getFirstAnswerWithEmail($email);

        $answer->subscribeToResult = true;

        return $answer->save();
    }

    /**
     * Subscribe answerer to results.
     *
     * @param $answer_id
     *
     * @return mixed
     */
    public function subscribeAnswererToResults($answer_id)
    {
        $answer = $this->find($answer_id);

        $answer->subscribeToResult = true;

        return $answer->save();
    }

    /**
     * Update database record to unsubscribe a user to results.
     *
     * @param $email
     *
     * @return bool
     */
    public function unSubscribeFromResults($email)
    {
        $answer = $this->getFirstAnswerWithEmail($email);

        $answer->subscribeToResult = false;

        return $answer->save();
    }

    /**
     * UnSubscribe Answerer from results.
     *
     * @param $answer_id
     *
     * @return mixed
     */
    public function unSubscribeAnswererFromResults($answer_id)
    {
        $answer = $this->find($answer_id);

        $answer->subscribeToResult = false;

        return $answer->save();
    }

    /**
     * Return if an email already exists.
     *
     * @param $data
     *
     * @return bool
     */
    protected function alreadyAnsweredWithThisEmail($data)
    {
        return ($this->entity->where('email', $data['email'])->count()) ? true : false;
    }

    /**
     * Return the first answer with the provided email.
     *
     * @param $email
     *
     * @throws NoAnswerFoundWithThisMailException
     *
     * @return mixed
     */
    protected function getFirstAnswerWithEmail($email)
    {
        $answers = $this->entity->where('email', $email)->first();

        if (!$answers) {
            throw new NoAnswerFoundWithThisMailException("Le mail [$email] n'est pas inscrit à cette mailing list");
        }

        return $answers;
    }
}
