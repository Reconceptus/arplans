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
                var count = parseInt($('#count-favorite').text(), 10);
                var add = parseInt(data.counter, 10);
                $('#count-favorite').text(add + count);
            }
        });
    })

    $(document).on('click', '.js-to-cart', function () {
        var button = $(this);
        $.ajax({
            type: 'GET',
            url: '/shop/cart/add',
            data: {
                id: button.data('id')
            },
            success: function (data) {
                button.addClass('incart');
                button.text('В корзине');
                if (data.status === 'success') {
                    var count = $('#count-basket').text();
                    count = parseInt(count, 10);
                    count++;
                    $('#count-basket').text(count)
                }
                alert(data.message)
            }
        });
    })

    $(document).on('click', '.js-delete-cart-item', function () {
        var button = $(this);
        var container = button.closest('.compare-table--item');
        var id = button.data('id')
        $.ajax({
            type: 'GET',
            url: '/shop/cart/delete',
            data: {
                id: id
            },
            success: function (data) {
                if (data.status === 'success') {
                    var count = $('#count-basket').text();
                    count = parseInt(count, 10);
                    count--;
                    $('#count-basket').text(count);
                    container.remove();
                    var string = $("li.you-buy[data-id=" + id + "]");
                    string.remove();
                    getAmount();
                }
            }
        });
    });

    $(document).on('click', '.js-cart-change', function () {
        var button = $(this);
        var container = button.closest('.compare-table--section');
        var num = container.find('.album-num');
        var count = num.val();
        var minus = $('.minus');
        var id = container.data('id');
        $.ajax({
            type: 'GET',
            url: '/shop/cart/change',
            data: {
                id: id,
                count: count
            },
            success: function (data) {
                if (data.status === 'success') {
                    container.find('.price').text(data.price);
                    var string = $("span.sum[data-id=" + id + "]");
                    string.text(data.price);
                    getAmount();
                    if (data.count === 1) {
                        minus.addClass('disabled');
                    } else {
                        if (minus.hasClass('disabled')) {
                            minus.removeClass('disabled')
                        }
                    }
                }
            }
        });
    });

    $(document).on('click', '.js-order', function () {
        var button = $(this);
        var items = [];
        var services = [];
        var reEmail = /^[\w]{1}[\w-\.]*@[\w-]+\.[a-z]{2,5}$/i;
        $('.album-num').each(function (index, item) {
            items.push({
                id: $(item).attr('data-id'),
                count: item.value,
                change: $(item).closest('.compare-table--item').find('.order-change-materials').prop('checked') ? 1 : 0
            })
        });
        $('.cart-service').each(function (index, item) {
            if ($(item).prop('checked')) {
                services.push($(item).attr('data-id'));
            }
        });
        var info = {
            'fio': $('#order-fio').val(),
            'phone': $('#order-phone').val(),
            'email': $('#order-email').val(),
            'country': $('#order-country').val(),
            'city': $('#order-city').val(),
            'address': $('#order-address').val(),
            'village': $('#order-village').val(),
            'accept': $('#order-accept').prop('checked') ? 1 : 0
        };
        console.log(info);
        if (!info.accept) {
            alert('Подтвердите согласие на использование персональных данных');
            return false;
        }
        if (!reEmail.test(info.email)) {
            alert('Email, указанный вами, некорректен');
            return false;
        }
        if (!info.fio || !info.phone || !info.email || !info.city || !info.address) {
            alert('Заполнены не все поля');
            return false;
        }
        $.ajax({
            type: 'GET',
            url: '/shop/cart/order',
            data: {
                items: items,
                info: info,
                services: services
            },
            success: function (data) {
                if (data.status === 'success') {
                    alert('Заказ оформлен');
                }
            }
        });
    })

    $(document).on('click', '.js-delete-favorite-item', function () {
        var button = $(this);
        var container = button.closest('.compare-table--item');
        $.ajax({
            type: 'GET',
            url: '/shop/favorite/delete',
            data: {
                id: button.data('id')
            },
            success: function (data) {
                if (data.status === 'success') {
                    var count = $('#count-favorite').text();
                    count = parseInt(count, 10);
                    count--;
                    $('#count-favorite').text(count);
                    container.remove();
                }
            }
        });
    })

    $(document).on('click', '.main-checkbox', function () {
        var button = $(this);
        var container = button.closest('.catalog-filters--section');
        if (button.prop('checked') === true) {
            container.find('input:checkbox').prop('checked', true);
        } else {
            container.find('input:checkbox').prop('checked', false);
        }
    })

    function getAmount() {
        var amount = 0.0;
        $("span.sum").each(function (index, item) {
            amount += parseFloat($(item).text());
        });
        $('#totalsum').text(amount);
    }
});