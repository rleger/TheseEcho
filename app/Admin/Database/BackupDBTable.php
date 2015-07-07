<?php

namespace These\Admin\Database;

use DB;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Response;
use Illuminate\Contracts\Events\Dispatcher;
use These\Events\DatabaseTableWasSavedToCSV;

/**
 * Class BackupDBTable.
 */
class BackupDBTable
{
    /**
     * @var array
     */
    protected $tables;

    /**
     * @var array
     */
    protected $tableList;
    /**
     * @var
     */
    protected $delimiters;
    /**
     * @var
     */
    protected $wrapper;
    protected $dispatcher;

    /**
     * Constructor.
     *
     * @param $tables
     */
    public function __construct($tables)
    {
        $this->dispatcher = \App::make(Dispatcher::class);

        $this->tables = is_array($tables) ? $tables : [$tables];

        $this->tableList = $this->getTableList();

        $this->tablesContent = $this->getTableContent();
    }

    /**
     * Save the file to CSV.
     *
     * @param        $path
     * @param string $delimiters
     * @param string $wrapper
     * @param string $prefix
     *
     * @return mixed
     */
    public function saveToCSV($path, $delimiters = ';', $wrapper = '"', $prefix = 'backup')
    {
        $response = new Collection();

        $this->delimiters = $delimiters;

        $this->wrapper = $wrapper;

        $this->createFileDirectoryIfNeeded($path);

        foreach ($this->tablesContent as $tableName => $tableContent) {
            // If table is empty, continue to the next
            if (!count($tableContent)) {
                continue;
            }

            $fileName = $path.date('Y-m-d-H-i-s')."-$prefix-$tableName.csv";

            $response->push([
                'status'    => $this->writeCSVFile($fileName, $tableContent),
                'tableName' => $tableName,
                'filename'  => $fileName,
            ]);
        }

        // If there was at least one error
        if (in_array(false, $response->lists('status')->all())) {
            return Response::make(['message' => 'These was an error !', 'status' => 400, 'data' => $response], 400);
        }

        $this->dispatcher->fire(new DatabaseTableWasSavedToCSV($response->lists('tableName')->all()));

        return Response::make(['message' => 'Saved !', 'status' => 200, 'data' => $response], 200);
    }

    /**
     * Write to CSV file.
     *
     * @param $fileName
     * @param $tableContent
     *
     * @return bool
     */
    protected function writeCSVFile($fileName, $tableContent)
    {
        $file = fopen($fileName, 'w');

        // Write headers
        $this->writeTableHeaders($file, $tableContent);

        // Write content
        $this->writeTableContent($file, $tableContent);

        return fclose($file);
    }

    /**
     * Get the table list in the database.
     *
     * @return array
     */
    protected function getTableList()
    {
        return array_map(function ($table) {
            return array_values((array) $table)[0];
        }, DB::select('SHOW TABLES'));
    }

    /**
     * Get the table content.
     *
     * @return mixed
     */
    protected function getTableContent()
    {
        foreach ($this->tables as $table) {
            if (!in_array($table, $this->tableList)) {
                throw new InvalidArgumentException("No table [{$table}] in database !");
            }
            $this->tablesContent[$table] = DB::select("SELECT * FROM {$table}");
        }

        return $this->tablesContent;
    }

    /**
     * Create the path if it doesn't exist.
     *
     * @param $path
     */
    protected function createFileDirectoryIfNeeded($path)
    {
        if (!file_exists($path)) {
            mkdir($path);
        }
    }

    /**
     * Write the table content to the file.
     *
     * @param $file
     * @param $tableContent
     */
    protected function writeTableContent($file, $tableContent)
    {
        foreach ($tableContent as $key => $answer) {
            fputcsv($file, (array) $answer, $this->delimiters, $this->wrapper);
        }
    }

    /**
     * Write the table headers to the file.
     *
     * @param $file
     * @param $tableContent
     */
    protected function writeTableHeaders($file, $tableContent)
    {
        fputcsv($file, array_keys((array) $tableContent[0]), $this->delimiters, $this->wrapper);
    }
}
