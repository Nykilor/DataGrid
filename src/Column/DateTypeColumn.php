<?php


namespace DataGrid\Column;


class DateTypeColumn extends AbstractColumn
{
    protected $options = [
        "format" => "Y-m-d"
    ];


    /**
     * @param string $format The display format for the date and time  based on https://www.php.net/manual/en/datetime.format.php
     */
    public function setFormat(string $format): void
    {
        $this->options["format"] = $format;
    }

}