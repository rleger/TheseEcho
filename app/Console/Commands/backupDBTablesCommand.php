<?php

namespace These\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use These\Admin\Database\BackupDBTable;

/**
 * Class backupDBTablesCommand.
 */
class backupDBTablesCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'these:backupDBTables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the selected tables to a csv file.';

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
        $tables = explode(',', $this->option('tables'));

        try {
            $backup = new BackupDBTable($tables);
            $savedResponse = $backup->saveToCSV(storage_path().'/db-backups/');

            return $this->sendMessageToCLI($savedResponse);
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['tables', null, InputOption::VALUE_OPTIONAL, 'You need to indicate the tables to backup with --tables argument.', null],
        ];
    }

    /**
     * Send response to command line.
     *
     * @param $savedResponse
     *
     * @internal param $backup
     */
    protected function sendMessageToCLI($savedResponse)
    {
        $savedResponse = json_decode($savedResponse->getContent());

        $savedTables = array_map(function ($table) {
            return $table->tableName;
        }, $savedResponse->data);

        if ($savedResponse->status === 200) {
            return $this->info($savedResponse->message.' ['.implode(',', $savedTables).']');
        }

        return $this->error($savedResponse->message);
    }
}
