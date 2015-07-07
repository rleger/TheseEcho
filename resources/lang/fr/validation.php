<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */

    "accepted"         => "Le champ ':attribute' doit être accepté.",
    "active_url"       => "Le champ ':attribute' n'est pas une URL valide.",
    "after"            => "Le champ ':attribute' doit être une date postérieure au :date.",
    "alpha"            => "Le champ ':attribute' doit seulement contenir des lettres.",
    "alpha_dash"       => "Le champ ':attribute' doit seulement contenir des lettres, des chiffres et des tirets.",
    "alpha_num"        => "Le champ ':attribute' doit seulement contenir des chiffres et des lettres.",
    "before"           => "Le champ ':attribute' doit être une date antérieure au :date.",
    "between"          => [
        "numeric" => "La valeur de ':attribute' doit être comprise entre :min et :max.",
        "file"    => "Le fichier ':attribute' doit avoir une taille entre :min et :max kilobytes.",
        "string"  => "Le texte ':attribute' doit avoir entre :min et :max caractères.",
    ],
    "confirmed"        => "Le champ de confirmation ':attribute' ne correspond pas.",
    "date"             => "Le champ ':attribute' n'est pas une date valide.",
    "date_format"      => "Le champ ':attribute' ne correspond pas au format :format.",
    "different"        => "Les champs ':attribute' et :other doivent être différents.",
    "digits"           => "Le champ ':attribute' doit avoir :digits chiffres.",
    "digits_between"   => "Le champ ':attribute' doit avoir entre :min and :max chiffres.",
    "email"            => "Le format du champ ':attribute' est invalide.",
    "exists"           => "Le champ ':attribute' sélectionné est invalide.",
    "image"            => "Le champ ':attribute' doit être une image.",
    "in"               => "Le champ ':attribute' est invalide.",
    "integer"          => "Le champ ':attribute' doit être un entier.",
    "ip"               => "Le champ ':attribute' doit être une adresse IP valide.",
    "max"              => [
        "numeric" => "La valeur de ':attribute' ne peut être supérieure à :max.",
        "file"    => "Le fichier ':attribute' ne peut être plus gros que :max kilobytes.",
        "string"  => "Le texte de ':attribute' ne peut contenir plus de :max caractères.",
    ],
    "mimes"            => "Le champ ':attribute' doit être un fichier de type : :values.",
    "min"              => [
        "numeric" => "La valeur de ':attribute' doit être inférieure à :min.",
        "file"    => "Le fichier ':attribute' doit être plus que gros que :min kilobytes.",
        "string"  => "Le texte ':attribute' doit contenir au moins :min caractères.",
    ],
    "not_in"           => "Le champ ':attribute' sélectionné n'est pas valide.",
    "numeric"          => "Le champ ':attribute' doit contenir un nombre.",
    "regex"            => "Le format du champ ':attribute' est invalide.",
    "required"         => "Le champ ':attribute' est obligatoire.",
    "required_if"      => "Le champ ':attribute' est obligatoire quand la valeur de :other est :value.",
    "required_with"    => "Le champ ':attribute' est obligatoire quand :values est présent.",
    "required_without" => "Le champ ':attribute' est obligatoire quand :values n'est pas présent.",
    "same"             => "Les champs ':attribute' et :other doivent être identiques.",
    "size"             => [
        "numeric" => "La taille de la valeur de ':attribute' doit être :size.",
        "file"    => "La taille du fichier de ':attribute' doit être de :size kilobytes.",
        "string"  => "Le texte de ':attribute' doit contenir :size caractères.",
    ],
    "unique"           => "La valeur du champ ':attribute' est déjà utilisée.",
    "url"              => "Le format de l'URL de ':attribute' n'est pas valide.",
    "passcheck"        => "L'ancien mot de passe n'est pas valide.",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom'           => [],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes'       => [
        "username"                => "Nom d'utilisateur",
        "firstname"               => "Prénom",
        "lastname"                => "Nom",
        "password"                => "Mot de passe",
        "email"                   => "E-mail",
        "metier"                  => "Métier",
        "age"                     => "Age",
        "experience"              => "Années d’expérience",
        "ville"                   => "Ville d’exercice",
        "type_structure"          => "Type de structure",
        "filiere_traumato"        => "Avez vous une filière trauma dédiée",
        "tps_passage"             => "Temps de passage aux urgences",
        "anest_dispo"             => "Anesthésiste disponible",
        "protocole_dispo"         => "Disposez vous d’un protocole ALR",
        "echo_dispo"              => "Avez-vous un échographie disponible",
        "formation_alr"           => "Formation ALR",
        "contre_indication_alr"   => "Pratiquez-vous une anesthésie locorégionale si...",
        "formation_alr_echo"      => "Formation ALR échogudée",
        "pratique_ALR"            => "Votre pratique de ALR",
        "pratique_ALR_region"     => "Dans quelle région anatomique",
        "pratique_ALR_FESF"       => "Votre pratique de l’ALR pour FESF",
        "phase_realisation_alr"   => "Quand réalisez vous l’ALR",
        "ALR_douleur"             => "ALR quelque soit la douleur",
        "reperage"                => "Moyen de repérage",
        "bif_indication"          => "Le bloc ilio fascial",
        "femoral_indication"      => "Le bloc fémoral",
        "fem_obtu_indication"     => "Le bloc fémoral et obturateur",
        "quel_bloc"               => "Quel type de bloc",
        "bif_concentration_lido"  => "Quelle concentration de lidocaïne",
        "bif_dose_lido"           => "Quelle quantité de lidocaïne",
        "bif_concentration_ropi"  => "Quelle concentration de ropivacaïne",
        "bif_dose_ropi"           => "Quelle quantité de ropivacaïne",
        "bif_concentration_mepi"  => "Quelle concentration de mépivacaïne",
        "bif_dose_mepi"           => "Quelle quantité de mépivacaïne",
        "bif_concentration_chiro" => "Quelle concentration de chirocaïne",
        "bif_dose_chiro"          => "Quelle quantité de chirocaïne",
        "bif_dose_cata"           => "Dose de catapressan",
        "bif_type_assoc"          => "Type d’association",
        "AL_bif"                  => "Bloc ilio-fascial",
        "fem_concentration_lido"  => "Quelle concentration de lidocaïne",
        "fem_dose_lido"           => "Quelle quantité de lidocaïne",
        "fem_concentration_ropi"  => "Quelle concentration de ropivacaïne",
        "fem_dose_ropi"           => "Quelle quantité de ropivacaïne",
        "fem_concentration_mepi"  => "Quelle concentration de mépivacaïne",
        "fem_dose_mepi"           => "Quelle quantité de mépivacaïne",
        "fem_concentration_chiro" => "Quelle quantité de chirocaïne",
        "fem_dose_chiro"          => "Quelle quantité de chirocaïne",
        "fem_dose_cata"           => "Dose de catapressan",
        "fem_type_assoc"          => "Type d’association",
        "AL_bf"                   => "Bloc fémoral",
        "interet_ALR"             => "Intérêt de l’ALR",
        "echec"                   => "Échec de l’alr",
        "protocole_std"           => "Utilité d’un protocole",
        "reticences"              => "Vos réticences",
        "commentaires"            => "Commentaires"
    ],
];
