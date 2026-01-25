<?php
/* @var $this BookController */
/* @var $data Book */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('year')); ?>:</b>
	<?php echo CHtml::encode($data->year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isbn')); ?>:</b>
	<?php echo CHtml::encode($data->isbn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode(date('c', $data->created_at)); ?>
	<br />

    <?php if ($data->cover_image): ?>
        <b><?php echo CHtml::encode($data->getAttributeLabel('cover_image')); ?>:</b>
        <div>
            <img src="/images/<?= CHtml::encode($data->cover_image) ?>"
                 style="width:150px; height:auto; object-fit: cover;"
                 alt="<?= CHtml::encode($data->title) ?>">
        </div>
    <?php endif; ?>

    <b><?php echo CHtml::encode($data->getAttributeLabel('authors')); ?>:</b>
    <?php foreach ($data->authors as $author): ?>
        <div>
            <?= CHtml::encode($author->full_name) ?>

            <form class="subscribe-form" data-author-id="<?= $author->id ?>">
                <input type="hidden" name="SubscribeForm[author_id]" value="<?= $author->id ?>">
                <input type="text" name="SubscribeForm[phone]" placeholder="+7 (999) 123-45-67" required>
                <button>Подписаться</button>
            </form>
            <div class="subscribe-result" style="display:none;"></div>
        </div>
    <?php endforeach; ?>
</div>
