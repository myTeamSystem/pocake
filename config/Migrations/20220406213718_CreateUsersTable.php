<?php
use Migrations\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('first_name', 'string', array('limit' => 100, 'comment' => 'nombre del usuario'))
              ->addColumn('last_name', 'string', array('limit' => 100, 'comment' => 'apellido del usuario'))
              ->addColumn('email', 'string', array('limit' => 100, 'comment' => 'correo del usuario'))
              ->addColumn('password', 'string', array('comment' => 'contrasenas del usuario'))  
              ->addColumn('role', 'enum' , array('values' => 'admin, user'))  
              ->addColumn('active', 'boolean')
              ->addColumn('created', 'datetime')   
              ->addColumn('modified', 'datetime')  
              ->create();
    }
}
