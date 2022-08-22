<?php

$ar3 = array(
    'name' => 'John',
    'age' => 25,
    2, 4, 6
);

foreach($ar3 as $k=>$v){ //第一個是 key 第二個是 value 名字可以亂取，但順序不變
    echo "<div>$k: $v</div>";
}
?>