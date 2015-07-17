<?php


namespace atuin\user;


class Module extends \atuin\skeleton\ComposerModule
{
    protected static $_id = 'atuin-user';

    protected static $_version = '0.0';
    
    
    /**
     * Checks if is a core module, atuin won't be able to uninstall or deactivate this module
     *
     * @var int
     */
    public $is_core_module = 1;

    /**
     * Used from AppManagement, determines if the module will be loaded in the backend zone.
     *
     * @var int
     */
    public $is_backend = 1;
    /**
     * Used from AppManagement, determines if the module will be loaded in the frontend zone.
     *
     * @var int
     */
    public $is_frontend = 1;


    public function getComposerPackageData()
    {
        return 'amnah/yii2-user:dev-master';
    }

}