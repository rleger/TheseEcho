<?php

namespace These\Notifications\Mailchimp;

use App;
use Mailchimp;
use These\Notifications\SendResultsReport as SendResultsReportInterface;
use These\Results\ResultsRepository;
use Illuminate\Config\Repository as Config;

/**
 * Class SendResultsReport.
 */
class SendResultsReport implements SendResultsReportInterface
{
    /**
     * List ID of the ALR results subscribers.
     */
    const PARTIAL_RESULTS_LIST = '7a15364ce5';

    /**
     * @var Mailchimp
     */
    protected $mailchimp;
    /**
     * @var ResultsRepository
     */
    protected $results;

    /**
     * Constructor.
     *
     * @param Mailchimp         $mailchimp
     * @param ResultsRepository $results
     */
    public function __construct(Mailchimp $mailchimp, ResultsRepository $results)
    {
        $this->mailchimp = $mailchimp;

        $this->results = $results;
    }

    /**
     * Notify members that SurveyFinalResults.
     *
     * @param $title
     * @param $body
     *
     * @return mixed
     */
    public function notify($title = null, $body = null)
    {
        $config = App::make(Config::class);

        $emailParams = $config->get('These.admin.email');

        $options = [
            'list_id'    => Self::PARTIAL_RESULTS_LIST,
            'subject'    => 'Résultats ALR',
            'from_name'  => $emailParams['name'],
            'from_email' => $emailParams['from'],
            'to_name'    => 'Résultats temporaires',
        ];

        $participants = $this->results->participants();
        $centres_participants = $this->results->centres_participants();
        $centres_non_participants = $this->results->centres_non_participants();
        $results = $this->results;

        $body = view('emails.partial-results', compact('participants', 'centres_participants', 'centres_non_participants', 'results'))->__toString();

        $content = [
            'html' => $body,
            'text' => strip_tags($body),
        ];

        // Create a new campaign
        $campaign = $this->mailchimp->campaigns->create('regular', $options, $content);

        return $this->mailchimp->campaigns->send($campaign['id']);
    }
}
