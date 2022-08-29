<?php
$p = '123456';

echo json_encode([
    'hash1' => password_hash($p, PASSWORD_DEFAULT), // 亂碼而且是不可逆的
    'hash2' => password_hash($p, PASSWORD_DEFAULT), // 再做一次也不會一樣
    'md5_1' => md5($p), // 再做一次都一樣(不建議)
    'md5_2' => md5($p),
    'sha1_1' => sha1($p), // 再做一次都一樣(不建議)
    'sha1_2' => sha1($p),
]);

// 驗證密碼
//password_verify('string' $password, 'string' $hash): bool; // 會得到布林值(但也不會知道實際密碼)


// 想知道以下字符从哪里来，可参见 password_hash() 的例子
$hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';

if (password_verify('rasmuslerdorf', $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}
