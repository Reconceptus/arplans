<?php
/* @var $link string */
?>

    <div class="ref-link">
        <div class="ref-link--title">Ваша ссылка на эту страницу для рефералов</div>
        <div class="ref-link--subtitle">Поделитесь ссылкой и зарабатывайте. Про <a href="/page/refinfo" target="_blank">реферальную
                систему</a></div>
        <div class="link">
            <div class="custom-form">
                <div class="input">
                    <input type="text" id="referral-link" readonly value="<?= $link ?>">
                </div>
            </div>
            <button type="button" id="copy-ref" class="copy-btn btn-square-dark">Copy</button>
        </div>
    </div>
<?php
$js = <<<JS
$("#copy-ref").click(function() { 
    $("#referral-link").select(); 
  
  try { 
    document.execCommand('copy'); 
  } catch(err) { 
    console.log(''); 
  } 
  window.getSelection().removeAllRanges();
});
JS;
$this->registerJs($js);
