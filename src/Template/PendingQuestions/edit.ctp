<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PendingQuestion $pendingQuestion
 */
?>
<div class="pendingQuestions form large-9 medium-8 columns content">
    <?= $this->Form->create($pendingQuestion) ?>
    <fieldset>
        <legend><?= __('Edit Pending Question') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->control('text');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
