<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="page-header">
            <h2>Crear Usuario</h2>
        </div>
        <?= $this->Form->create($user, ['novalidate']) ?>
        <fieldset>
            <?php 
                echo $this->Form->control('first_name', ['label' => 'Nombre (s)']);
                echo $this->Form->control('last_name', ['label' => 'Apellido (s)']);
                echo $this->Form->control('email', ['label' => 'Correo electronico']);
                echo $this->Form->control('password', ['label' => 'Contraseña del usuario']);
                // echo $this->Form->control('role', ['label' => 'Rol', 'options' => ['admin' => 'Administrador', 'user' => 'Usuario']]);
                // echo $this->Form->control('active', ['label' => 'Activo']);
            ?>
        </fieldset>
        <?= $this->Form->button('Agregar usuario') ?>
        <?= $this->Form->end() ?>        
    </div>
</div>

