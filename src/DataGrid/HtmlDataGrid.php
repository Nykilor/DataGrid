<?php


namespace DataGrid\DataGrid;



use DataGrid\DataGrid\HtmlElements\Table;
use DataGrid\State\StateInterface;

class HtmlDataGrid extends AbstractDataGrid
{

    private $errors = [];

    public function render(array $rows, StateInterface $state)
    {
        //var_dump($this->config, $rows, $state);
        $table = new HtmlElements\Table();
        $pagination = new HtmlElements\Pagination($state, count($rows));
        $configColumns = $this->config->getColumns();

        $table->startTable();

        $this->createHeader($table, $configColumns, $state);
        $this->createBody($table, $configColumns, $rows, $state);

        $table->endTable();

        return $table->getTable().$pagination->getPagination();
    }

    private function createHeader(Table $table, array $configColumns, StateInterface $state): void
    {
        $table->startRow();
        $orderBy = explode(",", $state->getOrderBy());
        foreach ($configColumns as $columnObject) {
            $tableOrderingClick = $columnObject->getLabel();
            if(!empty($state->getOrderBy()) && $orderBy[0] === $columnObject->getLabel()) {
                if($state->isOrderAsc()) {
                    $tableOrderingClick .= ","."desc";
                } else {
                    $tableOrderingClick = "";
                }
            } else {
                $tableOrderingClick .= ","."asc";
            }

            $table->createTableHeadingCell($columnObject->getLabel(), $tableOrderingClick, $state);
        }
        $table->endRow();
    }

    private function createBody(Table $table, array $configColumns, array $rows, StateInterface $state)
    {
        $printRowsTill = $state->getCurrentPage() * $state->getRowsPerPage();
        $printRowsFrom = (int) floor($printRowsTill - $state->getRowsPerPage());
        $rows = $this->sortRows($rows, $state);

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

    private function sortRows(array $rows, StateInterface $state): array
    {
        if(empty($state->getOrderBy())) {
            return $rows;
        }

        $sortBy = explode(",", $state->getOrderBy());

        //Niezbyt eleganckie może do poprawy.
        if($sortBy[1] === "desc") {
            usort($rows, function($a, $b) use ($sortBy) {
                if(array_key_exists($sortBy[0], $b)) {
                    return $b[$sortBy[0]] <=> $a[$sortBy[0]];
                } else {
                    return false;
                }
            });
        } elseif($sortBy[1] === "asc") {
            usort($rows, function($a, $b) use ($sortBy) {
                if(array_key_exists($sortBy[0], $b)) {
                    return $a[$sortBy[0]] <=> $b[$sortBy[0]];
                } else {
                    return false;
                }
            });
        }

        return $rows;
    }
}