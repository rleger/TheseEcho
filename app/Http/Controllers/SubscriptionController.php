<?php

namespace These\Http\Controllers;

use Exception;
use Input;
use Mailchimp_List_NotSubscribed;
use These\Answers\AnswersRepository;
use These\Answers\Exceptions\NoAnswerFoundWithThisMailException;
use These\Http\Requests\SubscribeEmailFormRequest;
use These\MedicalCenter\MedicalCenterRepository;
use These\Newsletters\NewsletterList;
use These\Subscriptions\SubscriptionService;
use These\MedicalCenter\ImportMedicalCentersInNewsletterManager;

/**
 * Class SubscriptionController.
 */
class SubscriptionController extends Controller
{
    /**
     * @var AnswersRepository
     */
    protected $answers;

    /**
     * @var NewsletterList
     */
    protected $newsletter;

    /**
     * Subscription service.
     *
     * @var SubscriptionService
     */
    protected $subscriptionService;

    /**
     * Constructor.
     *
     * @param AnswersRepository   $answers
     * @param NewsletterList      $newsletter
     * @param SubscriptionService $subscriptionService
     */
    public function __construct(AnswersRepository $answers, NewsletterList $newsletter, SubscriptionService $subscriptionService)
    {
        // Check for unsupportedBrowser
        $this->middleware('supportedBrowser');

        $this->answers = $answers;

        $this->newsletter = $newsletter;

        $this->subscriptionService = $subscriptionService;
    }

    /**
     * Subscribe an answerer to a given list.
     *
     * @param null                      $toWhat
     * @param SubscribeEmailFormRequest $formRequest
     *
     * @throws Exception
     *
     * @return \Illuminate\View\View
     */
    public function subscribeAnswerer($toWhat = null, SubscribeEmailFormRequest $formRequest)
    {
        extract(Input::all());

        // We need a field with answer id, otherwise throw an exception
        if (!isset($answer_id)) {
            throw new Exception('Missing Answer Id');
        }

        // Update email if provided, update the record
        if (isset($email)) {
            $this->answers->updateEmailFor($answer_id, $email);
        }

        try {
            // Check that the list is valid
            $this->newsletter->checkListExists($toWhat);
            // Subscribe
            $this->subscriptionService->subscribeAnswerer($answer_id, [$toWhat]);
        } catch (Exception $e) {
            return view('errors.generic', ['message' => $e->getMessage()]);
        }

        return view('survey.subscribed', compact('answer_id', 'email'));
    }

    /**
     * Unsubscribe an answerer from a list.
     *
     * @param null $fromWhat
     *
     * @return \Illuminate\View\View
     *
     * @throws Exception
     */
    public function unSubscribeAnswerer($fromWhat = null)
    {
        extract(Input::all());

        // We need a field with answer id, otherwise throw an exception
        if (!isset($answer_id)) {
            throw new Exception('Missing Answer Id');
        }

        try {
            // Check that the list is valid
            $this->newsletter->checkListExists($fromWhat);
            // Subscribe
            $this->subscriptionService->unSubscribeAnswerer($answer_id, [$fromWhat]);
        } catch (Exception $e) {
            return view('errors.generic', ['message' => $e->getMessage()]);
        }

        return view('survey.unsubscribed', compact('answer_id'));
    }

    ////////////////////////////////
    // Survey result mailing list //
    ////////////////////////////////

    /**
     * Subscribe to result.
     *
     * @param $answer_id
     *
     * @internal param $email
     *
     * @return \Illuminate\View\View
     */
    public function subscribeToResults($answer_id)
    {
        // Subscribe answerer to email
        // $this->subscriptionService->subscribeAnswerer($answer_id, ['ALR_results']);

        // return view('survey.subscribed', compact('answer_id'));

        // $subscriptionService->subscribeAnswererToResults($answer_id);

        // try {
        // } catch (NoAnswerFoundWithThisMailException $e)list
        // {
        //     return view('survey.error', ["message" => "Le mail n'existe pas dans la base de donnée !"]);
        // } catch (\Mailchimp_List_AlreadySubscribed $e)
        // {
        //     return view('survey.subscribed', compact('answer_id'));
        // }
        // // dd('subs');
        // // Thank you for subscribing view
        // return view('survey.subscribed', compact('answer_id'));

        /*

                // Update database record
                try {
                    $this->answers->subscribeToResults($email);
                } catch (NoAnswerFoundWithThisMailException $e)
                {
                    return view('survey.error', ["message" => "Le mail $email n'existe pas dans la base de donnée !"]);
                }

                // Subscribe to mailing list
                try {
                    $this->newsletter->subscribeTo('ALR_results', $email);
                } catch (\Mailchimp_List_AlreadySubscribed $e)
                {
                    return view('survey.subscribed', compact('email'));
                }

                // Thank you for subscribing view
                return view('survey.subscribed', compact('email'));
            */
    }

    /**
     * Unsubscribe from results.
     *
     * @param $email
     *
     * @return \Illuminate\View\View
     */
    public function unSubscribeFromResults($email)
    {
        // Update database record
        try {
            $this->answers->unSubscribeToResults($email);
        } catch (NoAnswerFoundWithThisMailException $e) {
            return view('survey.error', ['message' => "Le mail $email n'existe pas dans la base de donnée !"]);
        }

        // Unsubscribe from mailing list
        try {
            $this->newsletter->unSubscribeFrom('ALR_results', $email);
        } catch (Mailchimp_List_NotSubscribed $e) {
            return view('survey.unsubscribed', compact('email'));
        }

        // Thank you for unsubscribing view
        return view('survey.unsubscribed', compact('email'));
    }

    //////////////////////////////////
    // Medical Centers Mailing list //
    //////////////////////////////////

    /**
     * Subscribing mail centers from database
     * Reads all entries from medical center table and import them into Newletter manager.
     *
     * @param ImportMedicalCentersInNewsletterManager $importMedicalCentersInNewletterManager
     *
     * @return string
     *
     * @internal param MedicalCenterRepository $medicalCenterRepository
     */
    public function importCentersInNewsletterManager(ImportMedicalCentersInNewsletterManager $importMedicalCentersInNewletterManager)
    {
        $importerResult = $importMedicalCentersInNewletterManager->import();

        // Response
        return $importerResult->getContent();
    }
}
