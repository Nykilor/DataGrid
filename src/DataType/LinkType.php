<?php


namespace DataGrid\DataType;


class LinkType extends AbstractDataType
{
    public function format(string $value, $option = []): string
    {
        $value = parent::format($value, $option);

        if($option["element"] === "a") {
            return '<a href="'.$value.'" target="_blank" class="'.$option["class"].'">'.$value.'</a>';
        } else {
            return '<a href="'.$value.'" <button class="'.$option["class"].'">'.$value.'</button></a>';
        }
    }
}