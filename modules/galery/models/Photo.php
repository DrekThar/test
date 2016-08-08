<?php

namespace app\modules\galery\models;

use Yii;
use yii\imagine\Image;

/**
 * This is the model class for table "photo".
 *
 * @property integer $id
 * @property integer $album_id
 * @property string $name
 * @property string $adress
 * @property string $picture_url
 * @property string $preview_url
 * @property integer $date_created
 */
class Photo extends \yii\db\ActiveRecord
{

    public $imageFile;
    public $album;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['album_id', 'name', 'picture_url', 'preview_url', 'date_created'], 'required'],
            [['album_id', 'date_created'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['adress'], 'string', 'max' => 200],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxSize' => 2000000],
            [['picture_url', 'preview_url'], 'string', 'max' => 100],
        ];
    }

    /**
     * Создает уменьшенную копию изображения
     * @param $path
     * @param $targetPath
     */
    public function createThumbinail($path, $targetPath){

        $img = Image::getImagine()->open($path);

        $size = $img->getSize();
        $ratio = $size->getWidth()/$size->getHeight();

        $width = 250;
        $height = round($width/$ratio);

        Image::thumbnail($path,$width,$height)->save($targetPath);
    }

    /**
     * Загрузка фото в /uploads/, создание уменьшенной копии
     * @return bool
     */
    public function upload()
    {

        if ($this->validate(['imageFile'])) {

            $this->picture_url = '/uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->preview_url = '/uploads/thumb/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;

            $this->imageFile->saveAs(Yii::$app->basePath.$this->picture_url, false);
            $this->createThumbinail(Yii::$app->basePath.$this->picture_url, Yii::$app->basePath.$this->preview_url);

            return true;

        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'album_id' => 'Album',
            'name' => 'Name',
            'adress' => 'Adress',
            'picture_url' => 'Picture Url',
            'preview_url' => 'Preview Url',
        ];
    }
}
