<div class="pendingQuestions form large-9 medium-8 columns content">
    <?= $this->Form->create($pendingQuestion) ?>
    <fieldset>
        <legend><?= __('Answer to Question') ?></legend>
        <?php
            echo $this->Form->control('text', ['readonly'=>'true']);
            echo $this->Form->control('answer', ['type' => 'textarea']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
