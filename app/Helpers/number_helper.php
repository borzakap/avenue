<?php

/**
 * Number to distance Helpers
 */
if (!function_exists('number_to_distance')) {

    /**
     * Formats a numbers as miters, based on distance, and adds the appropriate suffix
     *
     * @param mixed   $num       Will be cast as int
     * @param integer $precision
     * @param string  $locale
     *
     * @return boolean|string
     */
    function number_to_distance($num, int $precision = 1, string $locale = null, bool $short = true) {
        // Strip any formatting & ensure numeric input
        try {
            $num = 0 + str_replace(',', '', $num); // @phpstan-ignore-line
        } catch (ErrorException $ee) {
            return false;
        }

        // ignore sub part
        $generalLocale = $locale;
        if (!empty($locale) && ($underscorePos = strpos($locale, '_'))) {
            $generalLocale = substr($locale, 0, $underscorePos);
        }

        if ($num >= 1000) {
            $num = round($num / 1000, $precision);
            if($short){
                $unit = lang('Distance.Kilemeter.Short', [], $generalLocale);
            }else{
                $unit = number_distance_word($num, $generalLocale, 'Kilemeter');
            }
        } else {
            if($short){
                $unit = lang('Distance.Meter.Short', [], $generalLocale);
            }else{
                $unit = number_distance_word($num, $generalLocale, 'Meter');
            }
        }

        return format_number($num, $precision, $locale, ['after' => ' ' . $unit]);
    }

}

//------------------------------------------------------------------//
                
if (!function_exists('number_distance_word')) {

    /**
     * get the right word 
     * 
     * @param int $value
     * @param string $generalLocale
     * @return string
     */
    function number_distance_word(int $value, string $generalLocale, string $distance = 'Meter') {
        $num = $value % 100;
        if ($num > 19) {
            $num = $num % 10;
        }
        $out = '';
        switch ($num) {
            case 1: $out = lang('Distance.' . $distance . '.one', [], $generalLocale);
                break;
            case 2:
            case 3:
            case 4: $out = lang('Distance.' . $distance . '.two', [], $generalLocale);
                break;
            default: $out = lang('Distance.' . $distance . '.meny', [], $generalLocale);
                break;
        }
        return $out;
    }

}