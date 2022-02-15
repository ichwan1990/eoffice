<?php
$items = [
[
    'id' => '1',
    'parent_id' => '0',
    'title' => 'Menu 1',
],
[
    'id' => '2',
    'parent_id' => '0',
    'title' => 'Menu 2',
],
[
    'id' => '3',
    'parent_id' => '2',
    'title' => 'Menu 2 1',
],
[
    'id' => '4',
    'parent_id' => '0',
    'title' => 'Menu 3',
],
[
    'id' => '5',
    'parent_id' => '4',
    'title' => 'Menu 3 1',
],
[
    'id' => '6',
    'parent_id' => '5',
    'title' => 'Menu 3 1 1',
],
[
    'id' => '7',
    'parent_id' => '5',
    'title' => 'Menu 3 1 2',
],
[
    'id' => '8',
    'parent_id' => '7',
    'title' => 'Menu 3 1 2 1',
],
[
    'id' => '9',
    'parent_id' => '4',
    'title' => 'Menu 3 2',
],
[
    'id' => '10',
    'parent_id' => '0',
    'title' => 'Menu 4',
]];

/**
 * Recursive and prints the elements of the given parent id.
 * @param $items
 * @param string $parentId
 */
function buildNestedItems($items, $parentId = "0", $wrapperTag = 'ul', $itemTag = 'li')
{
    // Parent items control
    $isParentItem = false;
    foreach ($items as $item) {
        if ($item['parent_id'] === $parentId) {
            $isParentItem = true;
            break;
        }
    }

    // Prepare items
    $html = "";
    if ($isParentItem) {
        $html .= "<$wrapperTag>";
        foreach ($items as $item) {
            if ($item['parent_id'] === $parentId) {
                $html .= "<$itemTag>" . $item['title'] . "</$itemTag>";
                $html .= buildNestedItems($items, $item['id']);
            }
        }
        $html .= "</$wrapperTag>";
    }
    return $html;
}
?>

<div class="menu">
    <?php echo buildNestedItems($items); ?>
</div>