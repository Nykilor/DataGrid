<?php
namespace DataGrid\Column;

use DataGrid\DataType\DataTypeInterface;

interface ColumnInterface
{
    /**
     * Zmienia tytuł kolumny, który będzie widoczny jako nagłówek.
     */
    public function withLabel(string $label): ColumnInterface;

    public function getLabel(): string;

    /**
     * Ustawia typ danych dla kolumny.
     */
    public function withDataType(DataTypeInterface $type): ColumnInterface;

    public function getDataType(): DataTypeInterface;

    /**
     * Ustawienie wyrównania treści znajdujących się w kolumnie.
     */
    public function withAlign(string $align): ColumnInterface;

    public function getAlign(): string;

    public function getOptions(): array;
}
