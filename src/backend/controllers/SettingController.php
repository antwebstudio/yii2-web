<?php
namespace ant\backend\controllers;

use Yii;
use yii\web\View;
use yii\web\Controller;
use yii\grid\GridView;
use yii\filters\VerbFilter;

use brussens\maintenance\MaintenanceMode;
use brussens\maintenance\commands\MaintenanceController;
use inspirenmy\config\ConfiguratorAdmin;
use inspirenmy\config\Configurator;

use ant\models\Config;
use backend\models\SettingForm;

/**
 * OrganizerController implements the CRUD actions for Organizer model.
 */
class SettingController extends Controller
{
    /**
     * @inheritdoc
     */

    public $_frontendApplicationDetails;

    // public function behaviors()
    // {
    //     return [
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'build' => ['post'],
    //             ],
    //         ],
    //     ];
    // }
    /**
     * Lists all Organizer models.
     * @return mixed
     */

    public function actionIndex()
    {
        $searchModel = new ConfiguratorAdmin();
        $searchModel->scenario = ConfiguratorAdmin::SCENARIO_SEARCH;

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new SettingForm(['attributeModels' => $dataProvider->models]);
      
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            $this->build();
            return $this->refresh();
        }


        return $this->render('index', ['model' => $model] );
    } 

    public function build()
    {
        $this->buildFrontend();
        $this->buildBackend();
    }

    protected function buildBackend()
    {
        Yii::$app->config->build();
    }

    protected function buildFrontend()
    {
        list($id, $path) = $this->getFrontendApplicationDetails();

        Yii::$app->config->build($id, $path);
    }

    protected function getFrontendApplicationDetails()
    {
        if ($this->_frontendApplicationDetails === null) 
        {
            $id     = null;
            $path   = Yii::getAlias('@frontend/config');

            $configFile = Yii::getAlias('@frontend/config/main.php');

            if (file_exists($configFile)) 
            {
                $config = require($configFile);

                if(isset($config['id'])) $id = $config['id'];
            }

            $this->_frontendApplicationDetails = [$id, $path];
        }

        return $this->_frontendApplicationDetails;
    }
}
