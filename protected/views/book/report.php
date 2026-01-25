<?php
/* @var $this BookController */
/* @var $year int */
/* @var $authors array */

$this->breadcrumbs=array(
	'Books'=>array('index'),
	'Отчет',
);
?>

<h2>ТОП-10 авторов по количеству книг в <?= $year ?> году</h2>

<form method="get">
    <label>
        Год:
        <input type="number" name="year" value="<?= CHtml::encode($year) ?>" min="1800" max="<?= date('Y') ?>">
    </label>
    <button type="submit">Показать</button>
</form>

<br>

<?php if (empty($authors)): ?>
    <p>Нет данных за <?= $year ?> год.</p>
<?php else: ?>
    <table border="1" cellpadding="8" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th>Место</th>
                <th>Автор</th>
                <th>Книг выпущено</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($authors as $i => $author): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= CHtml::encode($author['full_name']) ?></td>
                    <td><?= (int) $author['book_count'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
