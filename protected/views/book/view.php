<?php
/* @var $this BookController */
/* @var $model Book */

$this->breadcrumbs=array(
	'Books'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Book', 'url'=>array('index')),
	array('label'=>'Create Book', 'url'=>array('create')),
	array('label'=>'Update Book', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Book', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Book', 'url'=>array('admin')),
);
?>

<h1>View Book #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'attributes' => array(
                'id',
                'title',
                'year',
                'description',
                'isbn',

                array(
                        'label' => 'Обложка',
                        'type' => 'raw',
                        'value' => $model->cover_image
                                ? CHtml::image('/images/' . $model->cover_image, 'Обложка', ['style' => 'max-width:200px;'])
                                : '<em>Нет изображения</em>',
                ),

                array(
                        'label' => 'Авторы',
                        'type' => 'raw',
                        'value' => function($data) {
                            if (empty($data->authors)) {
                                return '<em>Нет авторов</em>';
                            }
                            $names = [];
                            foreach ($data->authors as $author) {
                                $names[] = CHtml::encode($author->full_name);
                            }
                            return implode(', ', $names);
                        },
                ),

                'created_at:datetime',
        ),
)); ?>
