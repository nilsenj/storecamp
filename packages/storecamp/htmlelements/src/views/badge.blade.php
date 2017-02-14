<?php

$attributes = new \storecamp\htmlelements\Attributes($attributes, ['class' => 'badge']);
$string = "<span {$attributes}>{$contents}</span>";
echo $string;
?>