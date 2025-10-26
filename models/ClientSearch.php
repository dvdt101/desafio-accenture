<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Client;
use Yii;
use Exception;

/**
 * ClientSearch represents the model behind the search form of `app\models\Client`.
 */
class ClientSearch extends Client
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['NAME', 'EMAIL', 'STATUS', 'CREATED_AT'], 'safe'],
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
        try {
            $query = Client::find();

            // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            $this->load($params, $formName);

            if (!$this->validate()) {
                // uncomment the following line if you do not want to return any records when validation fails
                // $query->where('0=1');
                return $dataProvider;
            }

            // grid filtering conditions
            $query->andFilterWhere([
                'ID' => $this->ID,
                'CREATED_AT' => $this->CREATED_AT,
            ]);

            $query->andFilterWhere(['like', 'NAME', $this->NAME])
                ->andFilterWhere(['like', 'EMAIL', $this->EMAIL])
                ->andFilterWhere(['like', 'STATUS', $this->STATUS]);

            return $dataProvider;
        } catch (Exception $e) {
            Yii::error($e->getMessage(), __METHOD__);
            Yii::$app->session->setFlash('error', 'Erro ao realizar a busca de clientes.');
            return new ActiveDataProvider([
                'query' => Client::find()->where('0=1'),
            ]);
        }
    }
}
