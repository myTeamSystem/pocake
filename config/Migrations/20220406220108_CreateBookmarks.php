<?php
use Migrations\AbstractMigration;

class CreateBookmarks extends AbstractMigration
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
        $table = $this->table('bookmarks');
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('decription', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('url', 'text', [  
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();

        $refTable = $table('bookmarks');
        $refTable->addColumn('user_id', 'integer', array('signed' => 'disable'))
        //se agrega llave foranea user_id con tabla users con campo id y le dice que en delete de usuario que elimine tambien sus dependeintes y en update no acciones
                 ->addForeignKey('user_id', 'user', 'id', array('delete' => 'CASCADE', 'update' => 'NO_ACTION'))
                 ->update();

    }
}
