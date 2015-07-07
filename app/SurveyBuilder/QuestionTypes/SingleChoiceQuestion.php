<?php

namespace These\SurveyBuilder\QuestionTypes;

/**
 * Class TextQuestion.
 */
class SingleChoiceQuestion extends BaseQuestion implements Question
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

        foreach ($this->question->values as $index => $value) {
            $options = ['name' => $fieldName, 'type' => 'radio', 'value' => $index];

            if ($this->questionHasOldInput($fieldName, $index)) {
                $options = array_add($options, 'checked', 'checked');
            }

            $options = $this->buildQuestionOptions($options);

            $this->htmlBody .= $this->tagBuilder
                ->make('div', null, ['class' => 'radio'])
                ->nest('label', $value)
                ->nest('input', null, $options);

            $this->htmlBody .= $this->questionConditions($index, $fieldName);
        }

        $this->htmlBody .= $this->questionHtmlInfo($fieldName);

        $this->htmlBody = $this->surround($this->htmlBody);

        return $this->htmlBody;
    }
}
