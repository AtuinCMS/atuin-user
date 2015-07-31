<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var amnah\yii2\user\models\User $user
 * @var amnah\yii2\user\models\Profile $profile
 */

$this->title = Yii::t('user', 'Update {modelClass}: ', [
        'modelClass' => 'User',
    ]) . ' ' . $user->getDisplayName();
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->id, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = Yii::t('user', 'Update');
?>
<div class="content-header">
    <h2><?= Html::encode($this->title) ?></h2>
</div>
<div class="content body">
    <div class="box box-default">
        <div class="box-body">
            <?= $this->render('_form', [
                'user' => $user,
                'profile' => $profile,
            ]) ?>

        </div>
    </div>
</div>
