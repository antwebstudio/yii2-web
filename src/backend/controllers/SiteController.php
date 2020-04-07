<?php
namespace ant\backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use ant\user\models\LoginForm;
use backend\models\StoreData;
use yii\data\SqlDataProvider;

use ant\rbac\components\Permission;
/**
 * Site controller
 */
class SiteController extends Controller
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
                    'logout' => ['post'],
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
            'timezone' => [
                'class' => 'yii2mod\timezone\TimezoneAction',
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
	
	public function actionLanguage($language = 'en') {
		\Yii::$app->session['language'] = $language;
		\Yii::$app->language = $language;
		return $this->redirect(\Yii::$app->request->referrer);
	}

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    /**
    * Login action
    *
    * @return string
    */
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionTest(){
        return $this->render('index');
    }
	
	public function actionSetting() {
		return $this->render($this->action->id, [
			
		]);
	}
}
