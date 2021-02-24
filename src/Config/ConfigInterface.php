<?php


namespace DataGrid\Config;


use DataGrid\Column\ColumnInterface;

interface ConfigInterface
{
    /**
     * Dodaje nową kolumną do DataGrid.
     */
    public function withColumn(string $key, ColumnInterface $column): ConfigInterface;

    /**
     * Zwraca wszystkie kolumny dla danego DataGrid.
     */
    public function getColumns(): array;
}