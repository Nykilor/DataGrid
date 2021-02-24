<?php


namespace DataGrid\DataGrid;



use DataGrid\DataGrid\HtmlElements\Table;
use DataGrid\State\StateInterface;

class HtmlDataGrid extends AbstractDataGrid
{

    public function render(array $rows, StateInterface $state)
    {
        //var_dump($this->config, $rows, $state);
        $table = new HtmlElements\Table();
        $configColumns = $this->config->getColumns();

        $table->startTable();

        $this->createHeader($table, $configColumns);
        $this->createBody($table, $configColumns, $rows, $state);

        $table->endTable();

        return $table->getTable();
    }

    private function createHeader(Table $table, array $configColumns): void
    {
        $table->startRow();
        foreach ($configColumns as $columnObject) {
            $table->startTableHeadingCell();
            $table->insertData($columnObject->getLabel());
            $table->endTableHeadingCell();
        }
        $table->endRow();
    }

    private function createBody(Table $table, array $configColumns, array $rows, StateInterface $state)
    {
        $printRowsTill = $state->getCurrentPage() * $state->getRowsPerPage();
        $printRowsFrom = (int) floor($printRowsTill - $state->getRowsPerPage());

        for ($currentRow = $printRowsFrom; $currentRow < count($rows); $currentRow++) {
            if($currentRow === $printRowsTill) {
                break;
            }
            $table->startRow();
            foreach ($configColumns as $columnKey => $configColumnsObject) {
                if (array_key_exists($columnKey, $rows[$currentRow])) {
                    $cellDataType = $configColumnsObject->getDataType();
                    $table->createCell($cellDataType->format($rows[$currentRow][$columnKey], $configColumnsObject->getOptions()));
                }
            }
            $table->endRow();
        }
    }

    private function sortRows(array $rows, StateInterface $state): void
    {
        $sortBy = $state->getOrderBy();

        usort($rows, function ($a, $b) {
            return $b['name'] <=> $a['name'];
        });
    }
}