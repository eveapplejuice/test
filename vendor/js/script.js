$(document).ready(function ()
{
    $('.hide-btn').on('click', function (e)
    {
        let $trName = $(e.target).parents('tr');
        let $productID = $trName.attr('data-product-id');
        $.ajax({
            url: '/ajax.php',
            type: 'post',
            data: {
                ID: $productID,
                action: 'hide'
            },
            success: function(response) {
                let responseParse = JSON.parse(response);
                if (responseParse['success'] === 'Y') {
                    $trName.css('display', 'none');
                }
            }
        });
    });

    function changeQuantity(e, action)
    {
        let $trProduct = $(e.target).parents('tr');
        let $productID = $trProduct.attr('data-product-id');
        let $quantityInput = $trProduct.find('.product-qty');

        if (action === 'plus') {
            $quantityInput.val(parseInt($quantityInput.val()) + 1);
        } else if (action === 'minus') {
            $quantityInput.val(parseInt($quantityInput.val()) - 1);
        } else if (action !== 'input') {
            return false;
        }

        let $quantity = $quantityInput.val();

        $.ajax({
            url: '/ajax.php',
            type: 'post',
            data: {
                ID: $productID,
                quantity: $quantity,
                action: 'change_quantity'
            }
        });
    }

    $('.plus').on('click', function (e) {
        changeQuantity(e, 'plus');
    });

    $('.minus').on('click', function (e) {
        changeQuantity(e, 'minus');
    });

    $('.product-qty').on('change', function (e) {
        changeQuantity(e, 'input');
    });
});