<?php

namespace app\controllers;

use app\models\Order;
use app\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Client;


/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Order models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $clients = Client::find()
            ->select(['NAME', 'ID'])
            ->orderBy(['NAME' => SORT_ASC])
            ->indexBy('ID')
            ->column();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'clients'=> $clients
        ]);
    }

    /**
     * Displays a single Order model.
     * @param int $ID ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Order();
        $clients = Client::find()
            ->select(['NAME', 'ID'])
            ->orderBy(['NAME' => SORT_ASC])
            ->indexBy('ID')
            ->column();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                \Yii::info($this->request->post(), 'debug');
                return $this->redirect(['view', 'ID' => $model->ID]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'clients' => $clients,
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ID ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID)
    {
        $model = $this->findModel($ID);
        $clients = Client::find()
            ->select(['NAME', 'ID'])
            ->orderBy(['NAME' => SORT_ASC])
            ->indexBy('ID')
            ->column();

        if ($model->TOTAL_VALUE !== null && $model->TOTAL_VALUE !== '') {
            $model->TOTAL_VALUE = number_format((float) $model->TOTAL_VALUE, 2, ',', '.');
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID' => $model->ID]);
        }

        return $this->render('update', [
            'model' => $model,
            'clients' => $clients,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ID ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ID)
    {
        $this->findModel($ID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ID ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID)
    {
        if (($model = Order::findOne(['ID' => $ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
