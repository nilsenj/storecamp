<?php
$attributes = new \storecamp\htmlelements\Attributes(
    $attributes,
    ['class' => "alert {$type}"]
);
if ($closer) {
    $attributes->addClass('alert-dismissable');
    $contents = "<button type='button' class='close' " .
        "data-dismiss='alert' aria-hidden='true'>{$closer}" .
        "</button>{$contents}";
}
echo "<div {$attributes}>{$contents}</div>";
?>