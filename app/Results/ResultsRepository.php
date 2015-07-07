<?php

namespace These\Results;

interface ResultsRepository
{
    public function participants();

    public function centres_participants();

    public function centres_non_participants();
}
