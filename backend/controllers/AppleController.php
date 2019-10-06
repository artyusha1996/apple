<?php
namespace backend\controllers;

use App\Helpers\HttpResponseHelper;
use backend\models\Apple;
use backend\models\AppleEatModel;
use backend\models\AppleFallModel;
use backend\models\AppleGenerateModel;
use Yii;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class AppleController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['list', 'fall', 'eat', 'generate'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionList()
    {
        $apples = Apple::allValid();

        return $this->render('list', [
            'apples' => $apples
        ]);
    }

    /**
     * @return array
     * @throws \InternalServerException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function fallAction()
    {
        $model = new AppleFallModel();

        $model->load(Yii::$app->request->post());
        $model->fall();

        return $this->responseJSON();
    }

    /**
     * @return array
     * @throws \AppleCannotBeEatenException
     * @throws \InternalServerException
     * @throws \InvalidPercentageException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function eatAction()
    {
        $model = new AppleEatModel();

        $model->load(Yii::$app->request->post());
        $model->eat();

        return $this->responseJSON();
    }

    /**
     * @return array
     * @throws \InternalServerException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function generateAction()
    {
        $model = new AppleGenerateModel();

        $model->load(Yii::$app->request->post());
        $result = $model->generate();

        return $this->responseJSON($result);
    }
}
