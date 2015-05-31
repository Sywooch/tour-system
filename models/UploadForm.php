<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use app\models\OfferImage;

class UploadForm extends Model
{
	/**
	 * @var UploadedFile[]
	 */
	public $imageFiles;

	public function rules()
	{
		return [
				[['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
		];
	}

	public function upload($id)
	{
		if ($this->validate()) {
			foreach ($this->imageFiles as $file) {
				$offerImage = new OfferImage();
				$name = \Yii::$app->security->generateRandomString() . '.' . $file->extension;
				$file->saveAs('uploads/' . $name);
				$offerImage->image_path = '/uploads/' . $name;
            	$offerImage->offers_offerId = $id;
            	$offerImage->save();
			}
			return true;
		} else {
			return false;
		}
	}
}