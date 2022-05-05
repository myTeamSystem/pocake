<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bookmark[]|\Cake\Collection\CollectionInterface $bookmarks
 */
?>

<div class="col">
    <div class="col-md-12">
        <div class="page-header">
            <h2>
                Mi lista de favoritos
                <?= $this->Html->link(' <span class="glyphicon glyphicon-plus"></span> Nuevo', 
                ['controller' => 'bookmarks', 'action' => 'add'], 
                 ['class' => 'btn btn-primary pull-right', 'escape' => false]); ?>  <!--el escape en false sirve para que solo muestra en html la etiqueta span -->
            </h2>
        </div>
        <ul class="list-group">
            <?php foreach($bookmarks as $mark): ?>
            <li class="list-group-item">
                <h4 class="list-group-item-heading">
                    <div class="col-md-8">
                        <?= h($mark->title); ?>
                    </div>
                    <div class="col-md-4">
                        <?= $this->Html->link(' <span class="glyphicon glyphicon-pencil" ></span> Editar', 
                        ['controller' => 'bookmarks', 'action' => 'edit', $mark->id],
                        ['class' => 'btn btn-success pull-right', 'escape' => false]); ?>
                        
                        <?= $this->Form->postButton(' <span class="glyphicon glyphicon-remove" ></span> Eliminar', 
                        ['controller' => 'bookmarks', 'action' => 'delete', $mark->id], ['confirm' => '¿Seguro que deceas eliminar enlace favorit?',
                        'class' => 'btn btn-danger pull-right', 'escape' => false]); ?>
                    </div>
                </h4>
                <p>
                    <strong class="text info">
                        <small>
                            <?= $this->Html->link($mark->url, null, ['target', '_blank']) ?>
                        </small>
                    </strong>
                </p>
                <p class="list-group-item-text">
                <?= h($mark->decription) ?>
                </p>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Bookmark'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bookmarks index large-9 medium-8 columns content">
    <h3><?= __('Bookmarks') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookmarks as $bookmark): ?>
            <tr>
                <td><?= $this->Number->format($bookmark->id) ?></td>
                <td><?= h($bookmark->title) ?></td>
                <td><?= h($bookmark->created) ?></td>
                <td><?= h($bookmark->modified) ?></td>
                <td><?= $bookmark->has('user') ? $this->Html->link($bookmark->user->id, ['controller' => 'Users', 'action' => 'view', $bookmark->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $bookmark->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bookmark->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bookmark->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookmark->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table> -->
    <div class="paginator">
        <ul class="pagination">
            <!-- <?= $this->Paginator->first('<< ' . __('first')) ?> -->
            <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Siguiente') . ' >') ?>
            <!-- <?= $this->Paginator->last(__('last') . ' >>') ?> -->
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Pagina {{page}} de {{pages}}, mostradas {{current}} de {{count}} ')]) ?></p>
    </div>
<!-- </div> -->
