<?php


namespace DataGrid\Column;


class ImageTypeColumn extends AbstractColumn
{
    protected $options = [
        "width" => 16,
        "height" => 16
    ];


    public function setWidth(int $width): void
    {
        $this->options["width"] = $width;
    }

    public function setHeight(int $height): void
    {
        $this->options["height"] = $height;
    }
}