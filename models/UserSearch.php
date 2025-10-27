<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;
use Yii;
use Exception;

/**
 * UserSearch represents the model behind the search form of `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['USERNAME', 'NAME', 'EMAIL', 'PASSWORD_HASH', 'PROFILE', 'STATUS', 'AUTH_KEY', 'ACCESS_TOKEN', 'CREATED_AT'], 'safe'],
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
            $query = User::find();

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

            $query->andFilterWhere(['like', 'USERNAME', $this->USERNAME ? mb_strtolower($this->USERNAME) : null])
                ->andFilterWhere(['like', 'NAME', $this->NAME])
                ->andFilterWhere(['like', 'EMAIL', $this->EMAIL])
                ->andFilterWhere(['like', 'PASSWORD_HASH', $this->PASSWORD_HASH])
                ->andFilterWhere(['like', 'PROFILE', $this->PROFILE])
                ->andFilterWhere(['like', 'STATUS', $this->STATUS])
                ->andFilterWhere(['like', 'AUTH_KEY', $this->AUTH_KEY])
                ->andFilterWhere(['like', 'ACCESS_TOKEN', $this->ACCESS_TOKEN]);

            return $dataProvider;
        } catch (Exception $e) {
            Yii::error($e->getMessage(), __METHOD__);
            Yii::$app->session->setFlash('error', 'Erro ao realizar a busca de usuários.');
            return new ActiveDataProvider([
                'query' => User::find()->where('0=1'),
            ]);
        }
    }
}
