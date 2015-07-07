<?php

namespace These\SurveyBuilder\QuestionTypes;

interface Question
{
    /**
     * Build the HTML to render the question.
     *
     * @internal param $question
     *
     * @return mixed
     */
    public function buildHtml();
}
