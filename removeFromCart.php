<?php
session_start();

if (!isset($_POST['index'])) {
    echo json_encode(array('success' => false, 'message' => 'Item index is not provided.'));
    exit;
}

$itemIndex = intval($_POST['index']);

// Check if the item index is valid
if ($itemIndex < 0 || $itemIndex >= count($_SESSION['cart'])) {
    echo json_encode(array('success' => false, 'message' => 'Invalid item index.'));
    exit;
}

// Remove the item from the cart array
unset($_SESSION['cart'][$itemIndex]);

// Reindex the array to remove any gaps
$_SESSION['cart'] = array_values($_SESSION['cart']);

echo json_encode(array('success' => true));
?>
