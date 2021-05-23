<?php
/**
 * Created by PhpStorm.
 * Author: yidashi
 * DateTime: 2017/3/9 13:06
 * Description:
 */

namespace api\modules\v2\models\article;


class Photo extends \common\modules\document\models\document\Photo
{
    public function fields()
    {
        return [
            'photos',
            'photos_total' => function ($model) {
                return count($model->photos);
            }
        ];
    }
}