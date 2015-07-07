<?php

namespace These\SurveyBuilder\QuestionTypes;

/**
 * Class EmailQuestion.
 */
class HeadingQuestion extends BaseQuestion implements Question
{
    /**
     * Build the HTML to render the question.
     *
     * @return string
     */
    public function buildHtml()
    {
        if (!$this->questionHas('title')) {
            return;
        }

        $options = $this->buildQuestionOptions(['class' => 'text-center']);

        $this->htmlBody .= $this->tagBuilder->make('h3', $this->question->title, $options);

        return $this->htmlBody;
    }
}
