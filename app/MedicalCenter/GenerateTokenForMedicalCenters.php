<?php

namespace These\MedicalCenter;

use Exception;

/**
 * Class GenerateTokenForMedicalCenters.
 */
class GenerateTokenForMedicalCenters
{
    /**
     * @var MedicalCenterRepository
     */
    protected $medicalCenter;

    /**
     * Create a new command instance.
     *
     * @param MedicalCenterRepository $medicalCenter
     */
    public function __construct(MedicalCenterRepository $medicalCenter)
    {
        $this->medicalCenter = $medicalCenter;
    }

    /**
     * Execute the console command.
     *
     * @param null $notUnique
     * @param null $overwrite
     *
     * @return mixed
     */
    public function generate($notUnique = null, $overwrite = null)
    {
        // Get the collection that will be updated
        $mcCollection = $this->getMedicalCenterCollection($overwrite);

        // Update the collection and return numberOfTokenUpdated
        return $this->updateCollection($mcCollection, $notUnique);
    }

    /**
     * Get the medical center collection that will be updated.
     *
     * @param $overwrite
     *
     * @return mixed
     */
    protected function getMedicalCenterCollection($overwrite)
    {
        if ($overwrite) {
            $mcCollection = $this->medicalCenter->getAllButUnknownMedicalCenter();

            return $mcCollection;
        } else {
            $mcCollection = $this->medicalCenter->getWithTokenNotSetButUnknownMedicalCenter();

            return $mcCollection;
        }
    }

    /**
     * @param $mcCollection
     * @param $notUnique
     *
     * @return mixed
     *
     * @throws Exception
     *
     * @internal param $numberOfTokendated
     */
    protected function updateCollection($mcCollection, $notUnique)
    {
        $numberOfTokenUpdated = 0;

        foreach ($mcCollection as $medicalCenter) {
            $token = $this->makeRandomToken();

            if (!$notUnique) {
                $token = $this->makeUniqueToken($token);
            }

            if ($this->updateToken($token, $medicalCenter)) {
                $numberOfTokenUpdated++;
            }
        }

        return $numberOfTokenUpdated;
    }

    /**
     * Make a random token.
     *
     * @return string
     */
    protected function makeRandomToken()
    {
        return substr(md5(uniqid(null, true)), 0, 8);
    }

    /**
     * Make sure token is unique or throw an exception.
     *
     * @param $token
     *
     * @return string
     *
     * @throws Exception
     */
    protected function makeUniqueToken($token)
    {
        $tries = 0;

        // Loop while token is not unique
        while ($this->medicalCenter->withTokenExists($token)) {
            $token = $this->makeRandomToken();

            $tries++;

            if ($tries > 30) {
                throw new Exception('Cannot make token unique', 1);
            }
        }

        return $token;
    }

    /**
     * Update the token for a medical center item.
     *
     * @param $token
     * @param $medicalCenter
     *
     * @return bool
     */
    protected function updateToken($token, MedicalCenter $medicalCenter)
    {
        $medicalCenter->token = $token;

        return $medicalCenter->save();
    }
}
