<?php

namespace app\controllers\back;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;
use app\models\Tareas;

class SiteController extends Controller {

    // vamos a controlar las reglas de acceso
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [''],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ////coloca un captcha fijo
            //y pregunta si el entorno esta en modo test (si no lo calcula aleatorio)
            ],
        ];
    }

    public function actionIndex() {
        // cargamos la pagina de inicio
        return $this->render('index');
    }

    public function actionLogin() {
        // en caso de no estar logueado nos colocamos en la pagina de inicio
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        // en caso de intentar realizar un logueo

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // si es correcto volvemos a la pagina anterior
          return $this->redirect(['tareas/index', 'username' => Yii::$app->user->identity->username]);
                       
        }

        // en caso de que el logueo no sea correcto no entramos
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    public function actionLogout() {
        // nos salimos de la sesion
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /* accion para enviar un correo con formulario */

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('Correo');
            //evitar envio masivo del correo con F5
            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    public function actionRegistrar() {
        $model = new User();
        $model->scenario="crear";

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
            //devuelve los datos validados por ajax
        }
        //Esta primera parte de esta accion es para validar

        /* crear el usuario */
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render ('mensaje',["model"=>$model]);
        }

        return $this->render('registro', [
                    'model' => $model,
        ]);
        //esta otra parte es para realizar operaciones con la BD
    }

    public function actionConfirm() {
        if (Yii::$app->request->get()) {

            //Obtenemos el valor de los parámetros get
            $id = \yii\helpers\Html::decode($_GET["id"]);
            $hash = \yii\helpers\Html::decode($_GET["hash"]);

            if ((int) $id) {
                //Realizamos la consulta para obtener el registro
                $model = User::find()
                        //consulta preparada para evitar codigo malicioso
                        ->where("id=:id", [":id" => $id])
                        ->andWhere("hash=:hash", [":hash" => $hash]);

                //Si el registro existe
                if ($model->count() == 1) { //comprueba si existe alguien con los datos que he pasado
                    $activar = User::findOne($id);
                    $activar->check = 1;
                    $activar->scenario = "actualizar";

                    if ($activar->save()) {
                        echo "Enhorabuena registro llevado a cabo correctamente, redireccionando ...";
                        echo "<meta http-equiv='refresh' content='8; " . \yii\helpers\Url::to(["site/login"]) . "'>";
                    } else {
                        echo "Ha ocurrido un error al realizar el registro, redireccionando ...";
                        echo "<meta http-equiv='refresh' content='8; " . \yii\helpers\Url::to(["site/login"]) . "'>";
                    }
                } else { //Si no existe redireccionamos a login
                    return $this->redirect(["site/login"]);
                }
            } else { //Si id no es un número entero redireccionamos a login
                return $this->redirect(["site/login"]);
            }
        }
    }

   /* public function actionAjax() {
        $model = new User();

        /* validar por AJAX 
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        } else {
            return $this->renderAjax('registro', [
                        'model' => $model,
            ]);
        }
    }*/

}
