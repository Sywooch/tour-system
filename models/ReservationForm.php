<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ReservationForm is the model behind the reservation form.
 */
class ReservationForm extends Model
{
    public $attendeeQuantity=1;
    public $userAttends=TRUE;

    public function rules()
    {
        return [
            
            [['attendeeQuantity'], 'integer', 'min'=>1, 'message'=>'ilość użytkowników nie może być mniejsza niż 1'],
        ];
    }

    public function attributeLabels()
    {
    	return [
    			'attendeeQuantity' => 'ilość uczestników',
    			'userAttends' => 'Jestem uczestnikiem',
    	];
    }
}
