<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 13.08.2018
 * Time: 11:44
 */

?>
<script>
    var arr = [];
    var itemHistory = localStorage.getItem('itemHistory');
    if (itemHistory !== undefined && itemHistory) {
        arr = JSON.parse(itemHistory);
        $.ajax({
            type: 'GET',
            url: '/shop/history',
            data: {
                arr: arr.reverse()
            },
            success: function (data) {
                if (data.status === 'success') {
                    $('.projects-slider').html(data.html);
                    project.projectsCarousel();
                }
            }
        });
    }
    if (typeof ITEM_ID !== 'undefined') {
        if (arr.indexOf(ITEM_ID) === -1) {
            arr.unshift(ITEM_ID);
            if (arr.length > 10)
                arr.pop();
        }
        localStorage.setItem('itemHistory', JSON.stringify(arr));
    }
</script>
<div class="section projects-slider">

</div>
