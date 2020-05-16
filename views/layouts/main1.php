<?php
   /* @var $this \yii\web\View */
   /* @var $content string */
   
   use yii\helpers\Html;
   use yii\bootstrap\Nav;
   use yii\bootstrap\NavBar;
   use yii\widgets\Breadcrumbs;
   use frontend\assets\AppAsset;
   use common\widgets\Alert;
   use yii\helpers\Url;
   
   AppAsset::register($this);
   ?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
   <head>
      <meta charset="<?= Yii::$app->charset ?>">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <?= Html::csrfMetaTags() ?>
      <title>Talent Ocean</title>
      <?php $this->head() ?>
      <style>
         .infotable {
         border-collapse: collapse;
         }
         .infotable td,.infotable th {
         padding: 8px;
         text-align: center;
         padding-top: 12px;
         padding-bottom: 12px;
         }
         .infotable1 td,.infotable1 th{
         border: 1px solid white;
         }
         .infotable2 td,.infotable2 th{
         border: 1px solid black;
         }
         .infotable th {
         text-align: left;
         }
      </style>
   </head>
   <body>
      <?php $this->beginBody() ?>
      <div class="wrap">
      <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="#" class="wik37">Home</a></li>
            <li><a href="#about">ABOUT</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a class="button button1" href="<?=Url::to("site/signup")?>">SIGN UP</a></a></li>
            <li><a class="button button2" href="<?=Url::to("site/login")?>">SIGN IN</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
         <div class="">
            <div class="site-index">
               <?= $content ?>
            </div>
         </div>
      </div>
      <?php $this->endBody() ?>
      <script>
         $('#carouselFade').carousel();


         $(function () {
  $(document).scroll(function () {
    var $nav = $(".navbar-fixed-top");
    $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
  });
});
      </script>
   </body>
</html>
<?php $this->endPage() ?>

