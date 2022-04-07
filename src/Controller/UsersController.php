<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 */
class UsersController extends AppController
{
    public function index()
    {
        //$this->Users // aqui cake crea una instancia de la tabla y consultamos con los metodos de ORM find('all')
        // $users = $this->Users->find('all');
        $users = $this->Paginate($this->Users); // para paginar la instancia de la tabla
        // $this->set lleva los datos al la vista - (objeto que estara disponible en la vista, el objeto)
        $this->set('users', $users);
    }

    public function view($name)
    {
        echo "Estas son las vistas $name";
        exit();
    }

    public function add()
    {
        // para agregar usuarios llamamos la tabla Users y decimos que nueva entidad
        $userEntity = $this->Users->newEntity();

        if($this->request->is('post'))
        {
            // debug($this->request->data); // para visualizar los datos que llegan desde el form
            $user = $this->Users->patchEntity($userEntity, $this->request->data); // patchEntity sirve para validar los datos
            // debug($user);
            if($this->Users->save($user))
            {
                $this->Flash->success(__('El usuario se creo correctamente'));
                return $this->redirect(['controller' => 'Users', 'action' => 'index']); // podemos redireguir a la lista de users
            } 
                else 
            {
                $this->Flash->error(__('El usuario no se logro crear'));
            }

        }

        $this->set(compact('user')); // con esto enviamos la entidad
    }
}
