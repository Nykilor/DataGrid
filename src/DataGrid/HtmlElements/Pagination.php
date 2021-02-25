<?php


namespace DataGrid\DataGrid\HtmlElements;


use DataGrid\State\StateInterface;

class Pagination
{
    protected $string = '<nav aria-label="Pagination"><ul class="pagination">';
    protected $currentPage;
    protected $resultsPerPage;
    protected $maxRows;
    protected $maxPages;

    public function __construct(StateInterface $state, int $maxRows)
    {
        $this->currentPage = $state->getCurrentPage();
        $this->resultsPerPage = $state->getRowsPerPage();
        $this->maxRows = $maxRows;
        $this->maxPages = round($this->maxRows / $this->resultsPerPage);
        $this->createPagination();
    }

    public function getPagination()
    {
        return $this->string;
    }

    private function createPagination()
    {
        $this->createPreviousButton();
        $this->createPagesButtons();
        $this->createNextButton();
        $this->string .= '</ul></nav>';
    }

    private function createPreviousButton()
    {
        $globalGetCopy = $_GET;
        $globalGetCopy["currentPage"] = $this->currentPage-1;
        if($this->currentPage-1 <= 0) {
            $this->string .= '<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>';
        } else {
            $this->string .= '<li class="page-item"><a class="page-link" href="?'.http_build_query($globalGetCopy).'">Previous</a></li>';
        }
    }

    private function createPagesButtons()
    {
        for ($i = 1; $i <= $this->maxPages; $i++)
        {
            $globalGetCopy = $_GET;
            $globalGetCopy["currentPage"] = $i;
            $activePage = ($this->currentPage === $i) ? "active" : "";
            $this->string .= '<li class="page-item '.$activePage.'"><a class="page-link" href="?'.http_build_query($globalGetCopy).'">'.$i.'</a></li>';
        }
    }

    private function createNextButton()
    {
        $globalGetCopy = $_GET;
        $globalGetCopy["currentPage"] = $this->currentPage+1;
        if($this->currentPage+1 > $this->maxPages) {
            $this->string .= '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
        } else {
            $this->string .= '<li class="page-item"><a class="page-link" href="?'.http_build_query($globalGetCopy).'">Next</a></li>';
        }
    }


}