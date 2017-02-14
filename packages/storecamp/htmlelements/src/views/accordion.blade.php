
<?php
$attributes = new \storecamp\htmlelements\Attributes(
    $attributes,
    ['class' => 'panel-group', 'id' => $name]
);
$string = "<div {$attributes}>";
$count = 0;
foreach ($contents as $item) {
    $itemAttributes = array_key_exists(
        'attributes',
        $item
    ) ? $item['attributes'] : [];

    $itemAttributes = new \storecamp\htmlelements\Attributes(
        $itemAttributes,
        ['class' => 'panel panel-default']
    );

    $string .= "<div {$itemAttributes}>";
    $string .= "<div class='panel-heading'>";
    $string .= "<h4 class='panel-title'>";
    $string .= "<a data-toggle='collapse' data-parent='#{$name}' "
        . "href='#{$name}-{$count}'>{$item['title']}</a>";
    $string .= "</h4>";
    $string .= "</div>";

    $bodyAttributes = new \storecamp\htmlelements\Attributes(
        [
            'id' => "{$name}-{$count}",
            'class' => 'panel-collapse collapse'
        ]
    );

    if ($opened == $count) {
        $bodyAttributes->addClass('in');
    }

    $string .= "<div {$bodyAttributes}>";
    $string .= "<div class='panel-body'>{$item['contents']}</div>";
    $string .= "</div>";
    $string .= "</div>";
    $count++;
}
$string .= "</div>";
echo $string;
?>