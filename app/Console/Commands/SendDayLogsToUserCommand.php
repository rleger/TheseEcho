<?php

namespace These\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use These\Admin\SendDayLogsToUser;

class SendDayLogsToUserCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'these:SendDayLogsToUser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send the logs of a given day to users by mail.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $result = (new SendDayLogsToUser('today', [], ['admin']))->send();

        $this->comment($result->getContent().PHP_EOL);
    }

    /*
     * Get the console command arguments.
     *
     * @return array
     */
    // protected function getArguments()
    // {
    // 	return [
    // 		['example', InputArgument::REQUIRED, 'An example argument.'],
    // 	];
    // }

    /*
     * Get the console command options.
     *
     * @return array
     */
    // protected function getOptions()
    // {
    // 	return [
    // 		['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
    // 	];
    // }
}
