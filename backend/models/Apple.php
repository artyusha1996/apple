<?php
namespace backend\models;

use App\Helpers\Util;
use phpDocumentor\Reflection\Types\Integer;
use yii\base\InvalidArgumentException;
use yii\db\ActiveRecord;

class Apple extends ActiveRecord
{
    const STATUS_ON_THE_THREE = 1;
    const STATUS_FALLED = 2;
    const ROTTEN_TIME = 6;
    const FULL = 1;
    const COLORS = [
        'green',
        'red',
    ];

    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%apple}}';
    }

    public static function findById(Integer $id)
    {
        return static::findOne(
            ['id', $id]
        );
    }

    /**
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    function toFall()
    {
        if ($this->status != self::STATUS_ON_THE_THREE) {
            throw new \AppleAlreadyFalled();
        }

        return $this->update(false, [
            'status' => self::STATUS_FALLED,
            'falled_at' => (new \DateTime())->getTimestamp()
        ]);
    }

    /**
     * @param Integer $percentage
     * @throws \AppleCannotBeEatenException
     * @throws \InvalidPercentageException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function eat(Integer $percentage)
    {
        $willEatSize = $this->size * $percentage / 100;

        if (!Util::isValidPercentage($percentage)) {
            throw new \InvalidPercentageException();
        }

        if (
            $this->status == self::STATUS_ON_THE_THREE ||
            $this->isRotten() ||
            $this->size == 0
        ) {
            throw new \AppleCannotBeEatenException();
        }

        $this->update(false, [
            'size' => $this->size - $willEatSize
        ]);
    }

    public static function allValidQuery()
    {
        $validDate = (new \DateTime())
            ->modify("-" . self::ROTTEN_TIME . " hours");

        return static::find()
            ->where([
                ['>', 'size' => '0'],
                ['>=', 'falled_at', $validDate]
            ])
            ->all();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    protected function isRotten()
    {
        $rottenAt = (new \DateTime($this->rotten_at))
            ->modify("+" . self::ROTTEN_TIME . " hours");

        return new \DateTime() >= $rottenAt;
    }

}
