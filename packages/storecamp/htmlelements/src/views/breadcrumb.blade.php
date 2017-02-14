<?php
/**
 * Renders the link
 *
 * @param $text
 * @param $link
 * @return string
 */
function renderLink($text, $link)
{
    $string = "";
    if (is_string($text)) {
        $string .= "<li>";
        $string .= "<a href='{$link}'>{$text}</a>";
    } else {
        $string .= "<li class='active'>";
        $string .= $link;
    }
    $string .= "</li>";

    return $string;
}

$attributes = new \storecamp\htmlelements\Attributes(
    $attr,
    ['class' => 'breadcrumb']
);

$string = "<ol {$attributes}>";
foreach ($links as $text => $link) {
    $string .= renderLink($text, $link);
}
$string .= "</ol>";
echo  $string;
?>