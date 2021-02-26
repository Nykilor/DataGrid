<?php


namespace DataGrid\Column;


class NumberTypeColumn extends AbstractColumn
{
    protected $options = [
        "setRounding" => [2, PHP_ROUND_HALF_ODD],
        "number_format" => [2, " ", ","]
    ];

    public function __construct()
    {
        $this->withAlign("right");
    }

    /**
     * Direct copy from https://www.php.net/manual/en/function.round
     * @param int $precision The optional number of decimal digits to round to.
     * @param $mode Use one of the following constants to specify the mode in which rounding occurs: PHP_ROUND_HALF_UP, PHP_ROUND_HALF_DOWN, PHP_ROUND_HALF_EVEN, PHP_ROUND_HALF_ODD
     */
    public function setRounding(int $precision, $mode)
    {
        $this->options["setRounding"] = [$precision, $mode];

        return $this;
    }

    /**
     * Direct copy from https://www.php.net/manual/en/function.number-format.php
     * @param int $decimals Sets the number of decimal digits. If 0, the decimal_separator is omitted from the return value.
     * @param string $decimal_separator Sets the separator for the decimal point.
     * @param string $thousands_separator Sets the thousands separator.
     */
    public function setNumberFormat(int $decimals, string $decimal_separator, string $thousands_separator)
    {
        $this->options["number_format"] = [$decimals, $decimal_separator, $thousands_separator];

        return $this;
    }

}