<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bookmarks Controller
 *
 * @property \App\Model\Table\BookmarksTable $Bookmarks
 *
 * @method \App\Model\Entity\Bookmark[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BookmarksController extends AppController
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
            if(in_array($this->request->action, ['index', 'add']))
            {
                return true;
            }

            // verificamos que al editar y eliminar el usuario autenticado solo elimine o edite los que son propiedad de el
            if(in_array($this->request->action, ['edit', 'delete']))
            {
                $id = $this->request->params['pass'][0]; // recuperamos el id de bookmark desde los parametros con le parametro pass traemos todos y en la posicion 0 esta el id
                $bookmark = $this->Bookmarks->get($id); // traemos el bookmark con el id
                // echo $bookmark;
                // echo $user['id'];
                if ($bookmark->user_id === $user['id']) // verificamos si el usuario que estamos recuperando desde la autn es el mismo que trael el bookmark
                {
                    return true; // de ser asi le dejamos editar y eliminar
                }
            }
        }

        return parent::isAuthorized($user);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            // 'contain' => ['Users'],  // recupera todos los bookmarks de todos los usuarios
            'conditions' => ['user_id' => $this->Auth->user('id')], //  recupera solo los del usuario autenticado
            'order' => ['id' => 'desc'], // lo ordenamos por id
        ];
        $bookmarks = $this->paginate($this->Bookmarks);
        // debug($bookmarks);
        $this->set(compact('bookmarks'));
    }

    /**
     * View method
     *
     * @param string|null $id Bookmark id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bookmark = $this->Bookmarks->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set('bookmark', $bookmark);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bookmark = $this->Bookmarks->newEntity();
        if ($this->request->is('post'))
        {
            $bookmark = $this->Bookmarks->patchEntity($bookmark, $this->request->getData());
            $bookmark->user_id = $this->Auth->user('id'); // trae el id del usuario logeado y se lo asignamos al mark a guardar
            // debug($this->request->getData());
            if ($this->Bookmarks->save($bookmark))
            {
                $this->Flash->success(__('Enlace de favorito creado correctamente.'));
                
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear el enlace, Por favor intente de nuevo.'));
        }
        // $users = $this->Bookmarks->Users->find('list', ['limit' => 200]); // esto sirve como para llenar un combo box
        $this->set(compact('bookmark'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bookmark id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        // $bookmark = $this->Bookmarks->get($id, [
        //     'contain' => [],
        // ]);
        $bookmark = $this->Bookmarks->get($id); // recupetramos el enlace mediante id 
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $bookmark = $this->Bookmarks->patchEntity($bookmark, $this->request->getData());
            $bookmark->user_id = $this->Auth->user('id');
            if ($this->Bookmarks->save($bookmark)) 
            {
                $this->Flash->success(__('Se ha modificado correctamente el enlace.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se ha podido editar el enlace, Por favor intente de nuevo'));
        }
        // $users = $this->Bookmarks->Users->find('list', ['limit' => 200]); // lista de los usuarios
        $this->set(compact('bookmark'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bookmark id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bookmark = $this->Bookmarks->get($id);
        if ($this->Bookmarks->delete($bookmark)) {
            $this->Flash->success(__('El enlace se ha eliminado correctamente.'));
        } else {
            $this->Flash->error(__('No se ha podido eliminar el enlace, Por favor intente de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
