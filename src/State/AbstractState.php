<?php


namespace DataGrid\State;


abstract class AbstractState implements StateInterface
{
    protected $currentPage = 1;
    protected $orderBy = "";
    protected $rowsPerPage = 9;

    public function __construct(array $settings)
    {
        $this->setState($settings);
    }

    /**
     * @inheritDoc
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @inheritDoc
     */
    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    /**
     * @inheritDoc
     */
    public function isOrderDesc(): bool
    {
        return $this->isOrderLike("desc");
    }

    /**
     * @inheritDoc
     */
    public function isOrderAsc(): bool
    {
        return $this->isOrderLike("asc");
    }

    /**
     * @inheritDoc
     */
    public function getRowsPerPage(): int
    {
        return $this->rowsPerPage;
    }

    protected function isOrderLike(string $ordering)
    {
        if(!is_null($this->orderBy)) {
            $orderBy = explode(",", $this->orderBy);

            if(is_array($orderBy) && count($orderBy) > 0 && $orderBy[1] === $ordering) {
                return true;
            }
        }

        return false;
    }

    protected function setState(array $settings)
    {
        $this->setClassPropertyByArraysKeyValueIfExists("currentPage", $settings);
        $this->setClassPropertyByArraysKeyValueIfExists("orderBy", $settings);
        $this->setClassPropertyByArraysKeyValueIfExists("rowsPerPage", $settings);
    }

    protected function setClassPropertyByArraysKeyValueIfExists(string $property, array $settings)
    {
        if(array_key_exists($property, $settings))
        {
            $this->{$property} = $settings[$property];
        }
    }

}