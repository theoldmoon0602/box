<div class="passwordResets form large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
		<legend><?= __('ぱすわーどの再設定') ?></legend>
        <?php
            echo $this->Form->control('newPassword', ['type'=>'password']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('これでよし')) ?>
    <?= $this->Form->end() ?>
</div>
