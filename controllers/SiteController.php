<?php

namespace app\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\validators\FileValidator;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use app\models\ImageForm;
use app\models\Image;
use app\models\UrlForm;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\controllers
 */
class SiteController extends Controller
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'search' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Index page (form)
     * @param null $type
     * @return string|\yii\web\Response
     * @throws HttpException
     */
    public function actionIndex($type = null)
    {
        if ($type) {
            $hash = null;
            switch ($type) {
                case 'file':
                    $model = new ImageForm();
                    if (Yii::$app->request->isPost) {
                        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                        if ($model->validate()) {
                            $hash = $model->getPHash();
                        }
                    }
                    break;
                case 'url':
                    $model = new UrlForm();
                    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                        $hash = $model->getPHash();
                    }
                    break;
                default:
                    throw new HttpException(404, 'Bad request');
            }
            return $this->redirect(['site/results', 'hash' => $hash]);
        }

        return $this->render('index', [
            'imageForm' => new ImageForm(),
            'urlForm' => new UrlForm(),
        ]);
    }

    /**
     * Results page
     * @param $hash
     * @return string
     */
    public function actionResults($hash)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Image::findSimilar($hash, 12),
        ]);
        return $this->render('results', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Catalog
     * @return string
     */
    public function actionCatalog()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Image::find(),
        ]);
        return $this->render('catalog', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
