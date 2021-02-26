<?php


namespace DataGrid\DataGrid;



use DataGrid\DataGrid\HtmlElements\Table;
use DataGrid\State\StateInterface;

class HtmlDataGrid extends AbstractDataGrid
{

    private $colCount = 0;

    public function render(array $rows, StateInterface $state)
    {
        //var_dump($this->config, $rows, $state);
        $table = new HtmlElements\Table();
        $pagination = new HtmlElements\Pagination($state, count($rows));
        $configColumns = $this->config->getColumns();

        $table->startTable(["table", "table-bordered"]);

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
            $this->colCount++;
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

            $cellValues = [];

            foreach ($configColumns as $columnKey => $configColumnsObject) {
                if (array_key_exists($columnKey, $rows[$currentRow])) {
                    $cellDataType = $configColumnsObject->getDataType();
                    $rowValue = $rows[$currentRow][$columnKey];

                    if(is_null($rowValue)) {
                        $cellValue = "&#9888;";
                    } else {
                        $cellValue = $cellDataType->format($rowValue, $configColumnsObject->getOptions());
                    }


                    $cellValues[] = $cellValue;
                } else {
                    $cellValues[] = "";
                }
            }

            if (!empty($cellValues) && count(array_unique($cellValues)) === 1 && end($cellValues) === '&#9888;') {
                $table->createErrorCell("&#9888; Błąd wiersza - w tym wierszu znajdują się błędne dane", $this->colCount, ['text-danger']);
            } elseif(!empty($cellValues) && count(array_unique($cellValues)) === 1 && end($cellValues) === '') {
                $table->createErrorCell("&#9888; Błąd wiersza - w tym wierszu znajdują się błędne dane", $this->colCount, ['text-danger']);
            } else {
                foreach ($cellValues as $cellValue) {
                    $table->createCell($cellValue);
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
                if(array_key_exists($sortBy[0], $b) && array_key_exists($sortBy[0], $a)) {
                    return $b[$sortBy[0]] <=> $a[$sortBy[0]];
                } else {
                    return false;
                }
            });
        } elseif($sortBy[1] === "asc") {
            usort($rows, function($a, $b) use ($sortBy) {
                if(array_key_exists($sortBy[0], $b) && array_key_exists($sortBy[0], $a)) {
                    return $a[$sortBy[0]] <=> $b[$sortBy[0]];
                } else {
                    return false;
                }
            });
        }

        return $rows;
    }
}