<?php


namespace DataGrid\DataGrid\HtmlElements;


use DataGrid\State\StateInterface;

class Table
{
    protected $string = "";

    public function getTable()
    {
        return $this->string;
    }

    public function startTable($class = [])
    {

        $this->string .= $this->addClasses("<table>", $class);
    }

    public function endTable()
    {
        $this->string .= "</table>";
    }

    public function startRow($class = [])
    {
        $this->string .= $this->addClasses("<tr>", $class);
    }

    public function endRow()
    {
        $this->string .= "</tr>";
    }

    public function createCell($value, $class = [])
    {
        $this->startCell($class);
        $this->insertData($value);
        $this->endCell();
    }

    public function startCell($class = [])
    {
        $this->string .= $this->addClasses("<td>", $class);
    }

    public function endCell()
    {
        $this->string .= "</td>";
    }

    public function createErrorCell($message, $width, $class = [])
    {
        $this->string .= $this->addClasses('<td colspan="'.$width.'">'.$message.'</td>', $class);
    }

    public function createTableHeadingCell($value, $orderBy, StateInterface $state, $class = [])
    {
        $globalGetCopy = $_GET;
        $globalGetCopy["orderBy"] = $orderBy;

        if(strpos($state->getOrderBy(), $value) !== false) {
            $orderingSign = ($state->isOrderAsc()) ? "&#8593;" : "&#8595;";
        } else {
            $orderingSign = "";
        }

        $this->string .= '<th><a href="?'.http_build_query($globalGetCopy).'" target="_self" data-label="'.$value.'">'.$value.' '.$orderingSign.'</a></th>';
    }

    public function startTableHeadingCell($class = [])
    {
        $this->string .= $this->addClasses("<th>", $class);;
    }

    public function endTableHeadingCell()
    {
        $this->string .= "</th>";
    }

    public function insertData($value)
    {
        $this->string .= $value;
    }

    /**
     * Adds a class to element. Works only with methods that start the element.
     * @param $string The element
     * @param array $class Classes to add
     * @return string
     */
    private function addClasses($string, $class = [])
    {
        if(empty($class)) {
            return $string;
        } else {
            $str_to_insert = ' class="'.implode(" ", $class).'"';
            $pos = strpos($string, ">");
            return substr_replace($string, $str_to_insert, $pos, 0);
        }
    }
}