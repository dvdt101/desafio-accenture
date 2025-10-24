<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * OrderSearch represents the model behind the search form of `app\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'CLIENT_ID'], 'integer'],
            [['TOTAL_VALUE'], 'number'],
            [['STATUS', 'ORDER_DATE'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
public function search($params, $formName = null)
{
    $query = Order::find();

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
    ]);

    $this->load($params, $formName);

    if (!$this->validate()) {
        return $dataProvider;
    }

    if (!empty($this->ORDER_DATE)) {

        $query->andWhere(
            "ORDER_DATE BETWEEN TO_DATE(:startDate, 'YYYY-MM-DD HH24:MI:SS')
                           AND TO_DATE(:endDate,   'YYYY-MM-DD HH24:MI:SS')",
            [
                ':startDate' => $this->ORDER_DATE . ' 00:00:00',
                ':endDate'   => $this->ORDER_DATE . ' 23:59:59',
            ]
        );
    }

    $query->andFilterWhere([
        'ID'         => $this->ID,
        'CLIENT_ID'  => $this->CLIENT_ID,
        'TOTAL_VALUE'=> $this->TOTAL_VALUE,
    ]);

    $query->andFilterWhere(['like', 'STATUS', $this->STATUS]);

    return $dataProvider;
}

}
