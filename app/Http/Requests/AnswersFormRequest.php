<?php

namespace These\Http\Requests;

use Illuminate\Validation\Factory;

class AnswersFormRequest extends Request
{
    use ValidatorExtentionsTrait;

    /**
     * Constructor.
     *
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->extendValidator($factory);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'anest_dispo'        => 'required',
            // 'protocole_dispo'    => 'required',
            // 'echo_dispo'         => 'required',
            // 'formation_alr'      => 'required',
            // 'formation_alr_echo' => 'required_if:formation_alr,oui',

            // 'pratique_ALR'        => 'required',
            // 'pratique_ALR_region' => 'required_if:pratique_ALR,oui',
            // 'pratique_ALR_FESF'   => 'required_if:pratique_ALR,oui',
            // 'bif_indication'      => 'required_if:quel_bloc,bif',
            // 'femoral_indication'  => 'required_if:quel_bloc,femoral',
            // 'fem_obtu_indication' => 'required_if:quel_bloc,fem_obtu',

            // 'contre_indication_alr' => 'required_if_not:pratique_ALR_FESF,jamais',
            // 'phase_realisation_alr' => 'required_if_not:pratique_ALR_FESF,jamais',
            // 'ALR_douleur'           => 'required_if_not:pratique_ALR_FESF,jamais',
            // 'reperage'              => 'required_if_not:pratique_ALR_FESF,jamais',
            // 'quel_bloc'             => 'required_if_not:pratique_ALR_FESF,jamais',

            // 'AL_bif'     => 'required_if:quel_bloc,bif',
            // 'AL_bf'      => 'required_if:quel_bloc,femoral',
            // 'AL_bf_obtu' => 'required_if:quel_bloc,fem_obtu',

            // 'echec' => 'required_if_not:pratique_ALR_FESF,jamais',

            // 'bif_indication'      => 'required_if_has:quel_bloc,bif',
            // 'femoral_indication'  => 'required_if_has:quel_bloc,femoral',
            // 'fem_obtu_indication' => 'required_if_has:quel_bloc,fem_obtu',

            // 'bif_concentration_lido'  => 'required_if_has:AL_bif,bif_lido',
            // 'bif_concentration_ropi'  => 'required_if_has:AL_bif,bif_ropi',
            // 'bif_concentration_mepi'  => 'required_if_has:AL_bif,bif_mepi',
            // 'bif_concentration_chiro' => 'required_if_has:AL_bif,bif_chiro',

            // 'fem_concentration_lido'  => 'required_if_has:AL_bf,fem_lido',
            // 'fem_concentration_ropi'  => 'required_if_has:AL_bf,fem_ropi',
            // 'fem_concentration_mepi'  => 'required_if_has:AL_bf,fem_mepi',
            // 'fem_concentration_chiro' => 'required_if_has:AL_bf,fem_chiro',

            // 'fem_obtu_concentration_lido'  => 'required_if_has:AL_bf_obtu,fem_obtu_lido',
            // 'fem_obtu_concentration_ropi'  => 'required_if_has:AL_bf_obtu,fem_obtu_ropi',
            // 'fem_obtu_concentration_mepi'  => 'required_if_has:AL_bf_obtu,fem_obtu_mepi',
            // 'fem_obtu_concentration_chiro' => 'required_if_has:AL_bf_obtu,fem_obtu_chiro',

            // 'interet_ALR'      => 'required',
            // 'protocole_std'    => 'required',
            // 'reticences'       => 'required',
            // 'type_structure'   => 'required',
            // 'filiere_traumato' => 'required',
            // 'tps_passage'      => 'required',
            // 'ville'            => 'required|exists:villes_france,ville_nom_reel',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
