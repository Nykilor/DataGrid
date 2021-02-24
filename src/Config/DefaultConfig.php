<?php


namespace DataGrid\Config;


use DataGrid\Column\DefaultColumn;
use DataGrid\Column\MoneyTypeColumn;
use DataGrid\Column\NumberTypeColumn;
use DataGrid\DataType\MoneyType;
use DataGrid\DataType\NumberType;
use DataGrid\DataType\TextType;

class DefaultConfig extends AbstractConfig
{
    /**
     * Skrótowa metoda dla kolumny typu text
     */
    public function addTextColumn($key)
    {
        $column = new DefaultColumn();
        $column->withAlign("left")
               ->withDataType(new TextType())
               ->withLabel($key);

        $this->withColumn($key, $column);

        return $column;
    }

    public function addNumberColumn($key)
    {
        $column = new NumberTypeColumn();
        $column->withDataType(new NumberType())
               ->withLabel($key);

        $this->withColumn($key, $column);

        return $column;
    }

    public function addMoneyColumn($key)
    {
        $column = new MoneyTypeColumn();
        $column->withDataType(new MoneyType())
               ->withLabel($key);

        $this->withColumn($key, $column);

        return $column;
    }
}