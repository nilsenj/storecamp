<?php

namespace storecamp\htmlelements;


class Slider
{
    public $attribute;
    public $className;

    public function create($idName, string $className, string $attribute, array $data = []): string
    {
        return "<input id=\"$idName\" type=\"text\" class='$className' name=\"$attribute\" >" . $this->script($idName, $data);
    }

    public function script($idName, $data)
    {
        return "/* ION SLIDER */
    $(\"#$idName\").ionRangeSlider({
      min: 0,
      max: 5000,
      from: 1000,
      to: 4000,
      type: 'double',
      step: 1,
      prefix: \"$\",
      prettify: false,
      hasGrid: true
    });";
    }
}