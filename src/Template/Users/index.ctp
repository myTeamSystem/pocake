<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>

<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h2>Usuarios</h2>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th><?= $this->Paginator->sort('first_name', ['Nombre (s)']) ?></th>
                        <th><?= $this->Paginator->sort('last_name', ['Apellido (s)']) ?></th>
                        <th><?= $this->Paginator->sort('email', ['Correo']) ?></th>
                        <th><?= $this->Paginator->sort('role', ['Rol']) ?></th>
                        <th><?= $this->Paginator->sort('created', ['Creado']) ?></th>
                        <th><?= $this->Paginator->sort('modified', ['Modificado']) ?></th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $this->Number->format($user->id) ?></td>
                        <td><?= h($user->first_name) ?></td>
                        <td><?= h($user->last_name) ?></td>
                        <td><?= h($user->email) ?></td>
                        <td><?= h($user->role) ?></td>
                        <td><?= h($user->created) ?></td>
                        <td><?= h($user->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $user->id], ['class' => 'btn btn-small btn-info']) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id],  ['class' => 'btn btn-small btn-primary']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id],  ['class' => 'btn btn-small btn-danger', 'confirm' => __('¿Seguro quieres eliminar el registro  # {0} {1}?', $user->id, $user->first_name)]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
                    <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
                    <?= $this->Paginator->next(__('siguiente') . ' >') ?>
                </ul>
                <p><?= $this->Paginator->counter(['format' => __('Pagina {{page}} de {{pages}}, mostradas {{current}} de {{count}} ')]) ?></p>
            </div>
        </div>
    </div>
</div>


    

