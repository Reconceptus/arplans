$(function () {
    'use strict';

    function getAmount() {
        var amount = 0.0;
        $("span.sum").each(function (index, item) {
            amount += parseFloat($(item).text());
        });
        $('#totalsum').text(amount);
    }

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
                    if (button.hasClass('liked')) {
                        button.removeClass('liked');
                    }
                }
                if (data.message) {
                    project.alertMessage(data.title, data.message)
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
                project.alertMessage(data.message);
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
                    container.find('.js-cart-price').text(data.price);
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
        button.hide();
        var isGuest = button.data('guest');
        var items = [];
        var reEmail = /^[\w]{1}[\w-\.]*@[\w-]+\.[a-z]{2,5}$/i;
        $('.album-num').each(function (index, item) {
            items.push({
                id: $(item).attr('data-id'),
                count: item.value,
                change: $(item).closest('.compare-table--item').find('.order-change-materials').prop('checked') ? 1 : 0
            })
        });
        var info = {
            'fio': $('#order-fio').val(),
            'phone': $('#order-phone').val(),
            'email': $('#order-email').val(),
            'country': $('#order-country').val(),
            'city': $('#order-city').val(),
            'address': $('#order-address').val(),
            'village': $('#order-village').val(),
            'promocode': $('#order-promocode').val(),
            'accept': $('#order-accept').prop('checked') ? 1 : 0
        };
        if (!info.accept) {
            project.alertMessage('Подтвердите согласие на использование персональных данных');
            button.show();
            return false;
        }
        if (!reEmail.test(info.email)) {
            project.alertMessage('Email, указанный вами, некорректен');
            button.show();
            return false;
        }
        if (!info.fio || !info.phone || !info.email || !info.city || !info.address) {
            project.alertMessage('Заполнены не все поля');
            button.show();
            return false;
        }
        if(isGuest>0){
            project.alertMessage('Подождите', 'сейчас вы будете перенаправлены на страницу оплаты');
        }
        $.ajax({
            type: 'GET',
            url: '/shop/cart/order',
            data: {
                items: items,
                info: info,
            },
            success: function (data) {
                if (data.status === 'success') {
                    project.alertMessage('Заказ успешно оформлен');
                    window.location.href = '/shop/payment/index?order=' + data.orderId;
                } else {
                    project.alertMessage('', data.message);
                    button.show();
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
    });

    $(document).on('click', '.cart-service', function () {
        var button = $(this);
        var price = parseInt(button.parent().find('.service-price').text(), 10);
        var name = button.parent().find('.service-name').text();
        var sumContainer = $('#totalsum');
        var id = button.data('id');
        if (button.prop('checked')) {
            var string = '<li class="service-buy" data-id="' + id + '">Услуга ' + name +
                // ' на сумму <span class="service-sum" data-id="' + id + '">' + price + '</span>' +
                '</li>';
            $('#items-to-buy').append(string);
            sumContainer.text(parseInt(sumContainer.text(), 10) + price);
        } else {
            $('#items-to-buy .service-buy[data-id="' + id + '"]').remove();
            sumContainer.text(parseInt(sumContainer.text(), 10) - price);
        }
    });
});