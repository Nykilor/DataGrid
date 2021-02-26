<?php


namespace DataGrid\Config;


use DataGrid\Column\ColumnInterface;
use DataGrid\Column\DateTimeTypeColumn;
use DataGrid\Column\DateTypeColumn;
use DataGrid\Column\DefaultColumn;
use DataGrid\Column\ImageTypeColumn;
use DataGrid\Column\LinkTypeColumn;
use DataGrid\Column\MoneyTypeColumn;
use DataGrid\Column\NumberTypeColumn;
use DataGrid\DataType\DateTimeType;
use DataGrid\DataType\DateType;
use DataGrid\DataType\ImageType;
use DataGrid\DataType\LinkType;
use DataGrid\DataType\MoneyType;
use DataGrid\DataType\NumberType;
use DataGrid\DataType\RawType;
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

    /**
     * Shorthand for text column
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

    /**
     * Shorthand for number column
     */
    public function addNumberColumn($key)
    {
        $column = new NumberTypeColumn();
        $column->withDataType(new NumberType())
            ->withLabel($key);

        $this->withColumn($key, $column);

        return $column;
    }

    /**
     * Shorthand for money column
     */
    public function addMoneyColumn($key)
    {
        $column = new MoneyTypeColumn();
        $column->withDataType(new MoneyType())
            ->withLabel($key);

        $this->withColumn($key, $column);

        return $column;
    }

    /**
     * Shorthand for image column
     */
    public function addImageColumn($key)
    {
        $column = new ImageTypeColumn();
        $column->withDataType(new ImageType())
            ->withLabel($key);

        $this->withColumn($key, $column);

        return $column;
    }

    /**
     * Shorthand for link column
     */
    public function addLinkColumn($key)
    {
        $column = new LinkTypeColumn();
        $column->withDataType(new LinkType())
            ->withLabel($key);

        $this->withColumn($key, $column);

        return $column;
    }

    /**
     * Shorthand for raw column
     */
    public function addRawColumn($key)
    {
        $column = new DefaultColumn();
        $column->withDataType(new RawType())
            ->withLabel($key);

        $this->withColumn($key, $column);

        return $column;
    }

    /**
     * Shorthand for date time column
     */
    public function addDateTimeColumn($key)
    {
        $column = new DateTimeTypeColumn();
        $column->withDataType(new DateTimeType())
            ->withLabel($key);

        $this->withColumn($key, $column);

        return $column;
    }

    /**
     * Shorthand for date column
     */
    public function addDateColumn($key)
    {
        $column = new DateTypeColumn();
        $column->withDataType(new DateType())
            ->withLabel($key);

        $this->withColumn($key, $column);

        return $column;
    }
}