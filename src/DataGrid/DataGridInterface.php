<?php
namespace DataGrid\DataGrid;

use DataGrid\Config\ConfigInterface;
use DataGrid\State\StateInterface;

interface DataGridInterface
{
    /**
     * Zmienia aktualną konfigurację DataGrid.
     */
    public function withConfig(ConfigInterface $config): DataGridInterface;

    /**
     * Renderuje na ekran kod, który ma za zadanie wyświetlić przygotowany DataGrid.
     * Jako parametr przyjmuje: wszystkie dostępne dane, oraz aktualny stan DataGrid w formie obiektu - State.
     * Na podstawie State, metoda ma za zadanie posortować wiersze oraz podzielić je na strony.
     */
    public function render(array $rows, StateInterface $state);
}