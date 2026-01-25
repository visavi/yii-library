<?php
/* @var $this BookController */
/* @var $model Book */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'book-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'year'); ?>
		<?php echo $form->textField($model,'year'); ?>
		<?php echo $form->error($model,'year'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isbn'); ?>
		<?php echo $form->textField($model,'isbn',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'isbn'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model, 'cover_image'); ?>
        <?php if ($model->cover_image): ?>
            <div>
                <img src="/images/<?php echo $model->cover_image; ?>"
                     style="max-width:200px; margin-bottom:10px;">
            </div>
        <?php endif; ?>
        <?php echo $form->fileField($model, 'cover_image_file'); ?>
        <?php echo $form->error($model, 'cover_image_file'); ?>
        <div>Оставьте пустым, чтобы не менять обложку</div>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_at'); ?>
		<?php echo $form->textField($model,'created_at'); ?>
		<?php echo $form->error($model,'created_at'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model, 'authors'); ?>
        <?php
        $allAuthors = CHtml::listData(Author::model()->findAll(), 'id', 'full_name');
        echo $form->listBox($model, 'author_ids', $allAuthors, array(
                'multiple' => 'multiple',
                'size' => min(10, count($allAuthors)),
                'style' => 'width:100%;',
        ));
        ?>
        <?php echo $form->error($model, 'author_ids'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
