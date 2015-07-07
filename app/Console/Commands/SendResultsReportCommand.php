<?php

namespace These\Console\Commands;

use Illuminate\Console\Command;
use These\Notifications\SendResultsReport;

class SendResultsReportCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'these:sendResultsReport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envoyer les résultats partiels aux administrateurs.';
    /**
     * @var SurveyFinalResults
     */
    private $resultsReport;

    /**
     * Create a new command instance.
     *
     * @param SendResultsReport|SendResultsReport $resultsReport
     *
     * @return \These\Console\Commands\SendResultsReportCommand
     */
    public function __construct(SendResultsReport $resultsReport)
    {
        parent::__construct();

        $this->resultsReport = $resultsReport;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->resultsReport->notify();

        $this->comment(PHP_EOL.'Les résultats partiels ont été envoyés !'.PHP_EOL);
    }
}
