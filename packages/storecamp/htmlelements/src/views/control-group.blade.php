<?php
$attributes = new \storecamp\htmlelements\Attributes(
    $attributes,
    ['class' => 'form-group']
);
$string = "<div {$attributes}>";

if ($instance->getLabel()) {
    $string .= $instance->renderLabel();
}

if ($instance->getControlSize()) {
    $string .= $instance->createControlDiv();
}

if (is_array($instance->getContents())) {
    $string .= $instance->renderArrayContents();
} else {
    $string .= $instance->getContents();
}

$string .= $instance->getHelp();

if ($instance->getControlSize()) {
    $string .= "</div>";
}
$string .= "</div>";

echo $string;
?>