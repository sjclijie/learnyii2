<?php
/**
 * Created by PhpStorm.
 * User: Jaylee
 * Date: 15/6/9
 * Time: 23:52
 */

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord {

    /**
     * @return string
     */
    public static function tableName(){
        return "user";
    }

    public function rules(){
        return [
            ["username","require","message"=>"用户名不能为空."],
            ["username","filter","filter"=>"trim"],
            ["username","string","min"=>3,"max"=>12,"message"=>"用户名长度不合法."],
            ['username',"unique","targetClass"=>'\app\models\User', "message"=>"用户名已经存在."],
            ["password","require","message"=>"密码不能为空."],
            ['password',"string","min"=>6,"max"=>20,"message"=>"密码长度不合法."],
            ["password","compare","compareAttribute"=>"password2","on"=>"register","message"=>"两次密码不一致."],
            ["password","authenticate","on"=>"login"],
            ["createTime","integer"]
        ];
    }
}