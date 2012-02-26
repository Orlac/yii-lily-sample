<?php
/**
 * TagController class file.
 *
 * @author George Agapov <george.agapov@gmail.com>
 * @link https://github.com/georgeee/yii-lily-sample
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

/**
 * TagController is a controller class.
 * It sprovides interface for user tags editing.
 *
 * @package application.controllers
 */

class TagController extends Controller {

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
        $model = new TagForm;

        if (isset($_POST['ajax']) && $_POST['ajax'] == 'tag-edit-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['TagForm'])) {
            $model->attributes = $_POST['TagForm'];
            if ($model->validate()) {
                $model->saveToUser($uid);
                Yii::app()->user->setFlash('tag.save.success', 'Tags were successfully saved');
            }
        }else{
            $model->tag1 = implode(', ',Tag1::model()->getTagsByUser($uid));
            $model->tag2 = implode(', ',Tag2::model()->getTagsByUser($uid));
            $model->tag3 = implode(', ',Tag3::model()->getTagsByUser($uid));
        }

        $this->render('edit', array('model' => $model));
    }

}