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
use backend\models\Chat;
use common\models\User;
$unreadMessageCount=Chat::find()->where(['user_id'=>Yii::$app->user->id,'sent_from'=>'support','seen'=>0])->count();
$pursevalue= User::find()->where(['id' => Yii::$app->user->id])->one();
//$pursevalue=$pursevalue->purse;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <?= Html::csrfMetaTags() ?>
        <title>Talent Ocean</title>
        <?php $this->head() ?>
    </head>
    <body class="main3-body">
    <?php $this->beginBody() ?>



    <!-- /.navbar -->
    <div class=" row">
        <?php if (Yii::$app->user->identity->account_type == "talent") : ?>
        <div class="main3 col-md-2 sideColor">
            <div class="sidenav">
                <?php endif; ?>
                <?php if (Yii::$app->user->identity->account_type == "recruiter") : ?>
                <div class="main3 col-md-2 sideColor2">
                    <div class="sidenav2">
                        <?php endif; ?>
                        <div class="wik8">
                            <a href="<?=Url::to("@web/")?>">
                                <h3>Talent Ocean</h3>
                            </a>
                        </div>
                        <?php if (Yii::$app->user->identity->account_type == "recruiter") : ?>
                            <div class="sidebar-box">
                                <a href="<?=Url::to("/talentoceanapp/profile/index")?>"><div class="col-sm-4"><img src="../../images/home.svg" class="wik35"></div><div class="col-sm-8"><h4 style="margin-top:23px">Search Talents</h4></div></a>
                            </div>
                            <div class="sidebar-box">
                                <a href="<?=Url::to("/talentoceanapp/offers/index")?>"><div class="col-sm-4"><img src="../../images/history.svg" class="wik35"></div><div class="col-sm-8"><h4>Manage Offers</h4></div></a>
                            </div>
                        <?php endif; ?>
                        <?php if (Yii::$app->user->identity->account_type == "talent") : ?>
                            <div class="sidebar-box">
                                <a href="<?=Url::to("/talentoceanapp/profile/talent")?>"><div class="col-sm-4"><img src="../../images/home.svg" class="wik35"></div><div class="col-sm-8"><h4>Profile</h4></div></a>
                            </div>
                            <div class="sidebar-box">
                                <a href="<?=Url::to("/talentoceanapp/profile/index")?>"><div class="col-sm-4"><img src="../../images/history.svg" class="wik35"></div><div class="col-sm-8"><h4>Leader board</h4></div></a>
                            </div>
                            <div class="sidebar-box">
                                <a href="<?=Url::to("/talentoceanapp/offers/index")?>"><div class="col-sm-4"><img src="../../images/message.svg" class="wik35"></div><div class="col-sm-8"><h4>Offers</h4></div></a>
                            </div>
                        <div class="sidebar-box">
                            <a href="<?=Url::to("/talentoceanapp/referral/index")?>"><div class="col-sm-4"><img src="../../images/history.svg" class="wik35"></div><div class="col-sm-8"><h4>Referral</h4></div></a>
                        </div>
                        <div class="sidebar-box">
                            <a href="<?=Url::to("/talentoceanapp/mentor/index")?>"><div class="col-sm-4"><img src="../../images/history.svg" class="wik35"></div><div class="col-sm-8"><h4>Mentor</h4></div></a>
                        </div>
                        <div class="sidebar-box">
                            <a href="<?=Url::to("/talentoceanapp/feedback/index")?>"><div class="col-sm-4"><img src="../../images/message.svg" class="wik35"></div><div class="col-sm-8"><h4>Feedback</h4></div></a>
                        </div>
                        <?php endif; ?>
                        <div class="space200">

                        </div>
                        <div class="sidebar-box-logout">
                            <?='<li>'
                            . Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                '<div class="col-sm-8"><h2 class="wik36">Logout</h2></div><div class="col-sm-4"><img src="../../images/logout.svg" width="40px" height="40px"></div>',
                                ['class' => 'btn btn-link lOGOUT']
                            )
                            . Html::endForm()
                            . '</li>'?>
                        </div>
                        <div class="space90">

                        </div>
                    </div>
                </div>

                <div class="main3 col-md-10 main-body-padding">
                    <!-- nav starts-->
                    <?php if (Yii::$app->user->identity->account_type == "talent") : ?>
                    <div class="dashboard_nav">
                        <?php endif; ?>
                        <?php if (Yii::$app->user->identity->account_type == "recruiter") : ?>
                        <div class="dashboard_nav2">
                            <?php endif; ?>
                            <div class=" dropdown mobile-menu">
                                <span class="">Menu</span>
                                <span class="dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
            </span>
                                <ul class="dropdown-menu">
                                    <?php if (Yii::$app->user->identity->account_type == "recruiter") : ?>
                                        <li><a href="<?=Url::to("/talentoceanapp/profile/index")?>">Search Talents</a></li>
                                        <li> <a href="<?=Url::to("/talentoceanapp/offers/index")?>">Manage Offers</a></li>
                                    <?php endif; ?>
                                    <?php if (Yii::$app->user->identity->account_type == "talent") : ?>
                                        <li><a href="<?=Url::to("/talentoceanapp/profile/talent")?>">Profile</a></li>
                                        <li>  <a href="<?=Url::to("/talentoceanapp/profile/index")?>">Leader board</li>
                                        <li><a href="<?=Url::to("/talentoceanapp/offers/index")?>">Offers</a></li>

                                    <li><a href="<?=Url::to("/talentoceanapp/referral/index")?>">Referral</a></li>
                                    <li><a href="<?=Url::to("/talentoceanapp/mentor/index")?>">Mentor</a></li>
                                    <li><a href="<?=Url::to("/talentoceanapp/feedback/index")?>">Feedback</a></li>
                                    <?php endif; ?>
                                    <li><a href="<?=Url::to("/talentoceanapp/site/logout")?>">Logout</a></li>
                                </ul>
                            </div>
                            <span> <h4 class="logo-style2">Talent Ocean</h4>
</span>
                            <?php if (Yii::$app->user->identity->account_type == "truee") : ?>
                                <div class="nav2"><span class="width2"></span><?= ($unreadMessageCount==0) ? "" : '<span class="width2"></span><span class="width2"></span> You have <a href="'.Url::to("/talentoceanapp/site/support").'"><span style="color:rgb(217, 155, 74)">'.$unreadMessageCount.' unread message(s) <span class="messagedivider">|</span></span></a>'?><span class="width2"></span>Welcome <?= Yii::$app->user->identity->username; echo "(Purse : ₦$pursevalue->purse)"?>&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp

                                </div>
                            <?php endif; ?>
                            <div class="nav2"><span class="width2"></span><?= ($unreadMessageCount==0) ? "" : '<span class="width2"></span><span class="width2"></span> You have <a href="'.Url::to("/talentoceanapp/site/support").'"><span style="color:rgb(217, 155, 74)">'.$unreadMessageCount.' unread message(s) <span class="messagedivider">|</span></span></a>'?><span class="width2"></span><?php  echo (Yii::$app->user->identity->account_type == "talent") ? "<h2><b>Talent Portal</b></h2>" : "<h2><b>Recruiter Portal</b></h2>"?>&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp

                            </div>
                        </div>

                        <!-- nav ends-->
                        <div class="main3-container">
                            <?= Alert::widget() ?>
                            <?= $content ?>
                        </div>

                    </div>

                </div>




                <?php $this->endBody() ?>
                <script>
                    $('.dropdown-toggle').dropdown()

                </script>
    </body>
    </html>
<?php $this->endPage() ?>