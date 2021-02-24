<?php
namespace DataGrid\DataType;

interface DataTypeInterface
{
    /**
     * Formatuje dane dla danego typu.
     */
    public function format(string $value, $option = []) : string;
}