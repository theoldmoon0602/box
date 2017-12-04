<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PasswordReset $passwordReset
 */
?>
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
