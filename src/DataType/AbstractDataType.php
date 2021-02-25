<?php


namespace DataGrid\DataType;


abstract class AbstractDataType implements DataTypeInterface
{

    /**
     * @inheritDoc
     */
    public function format(string $value, $option = []) : string
    {
        $input = htmlspecialchars($value);
        $input = strip_tags($value);
        $input = str_replace(" ", "&nbsp;", $input);

        return $input;
    }
}