<?php


namespace DataGrid\DataType;


class RawType extends AbstractDataType
{
    public function format(string $value, $option = []): string
    {
        return $value;
    }
}