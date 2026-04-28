<?php

if ($argc < 2) {
    echo "Usage: php hash.php <password>\n";
    exit(1);
}

$password = $argv[1];
$hashed = password_hash($password, PASSWORD_DEFAULT);

echo "Plain: " . $password . PHP_EOL;
echo "Hash : " . $hashed . PHP_EOL;

?>