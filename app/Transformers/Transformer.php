<?php

namespace These\Transformers;

abstract class Transformer
{
    /**
     * @param array $answers
     *
     * @return array
     */
    public function transformCollection(array $answers)
    {
        return array_map([$this, 'transform'], $answers);
    }

    /**
     * Transform Bool Value.
     *
     * @param $value
     *
     * @return bool
     */
    protected function strToBool($value)
    {
        return (strtolower($value) === 'true' || strtolower($value) === 'oui') ? true : false;
    }

    /**
     * Explode fields with multiple values.
     *
     * @param        $value
     * @param string $separator
     *
     * @return array
     */
    protected function multipleValuesToArray($value, $separator = ',')
    {
        return explode($separator, $value);
    }

    abstract public function transform(array $answer);
}
