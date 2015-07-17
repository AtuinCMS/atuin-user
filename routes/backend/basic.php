<?php
use cyneek\yii2\routes\components\Route;


/**
 * Checks if a user is logged in. If not, it will throw a ForbiddenHttpException
 */
Route::filter('logged_in', [
    'class' => \yii\filters\AccessControl::className(),

    'rules' => [
        [
            'allow' => TRUE,
            'roles' => ['@'],
        ],
    ],
]);

/**
 * Checks if a user is logged out. If not, it will throw a ForbiddenHttpException
 */
Route::filter('logged_out', [
    'class' => \yii\filters\AccessControl::className(),
    'rules' => [
        [
            'actions' => ['login'],
            'allow' => TRUE,
            'roles' => ['@'],
        ],
    ],
]);


/**
 * Checks if a user is logged out. If not, it will throw a ForbiddenHttpException
 */
Route::filter('is_admin', [
    'class' => \yii\filters\AccessControl::className(),
    'rules' => [
        [
            'allow' => TRUE,
            'roles' => ['admin'],
        ],
    ],
]);


Route::any('login', 'user/login', ['filter' => 'logged_out']);
Route::any('user/logout', 'user/logout', ['filter' => 'logged_in']);
Route::any('user', 'user/admin');
Route::any('user/view', 'user/admin/view');
Route::any('user/create', 'user/admin/create');
Route::any('user/update', 'user/admin/update');
Route::any('user/delete', 'user/admin/delete');