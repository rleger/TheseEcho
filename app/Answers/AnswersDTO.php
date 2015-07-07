<?php

namespace These\Answers;

use These\dto\DTOConstructor;

class AnswersDTO extends DTOConstructor
{
    public $medical_center_id;

    public $client_ip_address;

    public $email;

     // 1

    public $sexe;
    public $pays_exercice;
    public $mode_exercice;
    public $distance_hopital;

     // 2

    public $interet_echo;
    public $interet_echo_oui;
    public $interet_echo_non;

     // 3

    public $indications;
    public $temps_formation;
    public $difficulte;
    public $utilisation;
    public $conclusion;

    public $subscribeToResult;
}
