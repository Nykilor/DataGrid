<?php


namespace DataGrid\DataType;


class DateType extends AbstractDataType
{
    public function format(string $value, $option = []): string
    {
        $value = parent::format($value, $option);

        return date($option["format"], $value);
    }
}