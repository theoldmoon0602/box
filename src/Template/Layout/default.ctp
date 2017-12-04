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
				<?php if($auth->user('is_admin')): ?>
				<li><?= $this->Html->link(__('しつもん一覧'), ['controller' => 'PendingQuestions', 'action' => 'index']) ?> </li>
				<?php endif; ?>
				<li><?= $this->Html->link(__('しつもんする'), ['controller' => 'PendingQuestions', 'action' => 'add']) ?> </li>
				<li><?= $this->Html->link(__('ろぐあうと'), ['controller' => 'Users', 'action' => 'logout']) ?> </li>
				<li><?= $this->Form->postLink(__('やめる'), ['controller' => 'Users', 'action' => 'delete', $auth->user('id')], ['confirm' => __('ゆーざ情報を消してやめますか')]) ?> </li>
				<?php else: ?>
				<li><?= $this->Html->link(__('ろぐいん'), ['controller' => 'Users', 'action' => 'login']) ?> </li>
				<li><?= $this->Html->link(__('れじすた'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
				<?php endif; ?>
			</ul>
		</nav>
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
