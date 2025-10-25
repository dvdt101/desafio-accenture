<?php

namespace app\controllers;

use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;


/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $ID
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();

        if ($this->request->isPost) {

            if ($model->load($this->request->post())) {
                if (!empty($model->PASSWORD_PLAIN)) {
                    $model->PASSWORD_HASH = Yii::$app->security->generatePasswordHash($model->PASSWORD_PLAIN);
                }

                if ($model->save()) {
                    return $this->redirect(['view', 'ID' => $model->ID]);
                }
            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID)
    {
        $model = $this->findModel($ID);

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if (!empty($model->PASSWORD_PLAIN)) {
                    $model->PASSWORD_HASH = Yii::$app->security->generatePasswordHash($model->PASSWORD_PLAIN);
                }
                if ($model->save()) {
                    return $this->redirect(['view', 'ID' => $model->ID]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ID)
    {
        if ((int) $ID === (int) Yii::$app->user->id) {
            throw new \yii\web\ForbiddenHttpException('Você não pode deletar a si mesmo.');
        }
        $this->findModel($ID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID)
    {
        if (($model = User::findOne(['ID' => $ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $user = Yii::$app->user->identity;

        if ($user->PROFILE === 'ADMINISTRADOR') {
            return true;
        }

        $allowedActions = ['view', 'update'];
        $actionId = $action->id;

        if (!in_array($actionId, $allowedActions)) {
            throw new \yii\web\ForbiddenHttpException('Acesso negado. Você não tem permissão para essa ação.');
        }

        $id = Yii::$app->request->get('ID');

        if ($id !== null && (int) $id !== (int) $user->ID) {
            throw new \yii\web\ForbiddenHttpException('Acesso negado. Você só pode gerenciar seu próprio perfil.');
        }

        return true;
    }
}
