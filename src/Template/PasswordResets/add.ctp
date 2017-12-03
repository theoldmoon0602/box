<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PasswordReset $passwordReset
 */
?>
<div class="passwordResets form large-9 medium-8 columns content">
    <?= $this->Form->create($passwordReset) ?>
    <fieldset>
        <legend><?= __('Password reset') ?></legend>
        <?php
            echo $this->Form->control('email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Send Password Reset mail')) ?>
    <?= $this->Form->end() ?>
</div>
