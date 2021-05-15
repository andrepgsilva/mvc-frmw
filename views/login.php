<?php
/** @var $model \App\Models\User */
?>

<h1>Login</h1>

<?php $form = App\Core\Form\Form::begin('', 'post') ?>
    <?php echo $form->field($model, 'email') ?>
    <?php echo $form->field($model, 'password')->passwordField() ?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?= App\Core\Form\Form::end() ?>