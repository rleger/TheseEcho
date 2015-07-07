<?php

namespace These\MedicalCenter;

use Illuminate\Contracts\Routing\ResponseFactory;
use These\Newsletters\NewsletterList;

/**
 * Import all medical centers into newsletter manager (like mailchimp for instance).
 *
 * Class ImportMedicalCentersInNewsletterManager
 */
class ImportMedicalCentersInNewsletterManager
{
    /**
     * @var MedicalCenterRepository
     */
    protected $medicalCenterRepository;

    /**
     * @var NewsletterList
     */
    protected $newsletter;

    /**
     * @var ResponseFactory
     */
    protected $response;

    /**
     * Constructor.
     *
     * @param MedicalCenterRepository $medicalCenterRepository
     * @param NewsletterList          $newsletter
     * @param ResponseFactory         $response
     */
    public function __construct(MedicalCenterRepository $medicalCenterRepository, NewsletterList $newsletter, ResponseFactory $response)
    {
        $this->newsletter = $newsletter;

        $this->medicalCenterRepository = $medicalCenterRepository;

        $this->response = $response;
    }

    /**
     * Importer class.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function import()
    {
        $index = 0;
        $batch = [];

        foreach ($this->medicalCenterRepository->all() as $index => $medCenter) {
            $email = $medCenter->email;

            if ($email === '') {
                continue;
            }

            $batch[] = [
                'email'      => compact('email'),
                'merge_vars' => [
                    'TOKEN'   => $medCenter->token,
                    'NAME'    => $medCenter->name,
                    'COUNTRY' => $medCenter->country,
                    'EMAIL'   => $medCenter->email,
                ],
            ];
        }

        // Subscribe to Newsletter
        $results = $this->newsletter->batchSubscribeTo('TheseEcho', $batch, false, true);

        // Errors
        if ($results['error_count']) {
            return $this->response->make('There are errors '.print_r($results['errors']).'.', 405);
        }

        // Success
        return $this->response->make("Subscribed $index centers.", 200);
    }
}
