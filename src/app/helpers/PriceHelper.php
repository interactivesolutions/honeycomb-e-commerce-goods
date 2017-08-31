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

    /**
     * Convert number to words
     *
     * @link https://gist.github.com/evaqas/63fa204e3a1f0019bce2
     * @param $skaicius
     * @return string|void
     */
    public static function numberToWordLt($skaicius)
    {
        // neskaiciuosim neigiamu ir itin dideliu skaiciu (iki milijardu)
        if( $skaicius < 0 || strlen($skaicius) > 9 ) return;

        if( $skaicius == 0 ) return 'nulis';

        $vienetai = ['', 'vienas', 'du', 'trys', 'keturi', 'penki', 'šeši', 'septyni', 'aštuoni', 'devyni'];
        $niolikai = ['', 'vienuolika', 'dvylika', 'trylika', 'keturiolika', 'penkiolika', 'šešiolika', 'septyniolika', 'aštuoniolika', 'devyniolika'];
        $desimtys = ['', 'dešimt', 'dvidešimt', 'trisdešimt', 'keturiasdešimt', 'penkiasdešimt', 'šešiasdešimt', 'septyniasdešimt', 'aštuoniasdešimt', 'devyniasdešimt'];
        $pavadinimas = [
            ['milijonas', 'milijonai', 'milijonų'],
            ['tūkstantis', 'tūkstančiai', 'tūkstančių'],
        ];

        $skaicius = sprintf('%09d', $skaicius); // iki milijardu 10^9 (milijardu neskaiciuosim)
        $skaicius = str_split($skaicius, 3); // kertam kas tris simbolius

        $zodziais = [];

        foreach ( $skaicius as $i => $tripletas ) {
            // resetinam linksni
            $linksnis = 0;

            // pridedam simtu pavadinima, jei pirmas tripleto skaitmuo > 0
            if( $tripletas{0} > 0 ) {
                $zodziais[] = $vienetai[$tripletas{0}];
                $zodziais[] = ($tripletas{0} > 1) ? 'šimtai' : 'šimtas';
            }

            // du paskutiniai tripleto skaiciai
            $du = substr($tripletas, 1);

            // pacekinam nioliktus skaicius
            if( $du > 10 && $du < 20 ) {
                $zodziais[] = $niolikai[$du{1}];
                $linksnis = 2;
            } else {
                // pacekinam desimtis
                if( $du{0} > 0 ) {
                    $zodziais[] = $desimtys[$du{0}];
                }
                // pridedam vienetus
                if( $du{1} > 0 ) {
                    $zodziais[] = $vienetai[$du{1}];
                    $linksnis = ($du{1} > 1) ? 1 : 0;
                } else {
                    $linksnis = 2;
                }
            }

            // pridedam pavadinima isskyrus paskutiniam ir nuliniams tripletams
            if( $i < count($pavadinimas) && $tripletas != '000' ) {
                $zodziais[] = $pavadinimas[$i][$linksnis];
            }
        }

        return implode(' ', $zodziais);
    }

    /**
     * Currency word ending
     *
     * @param $number
     * @param string $saknis
     * @return string|void
     */
    public static function currencyEndingInLt($number, $saknis = 'eur')
    {
        if( $number < 0 || strlen($number) > 9 ) return;

        if( $number == 0 ) {
            return $saknis . 'ų';
        }

        $last = substr($number, -1);
        $du = substr($number, -2, 2);

        if( ($du > 10) && ($du < 20) ) {
            return $saknis . 'ų';
        } else {
            if( $last == 0 ) {
                return $saknis . 'ų';
            } elseif( $last == 1 ) {
                return $saknis . 'as';
            } else {
                return $saknis . 'ai';
            }
        }
    }
}