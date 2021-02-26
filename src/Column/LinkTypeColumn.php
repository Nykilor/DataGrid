<?php


namespace DataGrid\Column;


class LinkTypeColumn extends AbstractColumn
{
    protected $options = [
        "element" => "a",
        "class" => ""
    ];

    /**
     * Set if the link should be shown as: "a" or "button"
     *
     * @param string $element "a" or "button"
     * @return $this
     */
    public function setElement(string $element)
    {
        $allowedElements = ["a", "button"];
        if(in_array($element, $allowedElements)) {
            $this->options["element"] = $element;
        } else {
            throw new \InvalidArgumentException("There's no allowed element like: ".$element." allowed elements are: ".implode(", ", $allowedElements));
        }

        return $this;
    }

    /**
     * Assing a class to the element
     * @param string $class
     * @return $this
     */
    public function setClass(string $class)
    {
        $this->options["class"] = $class;

        return $this;
    }
}