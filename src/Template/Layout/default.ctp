<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Mdima-Web';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('bootstrap/bootstrap.min') ?>
    <?= $this->Html->css('datepicker/datepicker.min') ?>
    <?= $this->Html->css('timepicker/jquery.timepicker.min') ?>
    <?= $this->Html->css('fonts/font-awesome.min') ?>
    <?= $this->Html->css('Features-Boxed') ?>
    <?= $this->Html->css('styles') ?>
    <?= $this->Html->script('jquery/jquery-3.3.1.min') ?>
    <?= $this->Html->script('bootstrap/bootstrap.min') ?>
    <?= $this->Html->script('bootstrap/bootstrap.bundle') ?>
    <?= $this->Html->script('datepicker/datepicker.min') ?>
    <?= $this->Html->script('timepicker/jquery.timepicker.min') ?>
    <?= $this->Html->script('main') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body> 

    <?php if($user):?>
        <?= $this->element('Navbar/default') ?>
    <?php endif; ?>
    
    <p/>
    <?= $this->Flash->render() ?>
    <div class="container">
        <?= $this->fetch('content') ?>
    </div>
    <p/>
</body>
</html>
