<?php


namespace backend\services;


use yii\data\Pagination;

class Service
{
    protected function withPagination($query)
    {
        $pages = new Pagination(['totalCount' => $query->count()]);

        return $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
    }
}
