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
            'sexe'             => 'required',
            'pays_exercice'    => 'required',
            'age'              => 'required',
            'mode_exercice'    => 'required',
            'distance_hopital' => 'required',

            'interet_echo'     => 'required',
            'interet_echo_oui' => 'required_if:interet_echo,oui',
            'interet_echo_non' => 'required_if:interet_echo,non',

            'temps_formation' => 'required',
            'difficulte'      => 'required',
            'utilisation'     => 'required',
            'conclusion'      => 'required',
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
