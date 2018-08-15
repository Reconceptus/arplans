$(function () {
    'use strict';
    $(document).on('click', '.js-delete-preview', function () {
        var container = $(this).closest('.preview-image-block');
        var button = $(this);
        var postId = container.data('id');
        $.ajax({
            type: 'GET',
            url: '/admin/posts/delete-preview-image',
            data: {
                postId: postId
            },
            success: function (data) {
                if (data.status === 'success') {
                    container.find('.preview-image').remove();
                    button.remove();
                }
            }
        });
    });

    $(document).on('click', '.js-delete-preview-page', function () {
        var container = $(this).closest('.preview-image-block');
        var button = $(this);
        var postId = container.data('id');
        $.ajax({
            type: 'GET',
            url: '/admin/page/delete-preview-image',
            data: {
                postId: postId
            },
            success: function (data) {
                if (data.status === 'success') {
                    container.find('.preview-image').remove();
                    button.remove();
                }
            }
        });
    });

    $(function(){
        $("#wr-tabs").on("click", ".tab", function(){
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
    });
});