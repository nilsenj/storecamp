<?php

$attributes = new \storecamp\htmlelements\Attributes(
    $attributes,
    [
        'id' => $name,
        'class' => 'carousel slide',
        'data-ride' => 'carousel'
    ]
);
/**
 * @param $instance \storecamp\htmlelements\Carousel
 */
$string = "<div {$attributes}>";
$string .= $instance->renderIndicators();
$string .= $instance->renderItems();
$string .= $instance->renderControls();
$string .= "</div>";
echo $string;
?>