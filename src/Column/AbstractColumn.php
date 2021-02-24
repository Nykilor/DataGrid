<?php


namespace DataGrid\Column;


use DataGrid\DataType\DataTypeInterface;

abstract class AbstractColumn implements ColumnInterface
{

    protected $label;
    protected $dataType;
    protected $align = "left";
    protected $options = [];

    /**
     * @inheritDoc
     */
    public function withLabel(string $label): ColumnInterface
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @inheritDoc
     */
    public function withDataType(DataTypeInterface $type): ColumnInterface
    {
        $this->dataType = $type;

        return $this;
    }

    public function getDataType(): DataTypeInterface
    {
        return $this->dataType;
    }

    /**
     * @inheritDoc
     */
    public function withAlign(string $align): ColumnInterface
    {
        $allowedAligns = ["left", "right", "middle"];
        if(in_array($align, $allowedAligns)) {
            $this->align = $align;
        } else {
            throw new \InvalidArgumentException("There's no alignment like: ".$align." allowed aligns are: ".implode(", ", $allowedAligns));
        }

        return $this;
    }

    public function getAlign(): string
    {
        return $this->align;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}