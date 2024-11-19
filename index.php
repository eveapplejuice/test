<?
require_once 'vendor/classes/CProducts.php';
require_once 'vendor/classes/FileManager.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <? FileManager::linkCSS('/vendor/css/style.css');?>
    <script src="vendor/js/jquery-3.7.1.min.js"></script>
    <title>Тестовое задание</title>
</head>
<body>
<div class="table-wrapper">
    <table class="products-table">
        <tr>
            <td>ID</td>
            <td>ID продукта</td>
            <td>Наименование</td>
            <td>Цена</td>
            <td>Артикул</td>
            <td>Количество</td>
            <td>Дата создания</td>
        </tr>
        <? $productsArray = CProducts::getProducts(false, true);
            foreach ($productsArray as $product) {
                ?><tr data-product-id="<?=$product['ID']?>" >
                    <? foreach ($product as $key => $value) {
                        if ($key == 'PRODUCT_QUANTITY') {
                            ?><td class="quantity-td border-btm">
                                <div class="change-quantity plus">+</div>
                                <input class="product-qty" value="<?=$value?>">
                                <div class="change-quantity minus">–</div>
                            </td><?
                        } else {
                            ?><td class="border-btm"><?=$value?></td><?
                        }
                    }?>
                    <td><div class="hide-btn">Скрыть</div></td>
                </tr><?
            }
        ?>
    </table>
</div>
<? FileManager::linkJS('/vendor/js/script.js'); ?>
</body>
</html>


