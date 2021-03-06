<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question $question
 */
?>
<div class="questions view large-9 medium-8 columns content">
    <div class="row">
        <h4><?= __('しつもん') ?></h4>
        <?= $this->Text->autoParagraph(h($question->text)); ?>
    </div>
    <div class="row">
        <h4><?= __('ふるつきのこたえ') ?></h4>
        <?= $this->Text->autoParagraph(h($question->answer)); ?>
    </div>
</div>
