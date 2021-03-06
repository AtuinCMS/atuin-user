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
<section class="content">
    <div class="col-sm-offset-2 col-sm-9">
        <?php
        if (\atuin\user\helpers\SessionHelper::checkSession() == FALSE) {
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
        <div class="box">
            <div class="box-header with-border">
                <h2><?= Html::encode($this->title) ?></h2>
            </div>
            <div class="box-body">
            <span id="helpBlock"
                  class="help-block"><?= Yii::t("user", "Please fill out the following fields to login:") ?></span>


                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-md-5\">{input}</div>\n<div class=\"col-md-4\">{error}</div>",
                        'labelOptions' => ['class' => 'col-md-2 control-label'],
                    ],

                ]); ?>

                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe', [
                    'template' => "{label}<div class=\"col-md-offset-2 col-md-3\">{input}</div>\n<div class=\"col-md-7\">{error}</div>",
                ])->checkbox() ?>

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <?= Html::submitButton(Yii::t('user', 'Login'), ['class' => 'btn btn-primary', 'disabled' => ((\atuin\user\helpers\SessionHelper::checkSession()) ? FALSE : TRUE)]) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>

                <div class="box-footer">
                    <?= Html::a(Yii::t("user", "Register"), ["/user/register"]) ?> /
                    <?= Html::a(Yii::t("user", "Forgot password") . "?", ["/user/forgot"]) ?> /
                    <?= Html::a(Yii::t("user", "Resend confirmation email"), ["/user/resend"]) ?>
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
    </div>
</section>