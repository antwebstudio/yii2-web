<?php
namespace ant\backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

use ant\rbac\components\Permission;
/**
 * Site controller
 */
class MaintenanceController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'clear-cache' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
        ];
    }
	
	public function actionClearCache() {
		if (Yii::$app->cache->flush() && Yii::$app->frontendCache->flush() && Yii::$app->backendCache->flush()) {
			Yii::$app->session->setFlash('success', 'Cache cleared successfully. ');
		} else {
			Yii::$app->session->setFlash('error', 'Cache failed to be cleared. ');
		}
		return $this->redirect(\Yii::$app->request->referrer);
	}

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render($this->action->id, [
		]);
    }
}
