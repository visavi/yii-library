<?php
/* @var $this BookController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Books',
);

$this->menu=array(
	array('label'=>'Create Book', 'url'=>array('create')),
	array('label'=>'Manage Book', 'url'=>array('admin')),
);
?>

<h1>Books</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<script>
    $(function() {
        $('.subscribe-form').on('submit', function(e) {
            e.preventDefault();
            var $form = $(this);
            var $resultDiv = $form.next('.subscribe-result');

            $.ajax({
                url: '<?= Yii::app()->createUrl("subscribe/index") ?>',
                type: 'POST',
                data: $form.serialize(),
                dataType: 'json',
                success: function(data) {
                    $resultDiv.show();
                    if (data.success) {
                        $resultDiv.html('<span style="color:green;">' + data.message + '</span>');
                        $form.hide();
                    } else {
                        var errors = '';
                        $.each(data.errors, function(field, messages) {
                            errors += messages.join(', ') + '<br>';
                        });
                        $resultDiv.html('<span style="color:red;">' + errors + '</span>');
                    }
                },
                error: function() {
                    $resultDiv.show().html('<span style="color:red;">Не удалось подписаться!</span>');
                }
            });
        });
    });
</script>
