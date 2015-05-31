<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Offer;

/**
 * OfferSearch represents the model behind the search form about `app\models\Offer`.
 */
class OfferSearch extends Offer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['offerId', 'offerPrice', 'offerLastMinutePrice', 'offerFirstMinutePrice', 'offerIsFirstMinute', 'offerIsLastMinute', 'offerIsActive', 'countries_countryId', 'seasons_seasonId'], 'integer'],
            [['offerName', 'offerStartDate', 'offerEndDate', 'offerDescription', 'offerAccommodation', 'offerBenefits', 'offerProgram', 'offerOptional', 'offerNote', 'offerPracticalData'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Offer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'offerId' => $this->offerId,
            'offerStartDate' => $this->offerStartDate,
            'offerEndDate' => $this->offerEndDate,
            'offerPrice' => $this->offerPrice,
            'offerLastMinutePrice' => $this->offerLastMinutePrice,
            'offerFirstMinutePrice' => $this->offerFirstMinutePrice,
            'offerIsFirstMinute' => $this->offerIsFirstMinute,
            'offerIsLastMinute' => $this->offerIsLastMinute,
            'offerIsActive' => $this->offerIsActive,
            'countries_countryId' => $this->countries_countryId,
            'seasons_seasonId' => $this->seasons_seasonId,
        ]);

        $query->andFilterWhere(['like', 'offerName', $this->offerName])
            ->andFilterWhere(['like', 'offerDescription', $this->offerDescription])
            ->andFilterWhere(['like', 'offerAccommodation', $this->offerAccommodation])
            ->andFilterWhere(['like', 'offerBenefits', $this->offerBenefits])
            ->andFilterWhere(['like', 'offerProgram', $this->offerProgram])
            ->andFilterWhere(['like', 'offerOptional', $this->offerOptional])
            ->andFilterWhere(['like', 'offerNote', $this->offerNote])
            ->andFilterWhere(['like', 'offerPracticalData', $this->offerPracticalData]);

        return $dataProvider;
    }
}
