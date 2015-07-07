<?php

namespace These\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use These\MedicalCenter\GenerateTokenForMedicalCenters;

/**
 * Class GenerateTokenForMedicalCentersCommand.
 */
class GenerateTokenForMedicalCentersCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'these:generateTokenForMedicalCenters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remplir la base de MedicalCenter avec un token.';

    /**
     * @var GenerateTokenForMedicalCenters
     */
    protected $generateTokenForMedicalCenters;

    /**
     * Create a new command instance.
     *
     * @param GenerateTokenForMedicalCenters $generateTokenForMedicalCenters
     */
    public function __construct(GenerateTokenForMedicalCenters $generateTokenForMedicalCenters)
    {
        parent::__construct();

        $this->generateTokenForMedicalCenters = $generateTokenForMedicalCenters;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function fire()
    {
        $notUnique = $this->option('notUnique');    // false if not set
        $overwrite = $this->option('overwrite');    // false if not set

        $numberOfTokenUpdated = $this->generateTokenForMedicalCenters->generate($notUnique, $overwrite);

        // Provide feedback to the command line
        $this->comment("$numberOfTokenUpdated token(s) insérés !".PHP_EOL);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['notUnique', null, InputOption::VALUE_NONE, 'Should we generate unique tokens, default: false.', null],
            ['overwrite', null, InputOption::VALUE_NONE, 'Should we overwrite existing tokens, default: false.', null],
        ];
    }
}
