<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('ろぐいん') ?></legend>
        <?php
            echo $this->Form->control('email');
            echo $this->Form->control('password');
        ?>
    </fieldset>
    <?= $this->Form->button(__('ほい')) ?>
    <?= $this->Form->end() ?>
<?= $this->Html->link('ぱすわーどをわすれたよ', ['controller'=>'PasswordResets', 'action' => 'add']) ?>
</div>
