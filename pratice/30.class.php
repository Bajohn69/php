<?php

class Person {
    public $name; //屬性
    public $age;
    // 屬性宣告

    function __construct($name, $age)
    {
        $this->name = $name;  // 把參數 (區域變數) 設定到屬性
        $this->age = $age;
    }
    // 建構函式定義

    function getJSON(){
        return json_encode([
            'name' => $this->name,
            'age' => $this->age,
        ], JSON_UNESCAPED_UNICODE);
    }
    // ⽅法定義
}

$p1 = new Person('pete', 19);

echo $p1->getJSON();

//class 類別名稱 //類別定義的標頭
{
// 屬性宣告
// 建構函式定義
// ⽅法定義
}

?>