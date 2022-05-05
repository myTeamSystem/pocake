<div class="well">
    <h2>Datos del usuario</h2>
    <br>
    <dl>
        <dt> Nombre (s) </dt>
        <dd>
            <?= $user->first_name ?>
            &nbsp;
        </dd>
        <dt> Apellido (s) </dt>
        <dd>
            <?= $user->last_name ?>
            &nbsp;
        </dd>
        <dt> Correo Electronico </dt>
        <dd>
            <?= $user->email ?>
            &nbsp;
        </dd>
        <dt> Rol </dt>
        <dd>
            <?= $user->role ?>
            &nbsp;
        </dd>
        <dt> Habilitado </dt>
        <dd>
            <?= $user->active ? 'SI' : 'NO' ?>
            &nbsp;
        </dd>
        <dt> Creado </dt>
        <dd>
            <?= $user->created->nice() ?>
            &nbsp;
        </dd>
        <dt> Modificado </dt>
        <dd>
            <?= $user->modified ?>
            &nbsp;
        </dd>
        <dt> Contraseña </dt>
        <dd>
            <?= $user->password ?>
            &nbsp;
        </dd>
    </dl>
</div>