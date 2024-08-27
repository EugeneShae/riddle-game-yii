<?php

/** @var yii\web\View $this */
/** @var app\widgets\RiddleWidget $widget */

use yii\helpers\Html;
use yii\widgets\Pjax;

?>

<?php Pjax::begin(['id' => 'riddle-pjax', 'enablePushState' => false]); ?>
<?= Html::beginForm(['site/open-box'], 'post', ['id' => 'riddle-form', 'data-pjax' => true]); ?>
    <div id="riddle-widget" class="row">
        <?= $widget->boxesBlock() ?>
    </div>
<?= Html::endForm(); ?>
<?php Pjax::end(); ?>
