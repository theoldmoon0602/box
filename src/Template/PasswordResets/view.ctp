<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PasswordReset $passwordReset
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Password Reset'), ['action' => 'edit', $passwordReset->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Password Reset'), ['action' => 'delete', $passwordReset->id], ['confirm' => __('Are you sure you want to delete # {0}?', $passwordReset->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Password Resets'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Password Reset'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="passwordResets view large-9 medium-8 columns content">
    <h3><?= h($passwordReset->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $passwordReset->has('user') ? $this->Html->link($passwordReset->user->id, ['controller' => 'Users', 'action' => 'view', $passwordReset->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Token') ?></th>
            <td><?= h($passwordReset->token) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($passwordReset->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($passwordReset->created) ?></td>
        </tr>
    </table>
</div>
