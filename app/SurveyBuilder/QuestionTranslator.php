<?php

namespace These\SurveyBuilder;

use Config;
use Illuminate\Filesystem\Filesystem;

/**
 * Class QuestionValueTranslator.
 */
class QuestionTranslator
{
    /**
     * FileSystem.
     *
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * Value Translation object.
     *
     * @var array
     */
    protected $valueTranslation;

    /**
     * @var array
     */
    protected $questionTitleTranslation;

    /**
     * Constructor.
     *
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;

        $this->valueTranslation = $this->buildValueTranslationArray();

        $this->questionTitleTranslation = $this->buildQuestionsTitleTranslationArray();
    }

    /**
     * Get translation of a field and value.
     *
     * @param      $field
     * @param      $value
     * @param null $default
     *
     * @return string
     */
    public function getField($field, $value, $default = null)
    {
        $default = (is_null($default)) ? $value : $default;

        if (array_key_exists($field, $this->valueTranslation)) {
            return (array_key_exists($value, $this->valueTranslation[$field]))
                ? $this->valueTranslation[$field][$value]
                : $default;
        }

        return $default;
    }

    /**
     * @param      $field
     * @param null $default
     */
    public function getTitle($field, $default = null)
    {
        $default = (is_null($default)) ? $field : $default;

        return (array_key_exists($field, $this->questionTitleTranslation))
            ? $this->questionTitleTranslation[$field]
            : $default;
    }

    /**
     * Build the translation array.
     *
     * @return array
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildQuestionsTitleTranslationArray()
    {
        $surveyContent = $this->filesystem->get(public_path().Config::get('These.survey.json_file_path'));
        $questions = objectToArray(json_decode($surveyContent))['questions'];
        $valueTranslation = [];

        foreach ($questions as $index => $question) {
            // If the question has a value, translate it
            if (array_key_exists('field_name', $question)) {
                $valueTranslation[$question['field_name']] = strip_tags($question['title']);
            }

            // If the question is a subquestion...
            if (array_key_exists('subquestion', $question)) {
                // go through each field
                foreach ($question['subquestion'] as $subIndex => $subQuestion) {
                    // Then the condition
                    foreach ($subQuestion as $condition => $question) {
                        // Finally scan all questions
                        foreach ($question as $index => $question) {
                            if (array_key_exists('field_name', $question)) {
                                $valueTranslation[$question['field_name']] = strip_tags($question['title']);
                            }
                        }
                    }
                }
            }
        }

        return $valueTranslation;
    }

    /**
     * Build the translation array.
     *
     * @return array
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildValueTranslationArray()
    {
        $surveyContent = $this->filesystem->get(public_path().Config::get('These.survey.json_file_path'));
        $questions = objectToArray(json_decode($surveyContent))['questions'];
        $valueTranslation = [];

        foreach ($questions as $index => $question) {
            // If the question has a value, translate it
            if (array_key_exists('values', $question)) {
                $valueTranslation[$question['field_name']] = $question['values'];
            }

            // If the question is a subquestion...
            if (array_key_exists('subquestion', $question)) {
                // go through each field
                foreach ($question['subquestion'] as $subIndex => $subQuestion) {
                    // Then the condition
                    foreach ($subQuestion as $condition => $question) {
                        // Finally scan all questions
                        foreach ($question as $index => $question) {
                            if (array_key_exists('values', $question)) {
                                $valueTranslation[$question['field_name']] = $question['values'];
                            }
                        }
                    }
                }
            }
        }

        return $valueTranslation;
    }
}
