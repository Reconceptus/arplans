$(function () {
    'use strict';
    $(document).on('click', '.js-favor', function () {
        var button = $(this);
        $.ajax({
            type: 'GET',
            url: '/shop/favorite/add',
            data: {
                id: button.data('id'),
                fav: !button.hasClass('liked')
            },
            success: function (data) {
                if (data.fav === true) {
                    button.addClass('liked');
                } else {
                    button.removeClass('liked');
                }
            }
        });
    })

    $(document).on('click', '.js-to-cart', function () {
        var button = $(this);
        $.ajax({
            type: 'GET',
            url: '/shop/cart/add',
            data: {
                id: button.data('id'),
            },
            success: function (data) {
                if (data.status === 'success') {
                    var count = $('#count-basket').text();
                    count = parseInt(count,10);
                    count++;
                    $('#count-basket').text(count)
                }
                alert(data.message)
            }
        });
    })
});