<h1>User tags</h1>
<div class="hint" style="margin-bottom: 10px;">
    Here you can attach tags to user - just type tags you want in comma separated format.
    </div>
<h2>Differencies beetween tags (behaviour on merge operation)</h2>
    <div class="hint">
    <br> First tag - tags that will be moved to successor user.
    <br> Second tag - tags that will be just deleted.
    <br> Third tag - tags that will be moved to successor user, but in a bit changed way.
</div>
        <h2>Form</h2>
<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'tag-edit-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),)
    );
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'tag1'); ?>
        <?php echo $form->textField($model, 'tag1'); ?>
        <?php echo $form->error($model, 'tag1'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'tag2'); ?>
        <?php echo $form->textField($model, 'tag2'); ?>
        <?php echo $form->error($model, 'tag2'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'tag3'); ?>
        <?php echo $form->textField($model, 'tag3'); ?>
        <?php echo $form->error($model, 'tag3'); ?>
    </div>
    <div class="row buttons">
    <?php echo CHtml::submitButton('Save'); ?>
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->


