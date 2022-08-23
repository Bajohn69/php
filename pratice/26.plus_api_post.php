<?php

$a = isset($_POST['a'])? intval($_POST['a']):0;
$b = isset($_POST['b'])? intval($_POST['b']):0;

echo $a + $b;
?>