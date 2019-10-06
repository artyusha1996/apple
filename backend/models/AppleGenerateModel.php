<?php


namespace backend\models;


use common\models\User;
use yii\base\Model;
use yii\web\UnauthorizedHttpException;

class AppleGenerateModel extends Model
{
    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [];
    }

    /**
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function generate()
    {
        $count = rand(1, 100);
        $generatedApples = [];

        while ($count) {
            $generatedApples[] = $this->generateApple();
            $count--;
        }

        return $generatedApples;
    }

    private function generateApple()
    {
        $apple = new Apple();
        $apple->color = array_rand(Apple::COLORS);
        $apple->size  = Apple::FULL;
        $apple->status = Apple::STATUS_ON_THE_THREE;
        $apple->created_at = (new \DateTime())->getTimestamp();
        $apple->save();

        return $apple;
    }



    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
