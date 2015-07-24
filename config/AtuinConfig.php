<?php

namespace atuin\user\config;

use amnah\yii2\user\models\Profile;
use amnah\yii2\user\models\User;
use amnah\yii2\user\models\UserAuth;
use amnah\yii2\user\models\UserKey;
use atuin\config\models\ModelConfig;


/**
 * Class ConfigSkeleton
 * @package common\engine\module_skeleton\libraries
 *
 * Class called to install a module in the CMS.
 *
 * Here must be all the automatic changes in the system that will be necessary to install a new module.
 *
 */
class AtuinConfig extends \atuin\skeleton\config\AtuinConfig
{

	/**
	 * @inheritdoc
	 */
	public function upMigration()
	{

	}

	/**
	 * @inheritdoc
	 */
	public function downMigration()
	{

	}

	/**
	 * @inheritdoc
	 */
	public function upMenu()
	{
		$this->menuItems->add_menu_item('users_head', NULL, NULL, 'Users', 'user', NULL, 1);
		$this->menuItems->add_menu_item('users_admin', 'user', 'users_head', 'User List', 'users', NULL, 1);
		$this->menuItems->add_menu_item('users_new', 'user/create', 'users_head', 'New User', 'user-plus', NULL, 1);
		$this->menuItems->add_menu_item('users_profile', 'user/profile', 'users_head', 'Profile', 'male', NULL, 1);

		$this->menuItems->add_menu_item('Roles', 'user/roles', NULL, 'Roles', 'user-secret', NULL, 1);
	}


	/**
	 * @inheritdoc
	 */
	public function downMenu()
	{
		$this->menuItems->delete_menu_item('users_head');
		$this->menuItems->delete_menu_item('users_admin');
		$this->menuItems->delete_menu_item('users_new');
		$this->menuItems->delete_menu_item('users_profile');

	}

	/**
	 * @inheritdoc
	 */
	public function upConfig()
	{

		// Adding the USER component
		ModelConfig::addConfig(NULL, 'components', 'user', 'class',
			'amnah\yii2\user\components\User', FALSE);

		ModelConfig::addConfig(NULL, 'components', 'user', 'identityClass',
			'amnah\yii2\user\models\User', FALSE);
		ModelConfig::addConfig(NULL, 'components', 'user', 'enableAutoLogin',
			TRUE, FALSE);

		ModelConfig::addConfig(NULL, 'components', 'user', 'enableSession',
			TRUE, FALSE);


		// Adding Amnah-User module settings

		ModelConfig::addConfig(NULL, 'modules', 'user', 'class',
			'amnah\yii2\user\Module', FALSE);
		ModelConfig::addConfig(NULL, 'modules', 'user', 'requireEmail',
			TRUE, FALSE);
		ModelConfig::addConfig(NULL, 'modules', 'user', 'requireUsername',
			TRUE, FALSE);
		ModelConfig::addConfig(NULL, 'modules', 'user', 'loginUsername',
			FALSE, FALSE);

		// Adding bootstrap calling to this module
		ModelConfig::addConfig(NULL, NULL, NULL, 'bootstrap',
			array('user'), FALSE);

		// Setting translations for user app
		ModelConfig::addConfig(NULL, 'components', 'i18n', 'translations',
			[
				'user' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@vendor/amnah/yii2-user/messages',
				]
			], FALSE);

		ModelConfig::addConfig(NULL, 'components', 'i18n', 'translations',
			[
				'atuin-user' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@vendor/atuin/atuin-user/messages',
				]
			], FALSE);

		// Adding view redirections to use Atuin views instead of the original ones
		ModelConfig::addConfig(NULL, 'components', 'view', 'theme',
			[
				'pathMap' => [
					'@vendor/amnah/yii2-user/views' => '@vendor/atuin/atuin-user/views'
				]
			], FALSE);

		// Adding layout for backend zone
		ModelConfig::addConfig('app-backend', 'modules', 'user', 'layout',
			'@vendor/atuin/engine/views/layouts/backend_layout', FALSE);


		$baseUrl = str_replace('/frontend/web', '', \Yii::$app->getRequest()->getBaseUrl());
		$baseUrl = str_replace('/backend/web', '', $baseUrl);
		$baseUrl = str_replace('/admin', '', $baseUrl);

		// Adding alias for login url
		ModelConfig::addConfig(NULL, 'aliases', NULL, '@atuin/loginUrl',
			$baseUrl . '/admin/login', FALSE);

	}


	/**
	 * @inheritdoc
	 */
	public function downConfig()
	{
	}

	/**
	 * @inheritdoc
	 */
	public function upManual()
	{
		// delete neo user that the migration automatically adds
		UserKey::deleteAll(['user_id' => 1]);
		UserAuth::deleteAll(['user_id' => 1]);
		Profile::deleteAll(['user_id' => 1]);
		User::deleteAll(['id' => 1]);
	}


	/**
	 * @inheritdoc
	 */
	public function downManual()
	{

	}

}