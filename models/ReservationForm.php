<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ReservationForm is the model behind the reservation form.
 */
class ReservationForm extends Model
{
    public $userAttends=true;

    public function rules()
    {
        return [['userAttends', 'uaValidate']];
    }

    public function attributeLabels()
    {
    	return [
    			'userAttends' => 'Jestem uczestnikiem',
    	];
    }
    
    public function uaValidate(){
    	if($this->userAttends !== true) $this->userAttends = false;
    }
}
