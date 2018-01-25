<?php

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\Menu;

AppAsset::register($this);
/**
 * @var $this \yii\base\View
 * @var $content string
 */
// $this->registerAssetBundle('app');
?>
<?php $this->beginPage(); ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo Html::encode(\Yii::$app->name); ?> - A ThemeFactory.net Theme</title>

        <?php $this->head() ?>


        <!-- Custom CSS -->
        <link href="<?php echo $this->theme->baseUrl ?>/css/business-casual.css" rel="stylesheet">

        <!-- Fonts -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>
        <?php $this->beginBody() ?>
        <div class="brand"><?php echo Html::encode(\Yii::$app->name); ?></div>
        <div class="address-bar">Desarrollo de Aplicaciones Web</div>

        <!-- Navigation -->
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-default',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'Registro', 'url' => ['/site/registrar']],
                Yii::$app->user->isGuest ? (
                        ['label' => 'Login', 'url' => ['/site/login']]
                        ) : (
                        '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>'
                        )
            ],
        ]);
        NavBar::end();
        ?>

        <div class="container">


            <div class="row">
                <div class="box">
                    <div class="col-lg-12">
                        <?php echo $content; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="box">
                    <div class="col-lg-12 text-center">
                        <div id="carousel-example-generic" class="carousel slide">
                            <ol class="carousel-indicators hidden-xs">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="img-responsive img-full" src="data:image/jpeg;base64,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" alt="">
                                </div>
                                <div class="item">
                                    <img class="img-responsive img-full" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSoXXYStmqUE6PBdlFJAy6UH2PXKyVRbzKubwHU5TIL6u6mDT1Mhg" alt="">
                                </div>
                                <div class="item">
                                    <img class="img-responsive img-full" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQVc9RwxAGcvlvzPFw3cEvIrWBTcbtFI47Ar8uEOW0OdU0Z4Fpy-Q" alt="">
                                </div>
                            </div>

                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="icon-prev"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="icon-next"></span>
                            </a>
                        </div>
                        <h2 class="brand-before">
                            <small>Ultimos Usuarios</small>
                        </h2>
                        <h1 class="brand-name">Curso Aplicaciones Web 2018</h1>
                        <hr class="tagline-divider">
                        <h2>
                            <small>Impartido en
                                <strong>Alpe Formación</strong>
                            </small>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container -->

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <p>Copyright &copy; <?php echo Html::encode(\Yii::$app->name); ?> 2018</p>
                    </div>
                </div>
            </div>
        </footer>

        <?php
        $this->registerJs(
                "$('.carousel').carousel({
                interval: 3000
            });"
        );
        ?>
        <?php $this->endBody(); ?>
    </body>
</html>
<?php $this->endPage(); ?>