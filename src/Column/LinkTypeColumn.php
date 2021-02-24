<?php


namespace DataGrid\Column;


class LinkTypeColumn extends AbstractColumn
{
    protected $options = [
        "element" => "a",
        "bootstrap_class" => ""
    ];


    public function setElement(string $element): void
    {
        $allowedElements = ["a", "button"];
        if(in_array($element, $allowedElements)) {
            $this->options["element"] = $element;
        } else {
            throw new \InvalidArgumentException("There's no allowed element like: ".$element." allowed elements are: ".implode(", ", $allowedElements));
        }
    }

    public function setBootstrapClass(string $class): void
    {
        $this->options["bootstrap_class"] = $class;
    }
}