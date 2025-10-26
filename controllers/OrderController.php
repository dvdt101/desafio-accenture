<?php

namespace app\controllers;

use app\models\Order;
use app\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Client;
use Yii;
use Exception;

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
        try {
            $searchModel = new OrderSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);

            $clients = Client::find()
                ->select(['NAME', 'ID'])
                ->orderBy(['NAME' => SORT_ASC])
                ->indexBy('ID')
                ->column();
        } catch (Exception $e) {
            Yii::error($e->getMessage(), __METHOD__);
            Yii::$app->session->setFlash('error', 'Erro ao carregar pedidos.');
        }

        return $this->render('index', [
            'searchModel' => $searchModel ?? null,
            'dataProvider' => $dataProvider ?? null,
            'clients' => $clients ?? [],
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
        try {
            $model = $this->findModel($ID);
        } catch (Exception $e) {
            Yii::error($e->getMessage(), __METHOD__);
            Yii::$app->session->setFlash('error', 'Erro ao carregar o pedido.');
        }

        return $this->render('view', [
            'model' => $model ?? null,
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

        try {
            $clients = Client::find()
                ->select(['NAME', 'ID'])
                ->orderBy(['NAME' => SORT_ASC])
                ->indexBy('ID')
                ->where(['STATUS' => 'ATIVO'])
                ->column();

            if (!$clients) {
                throw new Exception('Nenhum cliente cadastrado ou ativo, cadastre um cliente ou ative para fazer um pedido.', 404);
            }

            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    Yii::$app->session->setFlash('success', 'Pedido criado com sucesso.');
                    return $this->redirect(['view', 'ID' => $model->ID]);
                } else {
                    Yii::$app->session->setFlash('warning', 'Não foi possível salvar o pedido. Verifique os campos.');
                }
            }
        } catch (Exception $e) {
            Yii::error($e->getMessage(), __METHOD__);

            if ($e->getCode() == 404) {
                $message = $e->getMessage();
                Yii::$app->session->setFlash('error', $message);
                return $this->redirect(['index']);
            } else {
                $message = 'Erro inesperado ao salvar o pedido.';
                Yii::$app->session->setFlash('error', $message);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'clients' => $clients ?? [],
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
        try {
            $model = $this->findModel($ID);
            $clients = Client::find()
                ->select(['NAME', 'ID'])
                ->orderBy(['NAME' => SORT_ASC])
                ->indexBy('ID')
                ->where(['STATUS' => 'ATIVO'])
                ->column();

            if (!$clients) {
                throw new Exception('Nenhum cliente cadastrado ou ativo, cadastre ou ative um cliente para fazer um pedido.', 404);
            }

            if ($model->TOTAL_VALUE !== null && $model->TOTAL_VALUE !== '') {
                $model->TOTAL_VALUE = number_format((float) $model->TOTAL_VALUE, 2, ',', '.');
            }

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'Pedido atualizado com sucesso.');
                return $this->redirect(['view', 'ID' => $model->ID]);
            }
        } catch (Exception $e) {
            Yii::error($e->getMessage(), __METHOD__);
            if ($e->getCode() == 404) {
                $message = $e->getMessage();
                Yii::$app->session->setFlash('error', $message);
                return $this->redirect(['index']);
            } else {
                $message = 'Erro ao atualizar o pedido.';
                Yii::$app->session->setFlash('error', $message);
            }
        }

        return $this->render('update', [
            'model' => $model ?? null,
            'clients' => $clients ?? [],
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
        try {
            $this->findModel($ID)->delete();
            Yii::$app->session->setFlash('success', 'Pedido removido com sucesso.');
        } catch (Exception $e) {
            Yii::error($e->getMessage(), __METHOD__);
            Yii::$app->session->setFlash('error', 'Erro ao remover o pedido.');
        }

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
        try {
            if (($model = Order::findOne(['ID' => $ID])) !== null) {
                return $model;
            }
        } catch (Exception $e) {
            Yii::error($e->getMessage(), __METHOD__);
        }

        throw new NotFoundHttpException('Página solicitada não existe.');
    }
}
