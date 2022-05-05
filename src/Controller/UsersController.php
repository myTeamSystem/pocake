<?php
namespace App\Controller;

use App\Controller\AppController;
use Symfony\Component\Debug\Debug;

/**
 * Users Controller
 *
 */
class UsersController extends AppController
{

    /**
     * 
     * METODO QUE INDICA LOS PERMISOS DE LAS ACCIONES SOBRE EL CONTROLADOR PARA EL USUARIO
     * AQUI ES DONDE LE DAMOS PERMISO AL USUARIO DE LAS ACCIONES QUE PUEDE REALIZAR
     */
    public function isAuthorized($user)
    {
        if(isset($user['role']) and $user['role'] === 'user')
        {
            if(in_array($this->request->action, ['home', 'view', 'logout']))
            {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function index()
    {
        //$this->Users // aqui cake crea una instancia de la tabla y consultamos con los metodos de ORM find('all')
        // $users = $this->Users->find('all');
        $users = $this->Paginate($this->Users); // para paginar la instancia de la tabla 
        // $this->set lleva los datos al la vista - (objeto que estara disponible en la vista, el objeto)
        $this->set('users', $users);
    }

    public function view($id)
    {
        $user = $this->Users->get($id);
        $this->set('user', $user);
    }

    public function add()
    {
        // para agregar usuarios llamamos la tabla Users y decimos que nueva entidad
        $userEntity = $this->Users->newEntity();

        if($this->request->is('post'))
        {
             //debug($this->request->data); // para visualizar los datos que llegan desde el form
            $user = $this->Users->patchEntity($userEntity, $this->request->data); // patchEntity sirve para validar los datos
            $user->role = 'user';
            $user->active = 1;
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

       $this->set(compact('user')); // con esto enviamos la entidad de user
    }

    public function home()
    {
        $this->render(); // redirigue a su propia vista (home)
    }

    public function logout() 
    {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * 
     * METODO DE AUTENTIFICACION
     */
    public function login()
    {
        if($this->request->is('post'))
        {
            $user = $this->Auth->identify(); //aqui verificamos los datos que a ingresado el usuario oara identificase
            if($user) // verifica si existen los datos del usuario u a la vez si son correctos
            {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            } 
                else 
            {
                $this->Flash->error(__('Los datos son invalidos, porfavor intente nueva mente', ['key' => 'auth'])); // para que el msj solo se muestre cuando este en la parte de autentificacion
            }    
        }

        if ($this->Auth->user()) // con esta condicion sabamos si el usuaio esta autenticado
        {
            return $this->redirect(['controller' => 'Users', 'action' => 'home']);
        }
    }

    /**
     * 
     * METODO PARA EDITAR A LOS USUAIORS
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id); // buscamos registro por id
        if($this->request->is(['patch', 'post', 'put']))
        {
            $user_edit = $this->Users->patchEntity($user, $this->request->data);
            if($this->Users->save($user_edit))
            {
                $this->Flash->success(__('El usuario {0} ah sido modificado', $user_edit->first_name));
                return $this->redirect(['action' => 'index']);
            }
                else 
            {
                $this->Flash->error(__('El usuario {0} no se ah podido modificado, intente de nuevo', $user->first_name));
            }    
        }

        $this->set(compact('user'));  // enviamos el objeto a la vista
    }

    public function delete($id = null) 
    {
        // debug('Eliminando' . $id);
        // exit();
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);

        if($this->Users->delete($user))
        {
            $this->Flash->success(__('El usuario {0} se elimino correctamente', $user->id . ' ' . $user->first_name ));
        }
        else 
        {
            $this->Flash->error(__('El usuario {0} no pudo ser elimino, intente de nuevo', $user->id . ' ' . $user->first_name ));
        }

        return $this->redirect(['action' => 'index']);

    }

}
