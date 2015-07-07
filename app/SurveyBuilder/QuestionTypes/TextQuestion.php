<?php

namespace These\SurveyBuilder\QuestionTypes;

/**
 * Class TextQuestion.
 */
class TextQuestion extends BaseQuestion implements Question
{
    /**
     * Build the HTML to render the question.
     *
     * @return string
     */
    public function buildHtml()
    {
        $this->htmlBody .= $this->questionHtmlTitle();
        $fieldName = $this->question->field_name;

        $options = [
            'name'  => $fieldName,
            'type'  => 'text',
            'class' => $this->class,
        ];

        // If the question has old input from previous submitions, fill it
        if ($this->questionHasOldInput($fieldName)) {
            $options = array_add($options, 'value', $this->oldInput[$fieldName]);
        }

        $options = $this->buildQuestionOptions($options);

        $this->htmlBody .= $this->tagBuilder->make('input', null, $options);

        $this->htmlBody .= $this->questionHtmlInfo($fieldName);

        $this->htmlBody = $this->surround($this->htmlBody);

        return $this->htmlBody;
    }
}
