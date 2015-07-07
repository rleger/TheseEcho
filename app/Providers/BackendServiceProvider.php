<?php

namespace These\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Register Backend bindings.
 *
 * Class BackendServiceProvider
 */
class BackendServiceProvider extends ServiceProvider
{
    public function register()
    {
        // UserRepository
        $this->app->bind('These\Users\UserRepository', 'These\Users\UserDBRepository');

        // Cities
        $this->app->bind('These\Cities\CitiesRepository', 'These\Cities\CitiesDBRepository');

        // Answers
        $this->app->bind('These\Answers\AnswersRepository', 'These\Answers\AnswersDBRepository');

        // MedicalCenter
        $this->app->bind('These\MedicalCenter\MedicalCenterRepository', 'These\MedicalCenter\MedicalCenterDBRepository');

        // Newsletters
        $this->app->bind('These\Newsletters\NewsletterList', 'These\Newsletters\Mailchimp\NewsletterList');

        // Notifications
        $this->app->bind('These\Notifications\SurveyFinalResults', 'These\Notifications\Mailchimp\SurveyFinalResults');
        $this->app->bind('These\Notifications\SendResultsReport', 'These\Notifications\Mailchimp\SendResultsReport');

        // Results
        $this->app->bind('These\Results\ResultsRepository', 'These\Results\ResultsDBRepository');

        // EventLogger
        // $this->app->bind('These\Events\Logger\EventLogger', 'These\Events\Logger\FileEventLogger');
        $this->app->bind('These\Events\Logger\EventLogger', 'These\Events\Logger\MonologEventLogger');

        // Pusher service
        $this->app->bind('These\Pusher\Pusher', 'These\Pusher\Pusher_dot_com\Pusher');
    }
}
