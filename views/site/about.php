<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'О нас';
$this->params['breadcrumbs'][] = $this->title;

$page = \app\models\Page::find(1);
?>
<div class="box">

    <h1 class="title"><?= $page->getField('header') ?></h1>

    <div class="one-third">
        <div class="outer none"><span class="inset"><a href="<?= \cs\Widget\FileUpload2\FileUpload::getOriginal($page->getField('image')) ?>" target="_blank"><img src="<?= $page->getField('image') ?>" ></a></span></div>
        География ТПК
    </div>

    <div class="two-third last">
        <?= $page->getField('content') ?>
    </div>

    <div class="clear"></div>

</div>

