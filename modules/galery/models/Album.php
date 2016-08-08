<?php

namespace app\modules\galery\models;

use Yii;

/**
 * This is the model class for table "album".
 *
 * @property integer $id
 * @property integer $date_created
 * @property integer $date_updated
 * @property string $name
 * @property string $description
 * @property string $author_name
 * @property string $email
 * @property string $phone
 */
class Album extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'album';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_created', 'date_updated', 'name', 'description', 'author_name'], 'required'],
            [['date_created', 'date_updated'], 'integer'],
            [['name', 'author_name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 200],
            [['email', 'phone'], 'string', 'max' => 100],
            [['email'], 'email'],
            [['phone'], 'udokmeci\yii2PhoneValidator\PhoneValidator','country'=>'RU'],
        ];
    }

    /**
     * Отношение к Photo
     * @return $this
     */
    public function getPhoto()
    {
        return $this->hasMany(Photo::className(), ['album_id' => 'id'])->orderBy('id DESC');
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'name' => 'Name',
            'description' => 'Description',
            'author_name' => 'Author Name',
            'email' => 'Email',
            'phone' => 'Phone',
        ];
    }
}
