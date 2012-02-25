<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-edit-form',
        'enableClientValidation' => true,
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),)
    );
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name'); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'sex'); ?>
        <?php 
        $options = array();
        $_options = array();
        if(!isset($model->sex)){
            $options['-'] = '-';
            $_options['-'] = array('selected'=> true);
        }
//        else $_options[$model->sex] = array('selected'=> true);
        foreach($model->sexOptions as $k => $v) $options[$k] = $v;
        echo $form->dropDownList($model, 'sex', $options, array('options'=>$_options)); ?>
        <?php echo $form->error($model, 'sex'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'birthday'); ?>
        <?php
        $attr = 'birthday';
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => CHtml::resolveName($model, $attr),
            'value' => $model->birthday,
            'language' => Yii::app()->locale->id,
        ));
        ?>
        <?php echo $form->error($model, 'birthday'); ?>
    </div>
    <div class="row buttons">
    <?php echo CHtml::submitButton('Save'); ?>
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->


