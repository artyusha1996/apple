<?php


namespace backend\models;


use common\models\User;
use Yii;
use yii\base\Model;
use yii\web\UnauthorizedHttpException;

class AppleEatModel extends Model
{
    public $percentage;
    public $appleId;

    private $_user;
    private $_apple;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['percentage', 'required'],
            ['percentage', 'number', 'integerOnly' => true, 'min' => 1, 'max' => 100]
        ];
    }

    /**
     * @throws \AppleCannotBeEatenException
     * @throws \InvalidPercentageException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function eat()
    {
        return $this->authorize() && $this->getApple()->eat($this->percentage);
    }

    /**
     *
     * @return User|null
     */
    /**
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Yii::$app->user;
        }

        return $this->_user;
    }

    /**
     * @return Apple|null
     */
    protected function getApple() {
        if ($this->_apple === null) {
            $this->_apple =  Apple::findById($this->appleId);
        }

        return $this->_apple;
    }

    /**
     * @return bool
     * @throws UnauthorizedHttpException
     */
    private function authorize()
    {
        if ($this->getUser()->id !== $this->getApple()->user_id) {
            throw new UnauthorizedHttpException();
        }

        return true;
    }
}
