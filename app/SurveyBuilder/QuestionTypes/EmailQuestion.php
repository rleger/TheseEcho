<?php

namespace These\SurveyBuilder\QuestionTypes;

/**
 * Class EmailQuestion.
 */
class EmailQuestion extends BaseQuestion implements Question
{
    /**
     * Build the HTML to render the question.
     *
     * @return string
     */
    public function buildHtml()
    {
        $this->htmlBody .= $this->questionHtmlTitle();

        $options = [
            'name'  => $this->question->field_name,
            'type'  => 'email',
            'class' => $this->class,
        ];

        $options = $this->buildQuestionOptions($options);

        $this->htmlBody .= $this->tagBuilder->make('input', null, $options);

        $this->htmlBody .= $this->questionHtmlInfo($this->question->field_name);

        $this->htmlBody = $this->surround($this->htmlBody);

        return $this->htmlBody;
    }
}
