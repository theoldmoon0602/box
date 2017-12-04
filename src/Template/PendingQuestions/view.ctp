<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PendingQuestion $pendingQuestion
 */
?>
<div class="pendingQuestions view large-9 medium-8 columns content">
    <h3><?= h($pendingQuestion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $pendingQuestion->has('user') ? $this->Html->link($pendingQuestion->user->id, ['controller' => 'Users', 'action' => 'view', $pendingQuestion->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($pendingQuestion->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($pendingQuestion->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Text') ?></h4>
        <?= $this->Text->autoParagraph(h($pendingQuestion->text)); ?>
    </div>
</div>
