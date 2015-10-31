<?php

/* @var $this yii\web\View */
/* @var $list array */
/* @var $year int */
/* @var $month int 1-12 */
$monthArray = [
    'Январь',
    'Февраль',
    'Март',
    'Апрель',
    'Май',
    'Июнь',
    'Июль',
    'Август',
    'Сентябрь',
    'Октябрь',
    'Ноябрь',
    'Декабрь',
];

$this->title = $monthArray[$month - 1] . ' ' . $year;

?>

<div class="intro">
        <?= $this->title ?>
</div>

<!-- Begin Blog Grid -->
<div class="blog-wrap">
    <!-- Begin Blog -->
    <div class="blog-grid">

        <?php foreach ($list as $item) { ?>
            <?php $article = new \app\models\Article($item) ?>
            <div class="post format-image box">
                <div class="frame">
                    <a href="<?= $article->getLink() ?>">
                        <img src="<?= $item['image'] ?>" alt=""/>
                    </a>
                </div>
                <h2 class="title"><a href="<?= $article->getLink() ?>"><?= $item['header'] ?></a></h2>

                <p><?= $item['description'] ?></p>

                <div class="details">
                    <span class="icon-image"><a href="#"><?= Yii::$app->formatter->asDate($item['date_insert']) ?></a></span>
                </div>
            </div>
        <?php } ?>

    </div>
</div>
<!-- End Blog Grid -->

