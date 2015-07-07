<?php

namespace These\SurveyBuilder\QuestionTypes;

use Form;

/**
 * Class SelectQuestion.
 */
class SelectQuestion extends BaseQuestion implements Question
{
    protected function htmlConfig()
    {
        parent::htmlConfig();

        $this->class = $this->buildCSSClass('selectpicker');
    }

    /**
     * Build the HTML to render the question.
     *
     * @return string
     */
    public function buildHtml()
    {
        $this->htmlBody .= $this->questionHtmlTitle();

        $options = $this->buildQuestionOptions(['class' => $this->class]);

        $this->htmlBody .= Form::select($this->question->field_name, $this->question->values, null, $options);

        $this->htmlBody .= $this->questionHtmlInfo($this->question->field_name);

        $this->htmlBody = $this->surround($this->htmlBody);

        return $this->htmlBody;
    }
}
