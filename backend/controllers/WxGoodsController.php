<?php

namespace backend\controllers;

use Yii;
use common\models\WxGoods;
use backend\models\search\WxGoodsSearch;
use backend\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WxGoodsController implements the CRUD actions for WxGoods model.
 */
class WxGoodsController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all WxGoods models.
     * @return mixed
     */
    public function actionIndex()
    {
        /* 添加当前位置到cookie供后续跳转调用 */
        $this->setForward();//phpinfo();

        $searchModel = new WxGoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        /* 导出excel */
        if (isset($params['action']) && $params['action'] == 'export') {
            $this->export($dataProvider->query->all());
            return false;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionConfig(){
//        $res = mb_strpos('徐州','徐州市');
//        $res2 = mb_strpos('徐州市','徐州');
//        p($res);
//        p($res2,1);
//        p(Yii::$app->params,1);
        $uploader = new \common\widgets\Uploader();
        $uploader->index();
    }

    /**
     * Displays a single WxGoods model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new WxGoods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd()
    {
        $model = new WxGoods();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

//    public function actions()
//    {
//        return [
//            'upload' => [
//                'class' => 'kucha\ueditor\UEditorAction',
//                'config' => [
//                    "imageUrlPrefix"  => Yii::getAlias('@storageUrl'),//图片访问路径前缀
//                    "imagePathFormat" => '/image/{yyyy}{mm}/editor{time}{rand:6}', //上传保存路径
//                    "imageRoot" => Yii::getAlias("@storage/web"),
//                    //在线图片不加前缀,直接用返回地址
//                    'imageManagerListPath' => Yii::getAlias("@storage/web/image"),//指定要列出图片的目录
//                    'imageManagerUrlPrefix' => Yii::getAlias('@storageUrl').'/image',//图片访问路径前缀
//                ],
//            ]
//        ];
//    }

    /**
     * Updates an existing WxGoods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionEdit($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing WxGoods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WxGoods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return WxGoods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WxGoods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
