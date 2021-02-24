<?php


namespace DataGrid\DataType;


class NumberType extends AbstractDataType
{

    public function format(string $value, $option = []): string
    {
        $sanitized = parent::format($value, $option);

        $value = (float) $value;
        $value = $this->setRounding($value, ...$option["setRounding"]);
        $value = number_format($value, ...$option["number_format"]);

        return $value;
    }

    public function setRounding($value, $precision = 2, $roundingMethod = PHP_ROUND_HALF_UP) : string
    {
        $value = (float) $value;
        $value = round($value, $precision, $roundingMethod);

        return (string) $value;
    }
}