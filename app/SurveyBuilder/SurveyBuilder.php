<?php

namespace These\SurveyBuilder;

/*
 * Class SurveyBuilder
 * @package These\SurveyBuilder
 */
use These\SurveyBuilder\Exceptions\InvalidQuestionTypeException;

/**
 * Class SurveyBuilder.
 */
class SurveyBuilder
{
    /**
     * @var array
     */
    protected $allowedQuestionType = ['heading', 'text', 'textarea', 'email', 'select', 'multiple_choice', 'single_choice'];

    /**
     * @var array
     */
    protected $renderedSurvey = [];

    /**
     * @var
     */
    protected $questions;

    /**
     * @var
     */
    protected $config;

    /**
     * Entry point.
     *
     * @param $jsonSurveyContent
     *
     * @internal param $file
     *
     * @return string
     */
    public function make($jsonSurveyContent)
    {
        $allQuestions = json_decode($jsonSurveyContent);

        $this->initializeFields($allQuestions);

        $this->processQuestions();

        return $this->renderedSurvey;
    }

    /**
     * Process all questions.
     *
     * @internal param $allQuestions
     */
    public function processQuestions()
    {
        foreach ($this->questions as $question) {
            $this->processQuestion($question);
        }
    }

    /**
     * Generic Question processor.
     *
     * @param       $question
     * @param       $config
     * @param array $options
     *
     * @return mixed
     *
     * @throws InvalidQuestionTypeException
     */
    protected function processGenericQuestion($question, $config, $options = [])
    {
        $questionHandler = $this->resolveQuestionHandlerClass($question);

        $config = objectToArray($config);

        return array_merge([
            'field_name' => isset($question->field_name) ? $question->field_name : null,
            'html'       => (new $questionHandler($question, $config))->buildHtml(),
        ], $options);
    }

    /**
     * Process main questions.
     *
     * @param $question
     */
    protected function processQuestion($question)
    {
        $this->renderedSurvey[] = $this->processGenericQuestion($question, $this->config);
    }

    /**
     * Process sub-Questions.
     *
     * @param $question
     *
     * @return array
     *
     * @throws InvalidQuestionTypeException
     */
    public function processSubQuestion($question)
    {
        return $this->processGenericQuestion($question, $question->config);
    }

    /**
     * Resolve the question handler class.
     *
     * @param $question
     *
     * @throws InvalidQuestionTypeException
     *
     * @return string
     */
    protected function resolveQuestionHandlerClass($question)
    {
        // If type was not set, default to text
        $type = (isset($question->type)) ? $question->type : 'text';

        // If the question type is not valid, throw an exception
        if (!in_array($type, $this->allowedQuestionType)) {
            throw new InvalidQuestionTypeException();
        }

        $classname = $this->getQuestionHandlerClassName($type);

        return $classname;
    }

    /**
     * Get the question handler class name
     * Append Question to the type.
     *
     * @param $type
     *
     * @return string
     */
    protected function getQuestionHandlerClassName($type)
    {
        // Remove underscores or spaces and capitalize following letter
        $classname = preg_replace_callback('/(?<=( |_))./', function ($m) {
            return strtoupper($m[0]);
        }, $type);

        // Remove underscores and Capitalize first letter
        $classname = str_replace('_', '', ucfirst($classname).'Question');

        // Append namespace
        $classname = __NAMESPACE__.'\\QuestionTypes\\'.$classname;

        return $classname;
    }

    /**
     * Initialize the fields.
     *
     * @param $allQuestions
     */
    protected function initializeFields($allQuestions)
    {
        $this->questions = $allQuestions->questions;

        $this->config = $allQuestions->config;
    }
}
