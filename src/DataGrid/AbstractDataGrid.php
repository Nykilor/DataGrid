<?php


namespace DataGrid\DataGrid;


use DataGrid\Config\ConfigInterface;
use DataGrid\State\StateInterface;

abstract class AbstractDataGrid implements DataGridInterface
{
    protected $config;

    /**
     * @inheritDoc
     */
    public function withConfig(ConfigInterface $config): DataGridInterface
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @inheritDoc
     */
    abstract function render(array $rows, StateInterface $state);
}