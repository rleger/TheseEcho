<?php

namespace These\Http\Requests;

use App;
use Illuminate\Validation\Factory;

/**
 * Class ValidatorExtentionsTrait.
 */
trait ValidatorExtentionsTrait
{
    /**
     * Replace placeholders.
     *
     * @param $message
     * @param $attribute
     * @param $rule
     * @param $parameters
     *
     * @return mixed
     */
    protected function setFieldsAndValues($message, $attribute, $rule, $parameters)
    {
        $questionTranslator = App::make('These\SurveyBuilder\QuestionTranslator');

        $message = str_replace(':field', $questionTranslator->getTitle($parameters[0]), $message);
        $message = str_replace(':value', $questionTranslator->getField($parameters[0], $parameters[1]), $message);

        return $message;
    }

    /**
     * Extend the Validator.
     *
     * @param Factory $factory
     */
    protected function extendValidator(Factory $factory)
    {
        $factory->replacer('required_if_has', function ($message, $attribute, $rule, $parameters) { return $this->setFieldsAndValues($message, $attribute, $rule, $parameters); });

        $factory->replacer('required_if_not', function ($message, $attribute, $rule, $parameters) { return $this->setFieldsAndValues($message, $attribute, $rule, $parameters); });

        /////////////////////
        // Required if NOT //
        /////////////////////
        $factory->extendImplicit('required_if_not', function ($attribute, $value, $parameters = []) {
            $input = $this->input();
            $field = $parameters[0];
            $fieldValue = $parameters[1];

            // If the field is not set, default to true
            if (!array_key_exists($field, $input)) {
                return true;
            }

            return ($input[$field] !== $fieldValue)
                ? array_key_exists($attribute, $input)
                : true;
        }, "La question ':attribute' est requise lorsque la question ':field' n'est pas ':value' !");

        //////////////////////////////////
        // If checkbox contains a value //
        //////////////////////////////////
        $factory->extendImplicit('required_if_has', function ($attribute, $value, $parameters = []) {
            $input = $this->input();
            $field = $parameters[0];
            $fieldValue = $parameters[1];

            // If the field is not set, default to true
            if (!array_key_exists($field, $input)) {
                return true;
            }

            return (array_key_exists($fieldValue, $input[$field]))
                ? array_key_exists($attribute, $input)
                : true;
        }, "La question ':attribute' est requise lorsque la question ':field' contient ':value' !");
    }
}
