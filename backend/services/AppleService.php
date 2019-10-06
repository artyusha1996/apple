<?php
namespace backend\services;

use backend\models\Apple;

class AppleService extends Service
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function allWithPagination()
    {
        $validDate = (new \DateTime())
            ->modify("-" . \backend\models\Apple::ROTTEN_TIME . " hours");
        $query =  Apple::find()
            ->where([
                ['>', 'size' => '0'],
                ['>=', 'falled_at', $validDate]
            ]);

        return $this->withPagination($query);
    }
}
