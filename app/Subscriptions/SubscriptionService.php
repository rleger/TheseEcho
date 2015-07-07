<?php

namespace These\Subscriptions;

use These\Answers\AnswersRepository;
use These\Newsletters\NewsletterList;

/**
 * Class SubscriptionService.
 */
class SubscriptionService
{
    /**
     * Answers repository.
     *
     * @var AnswersRepository
     */
    protected $answers;

    /**
     * Newsletter.
     *
     * @var NewsletterList
     */
    protected $newsletter;

    /**
     * Constructor.
     *
     * @param AnswersRepository $answers
     * @param NewsletterList    $newsletter
     */
    public function __construct(AnswersRepository $answers, NewsletterList $newsletter)
    {
        $this->answers = $answers;

        $this->newsletter = $newsletter;
    }

    /**
     * Subscribe an answerer to one or more lists.
     *
     * @param       $answer_id
     * @param array $allLists
     */
    public function subscribeAnswerer($answer_id, array $allLists = [])
    {
        // Update database record
        $this->answers->subscribeAnswererToResults($answer_id);

        // Find the email for the answer, and subscribe it to the list
        $email = $this->answers->find($answer_id)->email;

        foreach ($allLists as $list) {
            $this->newsletter->subscribeTo($list, $email);
        }
    }

    /**
     * Unsubscribe an answerer from one or more lists.
     *
     * @param       $answer_id
     * @param array $allLists
     */
    public function unSubscribeAnswerer($answer_id, array $allLists = [])
    {
        // Update database record
        $this->answers->unSubscribeAnswererFromResults($answer_id);

        // Find the email for the answer, and unsubscribe it to the list
        $email = $this->answers->find($answer_id)->email;

        foreach ($allLists as $list) {
            $this->newsletter->unSubscribeFrom($list, $email);
        }
    }
}
