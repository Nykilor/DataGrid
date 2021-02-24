<?php


namespace DataGrid\DataGrid\HtmlElements;


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
        $this->string .= $this->addClasses("<td>", $class);;
    }

    public function endCell()
    {
        $this->string .= "</td>";
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

    private function addClasses($string, $class = [])
    {
        if(empty($class)) {
            return $string;
        } else {
            return mb_substr($string, 0, -1).'class="'.implode(" ", $class).'">';
        }
    }
}