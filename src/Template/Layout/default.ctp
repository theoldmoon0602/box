<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
		| THEOLDMOON0602BOX
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
				<h1><?= $this->Html->link('THEOLDMOON0602BOX', ['controller'=>'Questions', 'action' => 'index']) ?></h1>
            </li>
        </ul>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
		<nav class="large-3 medium-4 columns" id="actions-sidebar">
			<ul class="side-nav">
				<?php if ($auth->user()): ?>
				<li><?= $this->Html->link(__('Post Question'), ['controller' => 'PendingQuestions', 'action' => 'add']) ?> </li>
				<li><?= $this->Html->link(__('View My Information'), ['controller' => 'Users', 'action' => 'view', $auth->user('id')]) ?> </li>
				<li><?= $this->Html->link(__('Password Reset'), ['controller' => 'Users', 'action' => 'edit', $auth->user('id')]) ?> </li>
				<li><?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?> </li>
				<li><?= $this->Form->postLink(__('Goodbye'), ['controller' => 'Users', 'action' => 'delete', $auth->user('id')], ['confirm' => __('Are you sure you want to delete {0}?', $auth->user('email'))]) ?> </li>
				<?php else: ?>
				<li><?= $this->Html->link(__('Login'), ['controller' => 'Users', 'action' => 'login']) ?> </li>
				<li><?= $this->Html->link(__('Register'), ['controller' => 'Users', 'action' => 'addd']) ?> </li>
				<?php endif; ?>
			</ul>
		</nav>
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
