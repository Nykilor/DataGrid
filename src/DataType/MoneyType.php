<?php


namespace DataGrid\DataType;


class MoneyType extends AbstractDataType
{
    public function format(string $value, $option = []): string
    {
        $numberTypeObject = new NumberType();

        $value = $numberTypeObject->format($value, $option);

        return $value.$option["currency"];
    }
}