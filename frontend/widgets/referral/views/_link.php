<?php
/* @var $link string */
?>
    <div class="ref-link"
         style="position: fixed; bottom:10px;right:10px;z-index: 999; background-color: #63b6f7; padding: 10px;">
        <input type="text" value="<?= $link ?>" id="referral-link" style="width: 400px">
        <button id="copy-ref" style="height: 35px; padding: 5px;color:#fff;background-color:#346697;border-color:#346697">Скопировать</button>
    </div>

<?php
$js = <<<JS
var button = document.getElementById('copy-ref');
button.addEventListener('click', function () {
  var ta = document.getElementById('referral-link');
  var range = document.createRange();
  range.selectNode(ta); 
  window.getSelection().addRange(range); 
  
  try { 
    document.execCommand('copy'); 
  } catch(err) { 
    console.log(''); 
  } 
  window.getSelection().removeAllRanges();
});
JS;
$this->registerJs($js);
