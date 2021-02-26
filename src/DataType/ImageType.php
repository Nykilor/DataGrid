<?php


namespace DataGrid\DataType;


class ImageType extends AbstractDataType
{
    public function format(string $value, $option = []): string
    {
        $value = parent::format($value, $option);

        return '<img src="'.$value.'" width="'.$option["width"].'" height="'.$option["height"].'" />';
    }
}