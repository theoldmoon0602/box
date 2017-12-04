<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PendingQuestion $pendingQuestion
 */
?>
<div class="pendingQuestions view large-9 medium-8 columns content">
    <h3><?= h($pendingQuestion->id) ?></h3>
    <div class="row">
        <h4><?= __('しつもんした内容') ?></h4>
        <?= $this->Text->autoParagraph(h($pendingQuestion->text)); ?>
    </div>
</div>
