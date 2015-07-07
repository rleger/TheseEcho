<?php

namespace These\SurveyBuilder;

use Input;

class Question
{
    /**
     *
     */
    const QUESTION_INFO = 'info';
    /**
     *
     */
    const QUESTION_TITLE = 'title';
    /**
     *
     */
    const QUESTION_FIELDS = 'fields';

    /**
     * @var
     */
    protected $question;

    protected $oldInput;

    public function __construct($question)
    {
        $this->question = $question;

        $this->oldInput = Input::old();
    }

    protected function hasOldInput($fieldName, $index = null)
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
    protected function htmlInfo($targetField = null)
    {
        if ($this->questionHas('info')) {
            $options = ['class' => 'question-info'];

            $options = $this->addOptions($options, $this->global_questions_param[Self::QUESTION_INFO]);

            // If $targetField is set, add data-info-for-field info
            $options = $this->addTargetDataField($targetField, $options);

            return $this->tagBuilder->make('hr')
                ->nest('div', $this->question->info, $options);
        }
    }
}
