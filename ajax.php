<?
require_once 'vendor/classes/CProducts.php';

$result = [
    'success' => 'N'
];

if (!empty($_POST['action'])) {
    if ($_POST['action'] == 'hide' && !empty($_POST['ID'])) {
        if (CProducts::updateDB($_POST['ID'], ['PRODUCT_HIDE' => 'Y'])) {
            $result['success'] = 'Y';
        }
    }
    elseif ($_POST['action'] == 'change_quantity' && !empty($_POST['ID']) && !empty($_POST['quantity'])) {
        if (CProducts::updateDB($_POST['ID'], ['PRODUCT_QUANTITY' => $_POST['quantity']])) {
            $result['success'] = 'Y';
        }
    }
}

echo json_encode($result);
