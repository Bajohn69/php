<?php
// PHP 的邏輯運算, 結果一定為布林值
    $a = 12;
    $b = 3;

    var_dump($a && $b); //bool(true)
    echo '<br>';
    var_dump($a || $b); //bool(true)
    echo '<br>';
    var_dump($a=6 && $b=7); //bool(true)
    echo '<br>';
    echo "$a, $b <br>"; // 1, 7 a=true=1

    $a = 12;
    $b = 3;
    var_dump($a=6 and $b=7 and $c=10);  # and, or 的優先權比 = 要低 //bool(true)
    echo '<br>';
    echo "$a, $b, $c <br>"; // 6, 7 

    $a = 12;
    $b = 3;
    $c = 9;
    var_dump($a=0 and $b=7 and $c=10);  # and, or 的優先權比 = 要低 //bool(false)
    echo '<br>';
    echo "$a, $b, $c <br>"; // 0, 3


