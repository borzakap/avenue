<?php

if (!function_exists('poligon_center')) {

    function poligon_center(?string $poligon)
    {
        if(!$poligon){
            return [
                'x' => '50%',
                'y' => '50%',
            ];
        }
        $points = explode(',', $poligon);
        $ptc = [];
        for ($i = 0; $i < count($points); $i++) {
            $ptc[] = ['x' => $points[$i], 'y' => $points[++$i]];
        }
        $first = $ptc[0];
        $last = $ptc[count($ptc) - 1];
        if ($first['x'] != $last['x'] || $first['y'] != $last['y']){
            $ptc[] = $first;
        }
        $twicearea = 0;
        $x = 0;
        $y = 0;
        $nptc = count($ptc);
        $p1 = null;
        $p2 = null;
        $f = null;
        for ($i = 0, $j = $nptc - 1; $i < $nptc; $j = $i++) {
            $p1 = $ptc[$i];
            $p2 = $ptc[$j];
            $f = $p1['x'] * $p2['y'] - $p2['x'] * $p1['y'];
            $twicearea += $f;
            $x += ($p1['x'] + $p2['x']) * $f;
            $y += ($p1['y'] + $p2['y']) * $f;
        }
        $f = $twicearea * 3;
        return [
            'x' => $x / $f, 
            'y' => $y / $f,
        ];
    }
}
