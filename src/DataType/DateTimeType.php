<?php


namespace DataGrid\DataType;


class DateTimeType extends AbstractDataType
{
    public function format(string $value, $option = []): string
    {
        $value = parent::format($value, $option);

        return date($option["format"], $value);
    }
}