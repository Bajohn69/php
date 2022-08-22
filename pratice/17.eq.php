<pre>
    <?php
    $ar3 = [
        'name' => 'John',
        'age' => 25,
    ];

    $ar4 = $ar3; // 複製後再設定(不會動到 ar4)
    $ar5 = &$ar3;   // 設定位址 (類似參照), $ar5 是 $ar3 的別名

    $ar3['age'] = 32;

    print_r($ar3); //32
    print_r($ar4); //25
    print_r($ar5); //32


    $a = 10;
    $b = &$a;
    $b = 5;
    var_dump($a) // int(5)
    ?>
</pre>