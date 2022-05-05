<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bookmark $bookmark
 */
?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Bookmarks'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bookmarks form large-9 medium-8 columns content">
    <?= $this->Form->create($bookmark) ?>
    <fieldset>
        <legend><?= __('Add Bookmark') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('decription');
            echo $this->Form->control('url');
            echo $this->Form->control('user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div> -->

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="page-header">
            <h2>Crear Favorito</h2>
        </div>
        <?= $this->Form->create($bookmark, ['novalidate']) ?>
        <fieldset>
            <?php 
                echo $this->Form->control('title', ['label' => 'Titulo del enlace']);
                echo $this->Form->control('url', ['type' => 'text', 'label' => 'URL del enlace']);
                echo $this->Form->control('decription', ['type' => 'textarea', 'label' => 'Descripcion del enlace']);
                // echo $this->Form->control('password', ['label' => 'Contraseña del usuario']);
                // echo $this->Form->control('role', ['label' => 'Rol', 'options' => ['admin' => 'Administrador', 'user' => 'Usuario']]);
                // echo $this->Form->control('active', ['label' => 'Activo']);
            ?>
        </fieldset>
        <?= $this->Form->button('Agregar') ?>
        <?= $this->Form->end() ?>        
    </div>
</div>
