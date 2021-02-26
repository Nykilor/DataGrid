<?php


namespace DataGrid\Column;


class ImageTypeColumn extends AbstractColumn
{
    protected $options = [
        "width" => 16,
        "height" => 16
    ];


    public function setWidth(int $width)
    {
        $this->options["width"] = $width;

        return $this;
    }

    public function setHeight(int $height)
    {
        $this->options["height"] = $height;

        return $this;
    }
}