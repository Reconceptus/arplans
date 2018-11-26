function saveWays(arr, urls) {
    'use strict';
    arr.forEach(function (item, i, arr) {
        urls += ':' + item;
    });
    return urls
}

$(function () {
    'use strict';
    $(document).on('click', '.js-delete-preview', function () {
        var container = $(this).closest('.preview-image-block');
        var button = $(this);
        var postId = container.data('id');
        $.ajax({
            type: 'GET',
            url: '/admin/modules/blog/post/delete-preview-image',
            data: {
                postId: postId
            },
            success: function (data) {
                if (data.status === 'success') {
                    container.find('.preview-image').remove();
                    button.remove();
                    $('.old-image-input').val('');
                }
            }
        });
    });

    $(document).on('click', '.js-delete-preview-page', function () {
        var container = $(this).closest('.preview-image-block');
        var button = $(this);
        var pageId = container.data('id');
        $.ajax({
            type: 'GET',
            url: '/admin/modules/blog/page/delete-preview-image',
            data: {
                pageId: pageId
            },
            success: function (data) {
                if (data.status === 'success') {
                    container.find('.preview-image').remove();
                    button.remove();
                    $('.old-image-input').val('');
                }
            }
        });
    });

    // Переключение табов
    $("#wr-tabs").on("click", ".tab", function () {
        var tabs = $("#wr-tabs .tab"),
            cont = $("#wr-tabs .tab-cont");
        // Удаляем классы active
        tabs.removeClass("active");
        cont.removeClass("active");
        // Добавляем классы active
        $(this).addClass("active");
        cont.eq($(this).index()).addClass("active");
        return false;
    });

    // загрузка картинок товара
    $("form[name='uploader']").submit(function (e) {
        var formData = new FormData($(this)[0]);
        var container = $(this).closest('.images-block');
        var itemType = container.attr('data-type');
        if (!itemType) {
            itemType = 'shop/item';
        }
        $.ajax({
            url: '/admin/modules/' + itemType + '/upload',
            type: "POST",
            data: formData,
            async: false,
            success: function (result) {
                if (result.status === 'success') {
                    var panel = container.find('.images-panel').append(result.block);
                    var blocks = result.blocks;
                    blocks.forEach(function (item, i, blocks) {
                        panel.append(item);
                    });
                    if (result.type === '1') {
                        var urls = $('.new-images-input').attr("value");
                        urls = saveWays(result.files, urls);
                        $('.new-images-input').attr('value', urls);
                    } else if (result.type === '2') {
                        var urls = $('.new-plans-input').attr("value");
                        urls = saveWays(result.files, urls);
                        $('.new-plans-input').attr('value', urls);
                    } else if (result.type === '4') {
                        var urls = $('.new-files-input').attr("value");
                        urls = saveWays(result.files, urls);
                        $('.new-files-input').attr('value', urls);
                    } else {
                        var urls = $('.new-ready-input').attr("value");
                        urls = saveWays(result.files, urls);
                        $('.new-ready-input').attr('value', urls);
                    }
                }
            },
            error: function (result) {
                alert(result.message);
            },
            cache: false,
            contentType: false,
            processData: false
        });
        e.preventDefault();
    });

    $(document).on('click', '.js-image-admin-delete', function () {
        var path = $(this).data('path');
        var container = $(this).closest('.image-admin-preview');
        var id = container.data('id');
        var file = container.data('file');
        $.ajax({
            type: 'GET',
            url: '/admin/modules/' + path + '/delete-image',
            data: {
                id: id,
                file: file
            },
            success: function (data) {
                if (data.status === 'success') {
                    container.remove();
                    var urls = $('.new-images-input').attr("value");
                    var urlsNew = urls.replace(':' + file, '');
                    $('.new-images-input').attr('value', urlsNew);
                }
            }
        });
    });

    $(document).on('click', '.js-file-admin-delete', function () {
        var path = $(this).data('path');
        var container = $(this).closest('.image-admin-preview');
        var id = container.data('id');
        var file = container.data('file');

        $.ajax({
            type: 'GET',
            url: '/admin/modules/' + path + '/delete-file',
            data: {
                id: id,
                file: file
            },
            success: function (data) {
                if (data.status === 'success') {
                    container.remove();
                    var urls = $('.new-files-input').attr("value");
                    var urlsNew = urls.replace(':' + file, '');
                    $('.new-files-input').attr('value', urlsNew);
                }
            }
        });
    });

    $(document).on('click', '.js-ready-delete', function () {
        var container = $(this).closest('.image-admin-preview');
        var id = container.data('id');
        var file = container.data('file');
        $.ajax({
            type: 'GET',
            url: '/admin/modules/partner/about/delete-project',
            data: {
                id: id,
                file: file
            },
            success: function (data) {
                if (data.status === 'success') {
                    container.remove();
                    var urls = $('.new-images-input').attr("value");
                    var urlsNew = urls.replace(':' + file, '');
                    $('.new-images-input').attr('value', urlsNew);
                }
            }
        });
    });

    $(document).on('click', '.js-set-default-image', function () {
        var button = $(this);
        var path = button.data('path') ? button.data('path') : 'shop/item';
        var id = button.closest('.image-admin-preview').data('id');
        $.ajax({
            type: 'GET',
            url: '/admin/modules/' + path + '/set-preview',
            data: {
                id: id
            },
            success: function (data) {
                if (data.status === 'success') {
                    $('.default-image').addClass('js-set-default-image').removeClass('default-image');
                    button.removeClass('js-set-default-image').addClass('default-image');
                }
            }
        });
    });

    $(document).on('click', '.js-set-back-image', function () {
        var button = $(this);
        var path = button.data('path');
        var id = button.closest('.image-admin-preview').data('id');
        $.ajax({
            type: 'GET',
            url: '/admin/modules/' + path + '/set-back',
            data: {
                id: id
            },
            success: function (data) {
                if (data.status === 'success') {
                    $('.back-image').addClass('js-set-back-image').removeClass('back-image');
                    button.removeClass('js-set-back-image').addClass('back-image');
                }
            }
        });
    });

    $(document).on('click', '.js-save-catalog', function () {
        var button = $(this);
        var container = button.closest('.catalog-panel');
        var ok = true;
        var category = container.find('.cat-category').val();
        var name = container.find('.cat-name').val();
        var slug = container.find('.cat-slug').val();
        var sort = container.find('.cat-sort').val();
        $('div.help-block').each(function (i) {
            if ($(this).text() !== '') {
                ok = false;
            }
        });
        if (name && slug && sort && ok) {
            $.ajax({
                type: 'GET',
                url: '/admin/modules/shop/catalog/save-catalog',
                data: {
                    category: category,
                    name: name,
                    slug: slug,
                    sort: sort
                },
                success: function (data) {
                    if (data.status === 'success') {
                        button.remove();
                        $('.filter-panel').removeClass('hidden');
                        $('#catalog-id-span').attr('data-id', data.id);
                    } else {
                        alert(data.message);
                    }
                }
            });
        }
    })

    $(document).on('click', '.js-add-filter', function () {
        var id = $('#catalog-id-span').attr('data-id');
        if (id) {
            window.location.href = "add-item?id=" + id;
        }
    });

    $(document).on('click', '.js-show-project-field', function () {
        $('.old-project').hide();
        $('.item-project-field').show();
    });

    $(document).on('click', '.js-delete-benefit', function () {
        var button = $(this);
        var id = button.attr('data-id');
        var type = button.attr('data-type');
        if (id) {
            $.ajax({
                type: 'GET',
                url: '/admin/modules/' + type + '/delete-benefit',
                data: {
                    id: id
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var container = button.closest('.benefit');
                        container.remove();
                    } else {
                        alert(data.message);
                    }
                }
            });
        } else {
            alert('Это преимущество не может быть удалено до того, как вы сохраните изменения в услуге')
        }
    });

    $(document).on('click', '.js-add-benefit', function () {
        var button = $(this);
        var container = button.closest('.benefit-form');
        var name = container.find('.benefit-title').val();
        var text = container.find('.benefit-text').val();
        if (name) {
            var data = $('.new-benefits-input').attr("value");
            data += '~' + name + '|' + text;
            $('.new-benefits-input').attr('value', data);
            $('.benefits').append('<div class="benefit"><div class="title">' + name + '</div><div class="text">' + text + '</div></div>');
            $('.benefit-title').val('');
            $('.benefit-text').val('');
        }
    });

    $(document).on('click', '.js-category-checkbox', function () {
        var button = $(this);
        var category_id = button.data('category');
        var partner_id = button.data('partner');
        var checked = button.prop('checked') ? 1 : 0;
        $.ajax({
            type: 'GET',
            url: '/admin/modules/partner/partner/check-category',
            data: {
                category_id: category_id,
                partner_id: partner_id,
                checked: checked
            },
            success: function (data) {
                if (data.status === 'success') {
                    button.prop('checked', data.checked);
                }
            }
        });
    });

    $(document).on('click', '.js-delete-ci', function () {
        var button = $(this);
        var id = button.parent().attr('data-id');
        if (id) {
            $.ajax({
                type: 'GET',
                url: '/admin/modules/shop/catalog/delete-ci',
                data: {
                    id: id
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var container = button.closest('.filter');
                        container.remove();
                    } else {
                        alert(data.message);
                    }
                }
            });
        }
    });
    $('#setAlt').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var path = button.data('path');
        var modal = $(this);
        var title = button.attr('title') === 'Добавить подпись' ? '' : button.attr('title');
        $('#alt').val(title);
        var setBtn = modal.find('.js-set-img-alt');
        setBtn.attr('data-id', id);
        setBtn.attr('data-path', path);
    });

    $(document).on('click', '.js-set-img-alt', function () {
        var button = $(this);
        var id = button.data('id');
        var path = button.data('path');
        var alt = $('#alt').val();
        $.ajax({
            type: 'GET',
            url: '/admin/modules/' + path + '/set-alt',
            data: {
                id: id,
                alt: alt
            },
            success: function (data) {
                if (data.status === 'success') {
                    $('#setAlt').modal('hide');
                    var selector = $('.img-alt[data-id=' + id + ']');
                    selector.attr('title', alt);
                    if (alt) {
                        selector.addClass('green')
                    } else {
                        selector.removeClass('green')
                    }
                }
            }
        });
    });
});
