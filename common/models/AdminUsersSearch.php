<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AdminUsers;

/**
 * AdminUsersSearch represents the model behind the search form about `common\models\AdminUsers`.
 */
class AdminUsersSearch extends AdminUsers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'postid', 'cb', 'ub'], 'integer'],
            [['employee_code', 'username', 'password', 'name', 'email', 'phoneno', 'doc', 'dou'], 'safe'],
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
        $query = AdminUsers::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'postid' => $this->postid,
            'cb' => $this->cb,
            'ub' => $this->ub,
            'doc' => $this->doc,
            'dou' => $this->dou,
        ]);

        $query->andFilterWhere(['like', 'employee_code', $this->employee_code])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phoneno', $this->phoneno]);

        return $dataProvider;
    }
}
