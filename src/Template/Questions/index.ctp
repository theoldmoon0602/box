<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question[]|\Cake\Collection\CollectionInterface $questions
 */
?>
<div class="questions index large-9 medium-8 columns content">
    <h3><?= __('Questions') ?></h3>
	<div class="row">
            <?php foreach ($questions as $question): ?>
            <div>
				<h4 class="h4"><?= h($question->text); ?></h4>
				<p><?= h($question->answer); ?></p>
            </div>
            <?php endforeach; ?>
	</div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
    </div>
</div>
