<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var amnah\yii2\user\models\forms\LoginForm $model
 */


$this->title = Yii::t('user', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-login">

    <div class="box">

        <div class="box-header with-border">
            <h2><?= Html::encode($this->title) ?></h2>
        </div>
        <div class="box-body">
            <span id="helpBlock" class="help-block"><?= Yii::t("user", "Please fill out the following fields to login:") ?></span>
            
            <?php
            if (\atuin\user\helpers\SessionHelper::checkSession() == FALSE)
            {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <h4>
                        <i class="icon fa fa-ban"></i>
                        <?= Yii::t('atuin-user', 'Alert!') ?>
                    </h4>
                    <?= Yii::t('atuin-user', "The session directory in your system '{directory}' it's not writable by the PHP user, please fix this directory's permissions before logging in the Atuin system.",
                        ['directory' => \atuin\user\helpers\SessionHelper::getSessionPath()]) ?>
                </div>
                <?php
            }
            ?>


            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-md-3\">{input}</div>\n<div class=\"col-md-7\">{error}</div>",
                    'labelOptions' => ['class' => 'col-md-2 control-label'],
                ],

            ]); ?>

            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe', [
                'template' => "{label}<div class=\"col-lg-offset-2 col-md-3\">{input}</div>\n<div class=\"col-md-7\">{error}</div>",
            ])->checkbox() ?>

            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <?= Html::submitButton(Yii::t('user', 'Login'), ['class' => 'btn btn-primary', 'disabled' => ((\atuin\user\helpers\SessionHelper::checkSession()) ? FALSE : TRUE)]) ?>
                </div>
            </div>
            <div class="box-footer">

                <?= Html::a(Yii::t("user", "Register"), ["/user/register"]) ?> /
                <?= Html::a(Yii::t("user", "Forgot password") . "?", ["/user/forgot"]) ?> /
                <?= Html::a(Yii::t("user", "Resend confirmation email"), ["/user/resend"]) ?>

            </div>
            <?php ActiveForm::end(); ?>

            <?php if (Yii::$app->get("authClientCollection", FALSE)): ?>
                <div class="col-lg-offset-2 col-lg-10">
                    <?= yii\authclient\widgets\AuthChoice::widget([
                        'baseAuthUrl' => ['/user/auth/login']
                    ]) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>