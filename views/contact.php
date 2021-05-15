<?php
use \App\Core\Form\TextAreaField;

/** @var \App\Core\View $this */
/** @var \App\Models\ContactForm $model */

$this->title = 'contact';
?>

<?php $form = \App\Core\Form\Form::begin('', 'post') ?>
    <?php echo $form->field($model, 'subject'); ?>
    <?php echo $form->field($model, 'email'); ?>
    <?php echo new TextAreaField($model, 'body')?>

    <button type="submit" class="btn btn-primary">Submit</button>
<?php \App\Core\Form\Form::end() ?>