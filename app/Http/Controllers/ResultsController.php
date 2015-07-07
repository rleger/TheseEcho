<?php

namespace These\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;
use These\Answers\Answers;
use These\Events\Logger\FileLogger;
use These\Http\Requests\AdminPageRequest;
use These\Results\ResultsRepository;
use These\Results\ResultsService;
use These\SurveyBuilder\QuestionTranslator;

/**
 * Class ResultsController.
 */
class ResultsController extends Controller
{
    /**
     * @var ResultsRepository
     */
    protected $results;

    /**
     * @var ResultsService
     */
    protected $resultsService;

    /**
     * Constructor.
     *
     * @param ResultsService $resultsService
     *
     * @internal param ResultsRepository $results
     */
    public function __construct(ResultsService $resultsService)
    {
        // Require authenticated user
        $this->middleware('auth');

        // Check for unsupportedBrowser
        $this->middleware('supportedBrowser');

        $this->resultsService = $resultsService;
    }

    /**
     * Show main result page.
     *
     * @param ResultsRepository $resultsRepository
     *
     * @return \Illuminate\View\View
     */
    public function index(ResultsRepository $resultsRepository)
    {
        $participants = $resultsRepository->participants();
        $centres_participants = $resultsRepository->centres_participants();
        $centres_non_participants = $resultsRepository->centres_non_participants();
        $results = $resultsRepository;

        return view('results.index', compact('participants', 'centres_participants', 'centres_non_participants', 'results'));
    }

    /**
     * Administartion.
     *
     * @param Filesystem $filesystem
     *
     * @return \Illuminate\View\View
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function admin(Filesystem $filesystem, AdminPageRequest $request)
    {
        $applicationLogFilePath = (new FileLogger())->getLogFilePath();

        $applicationLog = ($filesystem->exists($applicationLogFilePath)) ? $filesystem->get($applicationLogFilePath) : null;

        $systemLogs = $filesystem->files(storage_path().'/logs');

        $systemLogs = array_reverse(array_filter(array_map(function ($value) use ($applicationLogFilePath) {

            if ($value !== $applicationLogFilePath) {
                $updated_at = date('Y-m-d H:i:s.', filemtime($value));

                $logFile['filename'] = pathinfo($value, PATHINFO_BASENAME);
                $logFile['filesize'] = filesize($value);
                $logFile['humanFilesize'] = humanFilesize(filesize($value));
                $logFile['updated_at'] = $updated_at;
                $logFile['updated_at_for_humans'] = Carbon::parse($updated_at)->diffForHumans();

                return $logFile;
            }
        }, $systemLogs)));

        return view('results.admin', compact('applicationLog', 'systemLogs'));
    }

    /**
     * Show table list of all answers.
     *
     * @param QuestionTranslator $questionTranslator
     *
     * @return \Illuminate\View\View
     */
    public function listAllAnswers(QuestionTranslator $questionTranslator)
    {
        $nbAnswer = $this->resultsService->nbAnswer();

        $groupped = $this->resultsService->answersArray();

        return view('results.full-list', compact('groupped', 'nbAnswer', 'questionTranslator'));
    }

    /**
     * Show exploded table list of all answers.
     *
     * @param QuestionTranslator $questionTranslator
     *
     * @return \Illuminate\View\View
     */
    public function listAllExplodedAnswers(QuestionTranslator $questionTranslator)
    {
        $answersId = $this->resultsService->listIds();
        // Sorting by val
        asort($answersId);

        $groupped = $this->resultsService->answersExplodedArray();

        return view('results.exploded-list', compact('groupped', 'answersId', 'questionTranslator'));
    }

    /**
     * Analyse.
     *
     * @param QuestionTranslator $questionTranslator
     *
     * @return \Illuminate\View\View
     */
    public function analyse(QuestionTranslator $questionTranslator)
    {
        $nbAnswer = $this->resultsService->nbAnswer();

        $groupped = $this->resultsService->grouppedResults();

        return view('results.analyse', compact('groupped', 'nbAnswer', 'questionTranslator'));
    }
}
