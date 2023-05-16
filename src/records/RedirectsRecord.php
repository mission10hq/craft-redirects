<?php

namespace mission10\redirects\records;

use craft\db\ActiveRecord;

class RedirectsRecord extends ActiveRecord{

    public static $tableName = '{{%seo_redirects}}';

    public static function tableName(): string {
        return self::$tableName;
    }
}