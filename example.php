<?php
use classes\Class1;
use classes2\Class2;
require ("./vendor/autoload.php");

$obj = new Class1();

$obj->echoHello();
echo("<br>");
$obj2 = new Class2();
$obj2->echoHello();