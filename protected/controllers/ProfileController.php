<?php
/**
 * ProfileController class file.
 *
 * @author George Agapov <george.agapov@gmail.com>
 * @link https://github.com/georgeee/yii-lily-sample
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

/**
 * ProfileController is a controller class.
 * It sprovides interface for user profile editing.
 *
 * @package application.controllers
 */

class ProfileController extends Controller {

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
                'users' => array('@'),
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
        if (isset($_POST['ajax']) && $_POST['ajax'] == 'profile-edit-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        //Here we can check, if profile data can be extracted from eauth provider attributes
        if (!isset($model->name) && isset(LilyModule::instance()->session->data->name))
            $model->name = LilyModule::instance()->session->data->name;
        if (!isset($model->sex) && isset(LilyModule::instance()->session->data->sex))
            $model->sex = LilyModule::instance()->session->data->sex;
        if (!isset($model->birthday) && isset(LilyModule::instance()->session->data->birthday))
            $model->setBirthdayByTimestamp(LilyModule::instance()->session->data->birthday);

        if (isset($_POST['Profile'])) {
            $model->attributes = $_POST['Profile'];
            if ($model->validate()) {
                if ($model->save()) {
                    Yii::app()->user->setFlash('profile', 'Profile saved.');

                    //If this page was shown because of initialization process, we should take user to the next step after model saving
                    if(LilyModule::instance()->userIniter->isStarted){
                        LilyModule::instance()->userIniter->nextStep();
                    }
                }
            }
        }
        $this->render('edit', array('model' => $model));
    }

}