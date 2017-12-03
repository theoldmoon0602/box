<div class="passwordResets form large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Password reset') ?></legend>
        <?php
            echo $this->Form->control('newPassword', ['type'=>'password']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Send Password Reset mail')) ?>
    <?= $this->Form->end() ?>
</div>
