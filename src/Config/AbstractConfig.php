<?php


namespace DataGrid\Config;


use DataGrid\Column\ColumnInterface;
use DataGrid\Column\DefaultColumn;
use DataGrid\DataType\TextType;

abstract class AbstractConfig implements ConfigInterface
{
    protected $columns = [];

    /**
     * @inheritDoc
     */
    public function withColumn(string $key, ColumnInterface $column): ConfigInterface
    {
        $this->columns[$key] = $column;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getColumns(): array
    {
        return $this->columns;
    }
}