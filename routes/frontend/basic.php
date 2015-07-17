<?php
use cyneek\yii2\routes\components\Route;


	/**
	 * Checks if a user is logged in. If not, it will throw a ForbiddenHttpException
	 */
	Route::filter('logged_in', [
		'class' => \yii\filters\AccessControl::className(),

		'rules' => [
			[
				'allow' => true,
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
				'allow' => true,
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
				'allow' => true,
				'roles' => ['admin'],
			],
		],
	]);





	/**
	 * BASIC SITES
	 */

	Route::any('user', 'user/default/index', ['filter' => 'is_admin']);
	Route::any('user/login', 'user/login', ['filter' => 'logged_out']);
	Route::any('user/logout', 'user/logout');
	Route::any('user/register', 'user/register');
	Route::any('user/account', 'user/account');
	Route::any('user/profile', 'user/profile');
	Route::any('user/forgot', 'user/forgot');
	Route::any('user/reset', 'user/reset');
	Route::any('user/resend', 'user/resend');
	Route::any('user/resend-change', 'user/resend-change');
	Route::any('user/cancel', 'user/cancel');
	Route::any('user/confirm', 'user/confirm');
	Route::any('user/auth/login', 'user/auth/login');
	Route::any('user/auth/connect', 'user/auth/connect');
