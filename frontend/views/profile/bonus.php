<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 25.10.2018
 * Time: 14:37
 */

use common\models\User;
use modules\shop\models\RefRequest;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model RefRequest */
/* @var $user User */
$this->title = 'Запрос на вывод денег';
?>
    <script>
        let balance = <?=$user->bonusRemnants?>;
    </script>
    <div class="section site-profile">
        <div class="content content--lg mobile-wide">
            <div class="request--wrap gradient">
                <div class="content content--xs">
                    <h1 class="title title-lg"><?= $this->title ?></h1>
                    <div class="profile-form">
                        <?php $form = ActiveForm::begin(); ?>
                        <div class="profile-form--wrap">
                            <div class="request-form--main custom-form">
                                <?= Html::activeLabel($model, 'amount', ['class' => 'label']) ?>
                                <div class="form-row-element has-label">
                                    <div class="input">
                                        <?= Html::activeTextInput($model, 'amount', ['placeholder' => 'Сумма (минимум 2000 рублей)', 'type' => 'number', 'step' => 100, 'min' => 2000, 'id' => 'amount-field']) ?>
                                    </div>
                                </div>
                                <?= Html::activeLabel($model, 'info', ['class' => 'label']) ?>
                                <div class="form-row-element has-label">
                                    <div class="input">
                                        <?= Html::activeTextInput($model, 'info', ['placeholder' => 'Комментарий к выводу (куда, как связаться)']) ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
                                </div>
                            </div>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$js = <<<JS
   $(document).on('focusout', '#amount-field', function () {
       let button = $(this);
       let val =  button.val();
       if(val<2000){
           button.val(2000);
           alert('Минимальная сумма для вывода - 2000 рублей');
            return false;
       }
       if(val>balance){
           button.val(balance);
           alert('Сумма для вывода не может быть больше, чем сумма у вас на балансе')
       }
   });
JS;

$this->registerJs($js);