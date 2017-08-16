<?php

namespace interactivesolutions\honeycombecommercegoods\app\helpers;

class PriceHelper
{
    /**
     * Truncates numbers without rounding
     *
     * @param $number
     * @param int $precision
     * @param bool $asFloat - return number as float
     * @return float|string
     */
    public static function truncate($number, $precision = 2, $asFloat = false)
    {
        $number = bcdiv($number, 1, $precision);

        return (new static())->ifAsFloat($number, $asFloat);
    }

    /**
     * Truncates numbers without rounding
     *
     * @param $number
     * @param int $precision
     * @param bool $asFloat - return number as float
     * @return float|string
     */
    public static function round($number, $precision = 2, $asFloat = false)
    {
        $number = number_format($number, $precision, '.', '');

        return (new static())->ifAsFloat($number, $asFloat);
    }

    /**
     * Get number in lithuanian language
     *
     * @param $price
     * @param int $precision
     * @return mixed
     */
    public static function inLt($price, $precision = 2)
    {
        $rounded = (new static())->round($price, $precision);

        return str_replace(".", ",", $rounded);
    }

    /**
     * Replace comma in number (convert from LT price to normal number)
     *
     * @param $number
     * @return mixed
     */
    public static function replaceComma($number)
    {
        return str_replace(",", ".", $number);
    }

    /**
     * Check if needed to return as float
     *
     * @param $number
     * @param $asFloat
     * @return float
     */
    private function ifAsFloat($number, $asFloat)
    {
        if( $asFloat ) {
            return (float)$number;
        }

        return $number;
    }

    /**
     *  Calculate taxes from price with taxes
     *
     * ----------------------------------
     * |        20 - 100 + $tax         |
     * |         x - 100                |
     * ----------------------------------
     * |   x = 20 * 100 / (100+$tax)    |
     * ----------------------------------
     *
     * @param $priceWithTaxes
     * @param $tax [9 | 21]
     * @return array [price without tax, tax amount]
     */
    public static function calcTaxes($priceWithTaxes, $tax)
    {
        $originalPrice = $priceWithTaxes / (1 + $tax * 0.01);

        $taxAmount = $priceWithTaxes - $originalPrice;

        return [$originalPrice, $taxAmount];
    }

    /**
     * Add taxes
     *
     * @param $price
     * @param $tax
     * @return mixed
     */
    public static function addTaxes($price, $tax)
    {
        return $price + $price * $tax * 0.01;
    }

    /**
     * Convert number to percents
     *
     * @param $number
     * @return float|int
     */
    public static function convertToPercent($number)
    {
        return (new static())->replaceComma($number) / 100;
    }

    /**
     * Convert number to percents
     *
     * @param $number
     * @return float|int
     */
    public static function convertFromPercent($number)
    {
        return $number * 100;
    }

    /**
     * Calculate discount in percentage
     *
     * @param $originalPrice
     * @param $finalPrice
     * @param int $precision
     * @return
     */
    public static function calculateDiscount($originalPrice, $finalPrice, $precision = 0)
    {
        return (new static())->round(
            (100 - ($finalPrice * 100 / $originalPrice)), $precision
        );
    }
}