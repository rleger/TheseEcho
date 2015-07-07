<?php

namespace These\SurveyBuilder\QuestionTypes;

/**
 * Class TextQuestion.
 */
class TextareaQuestion extends BaseQuestion implements Question
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
            'class' => $this->class,
        ];

        // If the question has content from another submition, fill it
        $oldContent = ($this->questionHasOldInput($fieldName)) ? $this->oldInput[$fieldName] : null;

        $options = $this->buildQuestionOptions($options);

        $this->htmlBody .= $this->tagBuilder->make('textarea', $oldContent, $options);

        $this->htmlBody .= $this->questionHtmlInfo($fieldName);

        $this->htmlBody = $this->surround($this->htmlBody);

        return $this->htmlBody;
    }
}
