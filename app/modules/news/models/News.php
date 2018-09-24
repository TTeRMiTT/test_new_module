<?php

namespace app\modules\news\models;


use app\core\Model;

/**
 * @property integer   $id
 * @property string    $title
 * @property string    $image
 * @property string    $content
 * @property string    $preview
 * @property string    $alias
 * @property \DateTime $data
 */
class News extends Model
{
    public $imageUploadPath = '/images/news/';
    public $file;

    public static function tableName()
    {
        return 'news';
    }

    public function attributeLabels()
    {
        return [
          'id'      => 'ID',
          'title'   => 'Заголовок',
          'content' => 'Описание',
          'preview' => 'Анонс',
          'image'   => 'Изображение',
          'data'    => 'Дата создания',
          'alias'   => 'Алиас',
        ];
    }


}