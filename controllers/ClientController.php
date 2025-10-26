<?php

namespace app\controllers;

use app\models\Client;
use app\models\ClientSearch;
use Error;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii;
use Exception;
use function PHPUnit\Framework\throwException;
/**
 * ClientController implements the CRUD actions for Client model.
 */
class ClientController extends Controller
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
     * Lists all Client models.
     *
     * @return string
     */
    public function actionIndex()
    {
        try {
            $searchModel = new ClientSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);
        } catch (Exception $e) {
            Yii::error($e->getMessage(), __METHOD__);
            Yii::$app->session->setFlash('error', 'Erro ao carregar clientes.');
        }

        return $this->render('index', [
            'searchModel' => $searchModel ?? null,
            'dataProvider' => $dataProvider ?? null,
        ]);
    }

    /**
     * Displays a single Client model.
     * @param int $ID ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID)
    {
        try {
            $model = $this->findModel($ID);
            $ordersDataProvider = new ActiveDataProvider([
                'query' => $model->getOrders()->orderBy(['ORDER_DATE' => SORT_DESC]),
                'pagination' => ['pageSize' => 10],
            ]);
        } catch (Exception $e) {
            Yii::error($e->getMessage(), __METHOD__);
            Yii::$app->session->setFlash('error', 'Erro inesperado ao carregar. Tente novamente mais tarde.');
        }

        return $this->render('view', [
            'model' => $model ?? null,
            'ordersDataProvider' => $ordersDataProvider ?? null,
        ]);
    }

    /**
     * Creates a new Client model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Client();
        try {
            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    Yii::$app->session->setFlash('success', 'Cliente cadastrado com sucesso.');
                    return $this->redirect(['view', 'ID' => $model->ID]);
                } else {
                    Yii::$app->session->setFlash('warning', 'Não foi possível salvar. Verifique os campos destacados.');
                }
            } else {
                $model->loadDefaultValues();
            }
        } catch (Exception $e) {
            Yii::error($e->getMessage(), __METHOD__);
            Yii::$app->session->setFlash('error', 'Erro inesperado ao salvar o cliente. Tente novamente mais tarde.');
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Client model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ID ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID)
    {
        try {
            $model = $this->findModel($ID);
            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'Cliente atualizado com sucesso.');
                return $this->redirect(['view', 'ID' => $model->ID]);
            }
        } catch (Exception $e) {
            Yii::error($e->getMessage(), __METHOD__);
            Yii::$app->session->setFlash('error', 'Erro ao atualizar o cliente.');
        }

        return $this->render('update', [
            'model' => $model ?? null,
        ]);
    }

    /**
     * Deletes an existing Client model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ID ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ID)
    {
        try {
            $this->findModel($ID)->delete();
            Yii::$app->session->setFlash('success', 'Cliente removido com sucesso.');
        } catch (Exception $e) {
            Yii::error($e->getMessage(), __METHOD__);
            Yii::$app->session->setFlash('error', 'Erro ao remover o cliente.');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Client model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ID ID
     * @return Client the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID)
    {
        try {
            if (($model = Client::findOne(['ID' => $ID])) !== null) {
                return $model;
            }
        } catch (Exception $e) {
            Yii::error($e->getMessage(), __METHOD__);
        }

        throw new NotFoundHttpException('Página solicitada não existe.');
    }
}
