<?php

use yii\grid\GridView;
use yii\helpers\Html;

$user = Yii::$app->getModule("user")->model("User");
$role = Yii::$app->getModule("user")->model("Role");

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var amnah\yii2\user\models\search\UserSearch $searchModel
 * @var amnah\yii2\user\models\User $user
 * @var amnah\yii2\user\models\Role $role
 */

$this->title = Yii::t('user', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-header">
    <h2><?= Html::encode($this->title) ?></h2>
</div>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<div class="content body">
    <div class="box box-default">
        <div class="box-body">
            <p>
                <?= Html::a(Yii::t('user', 'Create {modelClass}', [
                    'modelClass' => 'User',
                ]), ['create'], ['class' => 'btn btn-success']) ?>
            </p>


            <?php \yii\widgets\Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                //     'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    [
                        'attribute' => 'role_id',
                        'label' => Yii::t('user', 'Role'),
                        'filter' => $role::dropdown(),
                        'value' => function ($model, $index, $dataColumn) use ($role)
                        {
                            $roleDropdown = $role::dropdown();

                            return $roleDropdown[$model->role_id];
                        },
                    ],
                    [
                        'attribute' => 'status',
                        'label' => Yii::t('user', 'Status'),
                        'filter' => $user::statusDropdown(),
                        'value' => function ($model, $index, $dataColumn) use ($user)
                        {
                            $statusDropdown = $user::statusDropdown();

                            return $statusDropdown[$model->status];
                        },
                    ],
                    'email:email',
                    'profile.full_name',
                    'create_time',
                    // 'new_email:email',
                    // 'username',
                    // 'password',
                    // 'auth_key',
                    // 'api_key',
                    // 'login_ip',
                    // 'login_time',
                    // 'create_ip',
                    // 'create_time',
                    // 'update_time',
                    // 'ban_time',
                    // 'ban_reason',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php \yii\widgets\Pjax::end(); ?>
        </div>
    </div>
</div>

