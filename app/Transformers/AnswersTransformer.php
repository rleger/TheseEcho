<?php

namespace These\Transformers;

/*
 * Class AnswersTransformer
 * @package These\Transformers
 */
use These\Cities\CitiesRepository;
use These\Results\ResultsService;

/**
 * Class AnswersTransformer.
 */
class AnswersTransformer extends Transformer
{
    /**
     * @var ResultsService
     */
    private $resultsService;
    /**
     * @var CitiesRepository
     */
    private $citiesRepository;

    public function __construct(ResultsService $resultsService, CitiesRepository $citiesRepository)
    {
        $this->resultsService = $resultsService;
        $this->citiesRepository = $citiesRepository;
    }

    /**
     * @param array $answer
     *
     * @return array
     */
    public function transform(array $answer)
    {
        return [
            'id'             => $answer['id'],
            'medical_center' => [
                'id'   => $answer['medical_center_id'],
                'name' => $this->resultsService->resolveMedicalCenterIdName($answer['medical_center_id']),
            ],
            'client_ip_address' => $answer['client_ip_address'],
            'email'             => $answer['email'],
            'metier'            => $answer['metier'],
            'age'               => intval($answer['age']),
            'experience'        => $answer['experience'],
            'ville'             => [
                'nom'         => $this->citiesRepository->getName($answer['ville']),
                'code_postal' => $this->citiesRepository->getPostalCode($answer['ville']),
                'departement' => $this->citiesRepository->getDepartement($answer['ville']),
            ],
            'type_structure'     => $answer['type_structure'],
            'filiere_traumato'   => $this->strToBool($answer['filiere_traumato']),
            'tps_passage'        => $answer['tps_passage'],
            'anest_dispo'        => $this->strToBool($answer['anest_dispo']),
            'protocole_dispo'    => $this->strToBool($answer['protocole_dispo']),
            'echo_dispo'         => $this->strToBool($answer['echo_dispo']),
            'formation_alr'      => $this->strToBool($answer['formation_alr']),
            'formation_alr_echo' => $this->strToBool($answer['formation_alr_echo']),
            'pratique_ALR'       => [
                'general'   => $this->strToBool($answer['pratique_ALR']),
                'region'    => $this->multipleValuesToArray($answer['pratique_ALR_region']),
                'dans_FESF' => $answer['pratique_ALR_FESF'],
            ],
            'contre_indication_alr' => $answer['contre_indication_alr'],
            'phase_realisation_alr' => $answer['phase_realisation_alr'],
            'ALR_douleur'           => $this->strToBool($answer['ALR_douleur']),
            'reperage'              => $this->strToBool($answer['reperage']),
            'indications'           => [
                'bif'      => $answer['bif_indication'],
                'femoral'  => $answer['femoral_indication'],
                'fem_obtu' => $answer['fem_obtu_indication'],
            ],
            'quel_bloc' => [
                'bloc' => $this->multipleValuesToArray($answer['quel_bloc']),
                'bif'  => [
                    'AL'                 => $this->multipleValuesToArray($answer['AL_bif']),
                    'concentration_lido' => $answer['bif_concentration_lido'],
                    'volume_lido'        => $answer['bif_volume_lido'],
                    'concentration_ropi' => $answer['bif_concentration_ropi'],
                    'volume_ropi'        => $answer['bif_volume_ropi'],
                    'concentration_mepi' => $answer['bif_concentration_mepi'],
                    'volume_mepi'        => $answer['bif_volume_mepi'],
                    'volume_cata'        => $answer['bif_volume_cata'],
                    'type_assoc'         => $answer['bif_type_assoc'],
                ],

                'fem' => [
                    'AL'                 => $this->multipleValuesToArray($answer['AL_bf']),
                    'concentration_lido' => $answer['fem_concentration_lido'],
                    'volume_lido'        => $answer['fem_volume_lido'],
                    'concentration_ropi' => $answer['fem_concentration_ropi'],
                    'volume_ropi'        => $answer['fem_volume_ropi'],
                    'concentration_mepi' => $answer['fem_concentration_mepi'],
                    'volume_mepi'        => $answer['fem_volume_mepi'],
                    'volume_cata'        => $answer['fem_volume_cata'],
                    'type_assoc'         => $answer['fem_type_assoc'],
                ],
                'fem_obtu' => [
                    'AL'                 => $this->multipleValuesToArray($answer['AL_bf_obtu']),
                    'concentration_lido' => $answer['fem_obtu_concentration_lido'],
                    'volume_lido'        => $answer['fem_obtu_volume_lido'],
                    'concentration_ropi' => $answer['fem_obtu_concentration_ropi'],
                    'volume_ropi'        => $answer['fem_obtu_volume_ropi'],
                    'concentration_mepi' => $answer['fem_obtu_concentration_mepi'],
                    'volume_mepi'        => $answer['fem_obtu_volume_mepi'],
                    'volume_cata'        => $answer['fem_obtu_volume_cata'],
                    'type_assoc'         => $answer['fem_obtu_type_assoc'],
                ],
            ],

            'interet_ALR'   => $answer['interet_ALR'],
            'echec'         => $answer['echec'],
            'protocole_std' => $answer['protocole_std'],
            'reticences'    => $answer['reticences'],
            'commentaires'  => $answer['commentaires'],
        ];
    }
}
