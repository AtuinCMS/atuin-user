<?php


namespace atuin\user\helpers;


class SessionHelper
{

    public static function checkSession()
    {
        $sessionDirectory = \Yii::$app->getSession()->getSavePath();

        if (!is_writable($sessionDirectory)) {
            return FALSE;
        }
        return TRUE;
    }


    public static function getSessionPath()
    {
        return \Yii::$app->getSession()->getSavePath();
    }
}