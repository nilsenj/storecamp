<?php
$attributes = new \storecamp\htmlelements\Attributes($attributes, $defaults);

// Add size and block status if needed
if ($instance->size) {
    $attributes->addClass($instance->size);
}

if ($instance->block) {
    $attributes->addClass(\storecamp\htmlelements\Button::BLOCK);
}

// Add the icon if needed
$value = $instance->icon ? $instance->getValueWithIcon() : $instance->value;

// Set disabled and url
if ($instance->disabled) {
    $attributes['disabled'] = 'disabled';
}

if ($instance->url) {
    $attributes['href'] = $instance->url;
}

// Create the right tag
$tag = $instance->url ? 'a' : 'button';

echo "<{$tag} {$attributes}>{$value}</{$tag}>";
?>