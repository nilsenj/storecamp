<?php
if ($instance->getDropup()) {
    $string = "<div class='btn-group dropup'>";
} else {
    $string = "<div class='btn-group'>";
}
$attributes = new \storecamp\htmlelements\Attributes(
    $attributes,
    [
        'class' => "btn {$instance->getType()} dropdown-toggle",
        'data-toggle' => 'dropdown',
        'type' => 'button'
    ]
);

if ($instance->getSize()) {
    $attributes->addClass($instance->getSize());
}

if ($instance->getSplit()) {
    $splitAttributes = new \storecamp\htmlelements\Attributes(
        ['class' => $attributes['class'], 'type' => 'button']
    );
    $splitAttributes['class'] = str_replace(
        ' dropdown-toggle',
        '',
        $splitAttributes['class']
    );
    $string .= "<button {$splitAttributes}>{$instance->getLabel()}</button>";
    $string .= "<button {$attributes}><span class='caret'></span></button>";
} else {
    $string .= "<button {$attributes}>{$instance->getLabel()} <span class='caret'></span></button>";
}

$string .= "<ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'>";
$string .= $instance->renderItems();
$string .= "</ul>";
$string .= "</div>";

echo $string;
?>