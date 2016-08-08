Галeрея
=======
Устанавливается в корень yii вместе с дополнительными сторонними расширениями: yiisoft/yii2-imagine и udokmeci/yii2-phone-validator.

Подключение модуля:
```php
'modules' => [
        'galery' => [
            'class' => 'app\modules\galery\Galery',
        ],
    ],
```
доступен по адресу: /galery

###Структура БД###

```sql
CREATE TABLE IF NOT EXISTS `album` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date_created` int(10) NOT NULL,
  `date_updated` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `author_name` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `country` (
  `code` char(2) NOT NULL,
  `name` char(52) NOT NULL,
  `population` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(14) NOT NULL AUTO_INCREMENT,
  `album_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `adress` varchar(200) DEFAULT NULL,
  `picture_url` varchar(100) NOT NULL,
  `preview_url` varchar(100) NOT NULL,
  `date_created` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```
