<?php

namespace app\core;


class Debug
{
    public static function prePrint($arr)
    {

         echo '<pre>'.htmlspecialchars(print_r($arr, true)).'</pre>';
    }

    public static function preDamp($arr)
    {
            ob_start();
            echo '<pre>';
            var_dump($arr);
            echo '</pre>';
            $out1 = ob_get_contents();
            ob_end_clean();
            echo $out1;
    }
}