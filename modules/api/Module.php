<?php

namespace app\modules\api;

use yii\web\Response;
use Yii;

/**
 * api module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\api\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
	    $this->layout = false;
	    Yii::$app->response->format = Response::FORMAT_JSON;
	    Yii::$app->user->enableSession = false;
	    Yii::$app->user->enableSession = false;
    }
}
