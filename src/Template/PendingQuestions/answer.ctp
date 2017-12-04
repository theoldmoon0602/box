<div class="pendingQuestions form large-9 medium-8 columns content">
    <?= $this->Form->create($pendingQuestion) ?>
    <fieldset>
        <legend><?= __('こたえる') ?></legend>
        <?php
            echo $this->Form->control('text', ['readonly'=>'true']);
            echo $this->Form->control('answer', ['type' => 'textarea']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('ほ')) ?>
    <?= $this->Form->end() ?>
</div>
