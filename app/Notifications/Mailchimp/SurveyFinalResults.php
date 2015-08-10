<?php

namespace These\Notifications\Mailchimp;

use Mailchimp;
use These\Notifications\SurveyFinalResults as SurveyFinalResultsInterface;

/**
 * Class SurveyFinalResults.
 */
class SurveyFinalResults implements SurveyFinalResultsInterface
{
    /**
     * List ID of the ALR results subscribers.
     */
    const Echo_results_SUBSCRIBERS_ID = 'f01d94ec65';

    /**
     * @var Mailchimp
     */
    protected $mailchimp;

    /**
     * Constructor.
     *
     * @param Mailchimp $mailchimp
     */
    public function __construct(Mailchimp $mailchimp)
    {
        $this->mailchimp = $mailchimp;
    }

    /**
     * Notify members that SurveyFinalResults.
     *
     * @param $title
     * @param $body
     *
     * @return mixed
     */
    public function notify($title, $body)
    {
        $options = [
            'list_id'    => Self::Echo_results_SUBSCRIBERS_ID,
            'subject'    => 'Résultats Questionnaire',
            'from_name'  => 'Administrateur',
            'from_email' => 'these.echo@gmail.com',
            'to_name'    => 'Etude',
        ];

        $content = [
            'html' => $body,
            'text' => strip_tags($body),
        ];

        // Create a new campaign
        $campaign = $this->mailchimp->campaigns->create('regular', $options, $content);

        $this->mailchimp->campaigns->send($campaign['id']);
    }
}
