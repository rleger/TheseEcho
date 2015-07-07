<?php

namespace These\Console\Commands;

use Illuminate\Console\Command;
use These\MedicalCenter\ImportMedicalCentersInNewsletterManager;

/**
 * Class ImportCentersInNewsletterManagerCommand.
 */
class ImportCentersInNewsletterManagerCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'these:ImportCentersInNewsletterManager';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Medical Centers in Newsletter Manager.';

    /**
     * Create a new command instance.
     */
    protected $importMedicalCentersInNewletterManager;

    /**
     * Constructor.
     *
     * @param ImportMedicalCentersInNewsletterManager $importer
     */
    public function __construct(ImportMedicalCentersInNewsletterManager $importer)
    {
        parent::__construct();

        $this->importMedicalCentersInNewletterManager = $importer;
    }

    /**
     * Execute the console command.
     *
     * @return Illuminate\Contracts\Routing\ResponseFactory Respxonse
     */
    public function fire()
    {
        $importerResult = $this->importMedicalCentersInNewletterManager->import();

        $this->comment($importerResult->getContent().PHP_EOL);
    }
}
