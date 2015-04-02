<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>* { font-family: Arial; } body { padding-top: 100px; height: 900px; }</style>
</head>
<body>
<?php

use Zalgo\Mood;
use Zalgo\Soul;
use Zalgo\Zalgo;

require_once 'vendor/autoload.php';

    $zalgo = new Zalgo(new Soul(), Mood::twitter());
    $prophecy = $zalgo->speaks('the magic quotes they are coming for me I live only days');
    echo "<p>$prophecy</p>";
    #echo "<p>" . mb_strlen($prophecy) . "</p>";

?>
</body>
</html>