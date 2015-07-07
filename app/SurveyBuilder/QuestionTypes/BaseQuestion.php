<?php

namespace These\SurveyBuilder\QuestionTypes;

use App;
use Input;
use These\SurveyBuilder\SurveyBuilder;
use These\TagBuilder\TagBuilder;

/**
 * Class BaseQuestion.
 */

/**
 * Class BaseQuestion.
 */
abstract class BaseQuestion
{
    /**
     * Question Info Field.
     */
    const QUESTION_INFO = 'info';

    /**
     * Question Title Field.
     */
    const QUESTION_TITLE = 'title';

    /**
     * Question input field.
     */
    const QUESTION_FIELDS = 'fields';

    /**
     * Subquestion field.
     */
    const SUBQUESTION = 'subquestion';

    /**
     * Initial Subquestion CSS class.
     */
    const SUBQUESTION_INITIAL_CSS_CLASS = 'mtl hide';

    /**
     * @var string
     */
    protected $defaultCSSClass = 'form-control';

    /**
     * Question object.
     *
     * @var
     */
    protected $question;

    /**
     * @var null
     */
    protected $config;

    /**
     * @var string
     */
    protected $class = '';

    /**
     * @var array
     */
    protected $surround_questions_with = [];

    /**
     * @var array
     */
    protected $global_questions_param = [];

    /**
     * @var string
     */
    protected $htmlBody = '';

    /**
     * TagBuilder.
     *
     * @var These\TagBuilder\TagBuilder
     */
    protected $tagBuilder;

    /**
     * Old input from failed validation.
     *
     * @var
     */
    protected $oldInput;

    /**
     * Constructor.
     *
     * @param      $question
     * @param null $config
     */
    public function __construct($question, $config = null)
    {
        $this->tagBuilder = App::make(TagBuilder::class);

        $this->initializeFields($question, $config);

        $this->loadHtmlConfig();
    }

    /**
     * Find out if a question has old inputs (from validation).
     *
     * @param      $fieldName
     * @param null $index
     *
     * @return bool
     */
    protected function questionHasOldInput($fieldName, $index = null)
    {
        // If the question has oldInputs
        if (array_key_exists($fieldName, $this->oldInput)) {
            // If index is null its a single field (not radio or checkbox)
            if (is_null($index)) {
                return true;
            }

            if (is_array($this->oldInput[$fieldName])) {
                // If its an array (checkbox), check its value
                return (array_key_exists($index, $this->oldInput[$fieldName]) && $this->oldInput[$fieldName][$index] === $index);
            } else {
                // Its a radio button, check its value
                return ($this->oldInput[$fieldName] === $index);
            }
        }

        return false;
    }

    /**
     * Return Html question info.
     *
     * @param null $targetField
     *
     * @return mixed
     */
    protected function questionHtmlInfo($targetField = null)
    {
        if ($this->questionHas('info')) {
            $options = ['class' => 'question-info'];

            $options = $this->addOptions($options, $this->global_questions_param[Self::QUESTION_INFO]);

            // If $targetField is set, add data-info-for-field info
            $options = $this->addDataInfoTargetField($targetField, $options);

            return $this->tagBuilder->make('hr')->nest('div', $this->question->info, $options);
        }
    }

    /**
     * @param $index
     *
     * @return string
     */
    protected function questionConditions($index, $parentName = '')
    {
        $htmlOutput = '';

        // If there are conditions for that question
        if ($this->questionHas(Self::SUBQUESTION)) {
            $conditions = objectToArray($this->question->{Self::SUBQUESTION});

            // ... for this question
            if (array_key_exists($index, $conditions)) {
                // .. go through each, (true, false)
                foreach ($this->question->{Self::SUBQUESTION}->$index as $condition => $question) {
                    $htmlOutput .= "<div class='sub-questions-group'>";
                    // .. subquestion
                    foreach ($question as $subQuestion) {
                        // Surrounding div
                        $subQuestion->config->surround_questions_with['tag'] = 'div';
                        $subQuestion->config->surround_questions_with['options'] = [
                            'class'          => 'question-sub '.Self::SUBQUESTION_INITIAL_CSS_CLASS,
                            'data-original'  => ($parentName !== '') ? $parentName : $index,
                            'data-condition' => $condition,
                            'data-on'        => $index,
                        ];

                        // Field
                        $subQuestion->options = ['data-condition' => $condition, 'class' => 'subquestion'];

                        $processedQuestion = (new SurveyBuilder())->processSubQuestion($subQuestion);

                        $htmlOutput .= $processedQuestion['html'];
                    }
                    $htmlOutput .= '</div>';
                }
            }
        }

        return $htmlOutput;
    }

    /**
     * Check if question has a given property.
     *
     * @param $what
     *
     * @return bool
     */
    protected function questionHas($what)
    {
        return (isset($this->question->$what) && !is_null($this->question->$what));
    }

    /**
     * Returns Html question title.
     *
     * @return mixed
     */
    protected function questionHtmlTitle()
    {
        if (!$this->questionHas('title')) {
            return;
        }

        $options = [];
        if (isset($this->global_questions_param[Self::QUESTION_TITLE])) {
            $options = $this->addOptions($options, $this->global_questions_param[Self::QUESTION_TITLE]);
        }

        return $this->tagBuilder->make('div', $this->question->title, $options);
    }

    /**
     * Returns question options.
     *
     * @return mixed
     */
    protected function questionOptions()
    {
        if (!$this->questionHas('options')) {
            return [];
        }

        return objectToArray($this->question->options);
    }

    /**
     * Build Question Options.
     *
     * @param array $options
     *
     * @return array|mixed
     */
    protected function buildQuestionOptions($options = [])
    {
        // If there are global options for that question append them
        if (isset($this->global_questions_param[Self::QUESTION_FIELDS])) {
            $options = $this->addOptions($options, $this->global_questions_param[Self::QUESTION_FIELDS]);
        }

        // Append options that may be contained in the json file
        $options = $this->addOptions($options, $this->questionOptions());

        return $options;
    }

    /**
     * Add options to an existing options array, will append existing options if conflicting.
     *
     * @param       $currentOptions
     * @param array $optionsToAdd
     * @param bool  $append
     *
     * @return mixed
     */
    protected function addOptions($currentOptions, $optionsToAdd = [], $append = true)
    {
        foreach ($optionsToAdd as $option => $value) {
            if (array_key_exists($option, $currentOptions) && $append) {
                $currentOptions[$option] .= ' '.$value;
            } else {
                $currentOptions[$option] = $value;
            }
        }

        return $currentOptions;
    }

    /**
     * Load HTML config.
     */
    protected function loadHtmlConfig()
    {
        // Build question CSS Class
        $this->class = $this->buildCSSClass();

        // Set surround with array
        if ($this->surroundWithIsSet()) {
            $this->surround_questions_with = [
                'tag'     => $this->config['surround_questions_with']['tag'],
                'options' => (isset($this->config['surround_questions_with']['options']))
                    ? (array) $this->config['surround_questions_with']['options']
                    : [],
            ];
        }

        if (isset($this->config['global_questions_param'])) {
            $this->global_questions_param = $this->config['global_questions_param'];
        }
    }

    /**
     * Build CSS Class.
     *
     * @param null $typeClass
     *
     * @internal param $question
     * @internal param null $questionClass
     *
     * @return string
     */
    public function buildCSSClass($typeClass = null)
    {
        $questionClass = ($this->questionHas('class')) ? $this->question->class : '';

        $questionFieldNameClass = ($this->questionHas('field_name')) ? $this->question->field_name : '';

        return trim(implode(' ', [$this->defaultCSSClass, $questionFieldNameClass, $questionClass, $typeClass]));
    }

    /**
     * Surround result with a tag.
     *
     * @param       $body
     * @param array $options
     *
     * @return mixed
     */
    protected function surround($body, $options = [])
    {
        if (!$this->surround_questions_with) {
            return $body;
        }

        // Surround questions with options
        $options = $this->addOptions($this->surround_questions_with['options'], $options);

        // Add data-field-name attribute to surrounding div
        $fieldNameDataAttribute = (isset($this->question->field_name))
            ? ['data-field-name' => $this->question->field_name]
            : [];

        $options = $this->addOptions($fieldNameDataAttribute, $options);

        return $this->tagBuilder->make($this->surround_questions_with['tag'], $body, $options);
    }

    /**
     * Find out if Surround with property is set.
     *
     * @return bool
     */
    protected function surroundWithIsSet()
    {
        return isset($this->config) && isset($this->config['surround_questions_with']) && isset($this->config['surround_questions_with']['tag']);
    }

    /**
     * Initialize object fields.
     *
     * @param $question
     * @param $config
     */
    protected function initializeFields($question, $config)
    {
        $this->question = $question;

        $this->config = $config;

        $this->oldInput = Input::old();
    }

    /**
     * Add Question Info Target Data Field.
     *
     * @param $targetField
     * @param $options
     *
     * @return array
     */
    protected function addDataInfoTargetField($targetField, $options)
    {
        $options = (is_null($targetField)) ? $options : array_add($options, 'data-info-for-field', $targetField);

        return $options;
    }
}
