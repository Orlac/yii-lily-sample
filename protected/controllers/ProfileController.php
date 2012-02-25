<?php

class ProfileController extends Controller {

    public $defaultAction='view';


    /**
     * Declares filters for the controller
     * @return array filters
     */
    public function filters() {
        return array(
            'accessControl',
        );
    }

    /**
     * Just an expression handler for accessRules()
     * @static
     * @param $user
     * @param $rule
     * @return bool
     */
    public static function allowOwnAccessRule($user, $rule){
        $uid = Yii::app()->request->getParam('uid', Yii::app()->user->id);
        return $uid == $user->id;
    }

    /**
     * Declares access rules for the controller
     * @return array access rules
     */
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('edit'),
                'expression' => array(__CLASS__, 'allowOwnAccessRule'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('edit'),
                'roles' => array('admin'),
            ),
            array('deny',
                'actions' => array('edit'),
            ),
        );
    }

    /**
     * Edit action
     */
    public function actionEdit() {
        $uid = Yii::app()->request->getParam('uid', Yii::app()->user->id);
        $model = Profile::model()->findByAttributes(array('uid' => $uid));
        if (!isset($model)) {
            $model = new Profile;
            $model->uid = $uid;
        }
        if (isset($_POST['ajax']) && $_POST['ajax'] == 'user-edit-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        foreach (array('name', 'sex', 'birthday') as $param)
            if (!isset($model->$param) && isset(LilyModule::instance()->session->data->$param))
                $model->$param = LilyModule::instance()->session->data->$param;
        if (isset($_POST['Profile'])) {
            $model->attributes = $_POST['Profile'];
            if ($model->validate()) {
                if ($model->save()) {
                    Yii::app()->user->setFlash('profile', 'Profile saved.');
                    if(LilyModule::instance()->userIniter->isStarted){
                        LilyModule::instance()->userIniter->nextStep();
                    }
                }
            }
        }
        $this->render('edit', array('model' => $model));
    }

}