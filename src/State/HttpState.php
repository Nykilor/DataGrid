<?php


namespace DataGrid\State;


class HttpState extends AbstractState
{
    public function __construct()
    {
        $this->setState($_GET);
    }
}