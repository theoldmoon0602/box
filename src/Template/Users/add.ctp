<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('とうろく') ?></legend>
        <?php
            echo $this->Form->control('email');
            echo $this->Form->control('password');
        ?>
    </fieldset>
	<div>
		<h4>りようきやく</h4>
		<p>
			みんなに迷惑をかけないでください<br>
			攻撃する前にふるつきに許可をもらってください<br>
		</p>
	</div>
    <?= $this->Form->button(__('りようきやくに同意してとうろく')) ?>
    <?= $this->Form->end() ?>
</div>
