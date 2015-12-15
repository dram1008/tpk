<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'О нас';

$page = \app\models\Page::find(3);
?>
<div class="box">

    <h1 class="title">О нас</h1>

    <?= $page->getField('content') ?>


    <div class="clear"></div>

</div>

