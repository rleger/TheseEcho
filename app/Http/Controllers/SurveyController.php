<?php

namespace These\Http\Controllers;

use Redirect;
use Config;
use Illuminate\Filesystem\Filesystem;
use These\Answers\AnswersDTO;
use These\Answers\AnswersRepository;
use These\Answers\Exceptions\EmailExistsException;
use These\Http\Requests\AnswersFormRequest;
use These\MedicalCenter\MedicalCenter;
use These\SurveyBuilder\SurveyBuilder;
use These\MedicalCenter\MedicalCenterRepository;
use Illuminate\Contracts\Events\Dispatcher;
use These\Events\SurveyWasSubmitted;

/**
 * Class SurveyController.
 */
class SurveyController extends Controller
{
    /**
     * Medical Center Repository.
     *
     * @var
     */
    protected $medicalCenterRepository;

    /**
     * Constructor.
     *
     * @param MedicalCenterRepository $medicalCenterRepository
     */
    public function __construct(MedicalCenterRepository $medicalCenterRepository)
    {
        // Check for unsupportedBrowser
        $this->middleware('supportedBrowser');

        $this->medicalCenterRepository = $medicalCenterRepository;
    }

    /**
     * Index, main view for results.
     *
     * @param SurveyBuilder $survey
     * @param Filesystem    $filesystem
     * @param int           $token
     *
     * @throws \Illuminate\Filesystem\FileNotFoundException
     *
     * @return \Illuminate\View\View
     */
    public function index(SurveyBuilder $survey, Filesystem $filesystem, $token = MedicalCenter::UNKNOWN_MEDICAL_CENTER_ID)
    {
        // Get the medical center Id
        $medical_center_id = $this->medicalCenterTokenToId($token);

        // Read Survey File
        $surveyContent = $filesystem->get(public_path().Config::get('These.survey.json_file_path'));

        // Make survey
        $questions = $survey->make($surveyContent);

        return view('survey.generated', compact('questions', 'medical_center_id'));
    }

    /**
     * Temp Store survey.
     *
     * @param AnswersFormRequest $request
     * @param AnswersRepository  $answerRepository
     *
     * @internal param AnswersRepository $repo
     *
     * @return \Illuminate\View\View
     */
    public function store(AnswersFormRequest $request, AnswersRepository $answerRepository, Dispatcher $dispatcher)
    {
        // Make an answers DTO from Inputs
        $answersDTO = new AnswersDTO(serializeArray($request->all()));

        // Create an Answer if email does not already exists
        try {
            $saved = $answerRepository->createAndSaveIfUnique($answersDTO->toArray());

            $dispatcher->fire(new SurveyWasSubmitted($saved->id));
        } catch (EmailExistsException $e) {
            return view('survey.alreadySubmitted', ['email' => $answersDTO->email]);
        }

        return Redirect::route('answer.saved', ['email' => ($answersDTO->email) ?: '', 'answer_id' => $saved->id]);
    }

    /**
     * Returns an array containing questions titles and names from json Questionnaire file.
     *
     * @param Filesystem $filesystem
     *
     * @return array
     *
     * @throws \Illuminate\Filesystem\FileNotFoundException
     */
    public function getQuestionsTitleAndName(Filesystem $filesystem)
    {
        $questions = [];

        $surveyContent = json_decode($filesystem->get(public_path().Config::get('These.survey.json_file_path')));

        $allQuestions = $surveyContent->questions;

        foreach ($allQuestions as $index => $question) {
            $questionData = [];

            if (isset($question->title)) {
                $questionData['title'] = $question->title;
            }

            if (isset($question->field_name)) {
                $questionData['field_name'] = $question->field_name;
            }

            $questions[] = $questionData;
        }

        return $questions;
    }

    /**
     * Convert passed medical center token to Id.
     *
     * @param $token
     *
     * @return int
     */
    protected function medicalCenterTokenToId($token)
    {
        return $this->medicalCenterRepository->getIdWithToken($token);
    }
}
