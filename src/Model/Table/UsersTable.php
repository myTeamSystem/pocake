<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\BookmarksTable&\Cake\ORM\Association\HasMany $Bookmarks
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Bookmarks', [
            'foreignKey' => 'user_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
                ->integer('id')
                ->allowEmptyString('id', null, 'create');
                // ->add('id', 'valid-numeric', ['rule', 'numeric'])
                // ->allowEmptyString('id', null, 'create');

        $validator
                ->requirePresence('first_name', 'create')
                ->notEmptyString('first_name', __('El nombre (s) es requerido.'));
        
        $validator
                ->requirePresence('last_name', 'create')
                ->notEmptyString('last_name', __('El Apellido (s) es requerido.'));

        $validator
                ->add('email', 'valid-email', ['rule' => 'email', 'message' => __('La sintaxis no luce como un correo valido')])
                ->requirePresence('email', 'create')
                ->notEmptyString('email', __('El Correo es requerido.'));

        $validator
                ->requirePresence('password', 'create')
                ->notEmptyString('password', __('La Contraseña es requerido.'), 'create');

        
         return $validator;       

        //CODIGO CREADO POR BAKE
        // $validator
        //     ->integer('id')
        //     ->allowEmptyString('id', null, 'create');

        // $validator
        //     ->scalar('first_name')
        //     ->maxLength('first_name', 100)
        //     ->requirePresence('first_name', 'create')
        //     ->notEmptyString('first_name');

        // $validator
        //     ->scalar('last_name')
        //     ->maxLength('last_name', 100)
        //     ->requirePresence('last_name', 'create')
        //     ->notEmptyString('last_name');

        // $validator
        //     ->email('email')
        //     ->requirePresence('email', 'create')
        //     ->notEmptyString('email');

        // $validator
        //     ->scalar('password')
        //     ->maxLength('password', 255)
        //     ->requirePresence('password', 'create')
        //     ->notEmptyString('password');

        // $validator
        //     ->scalar('role')
        //     ->requirePresence('role', 'create')
        //     ->notEmptyString('role');

        // $validator
        //     ->boolean('active')
        //     ->requirePresence('active', 'create')
        //     ->notEmptyString('active');

        // return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email'], __('Este correo ya esta registrado, ingrese uno diferente')));

        return $rules;
    }

    /**4
     * 
     * FUNCION QUE PERMITE SOLO AUTEBNTICAR A LOS USUARIOS ACTIVOS
     */
    public function findAuth(\Cake\ORM\Query $query, array $options)
    {
        $query
            ->select(['id', 'first_name', 'last_name', 'email', 'role', 'active', 'password'])
            ->where(['Users.active' => 1]);
        
        return $query;
    }


    /**
     * 
     * METODO PARA RECUPERAR LA CONTRASEÑA DE UN USUARIO
     */
    public function recoverPassword($id)
    {
        $user = $this->get($id);
        return $user->password;
    }

    /**
     * 
     * 
     * Life Cycle Callback en donde se pregunta su es usuario admoinantes de eliminar lo
     */

     public function beforeDelete($event, $entity, $options)
     {
        // exit('antes de eliminar siiuu');
        if($entity->role == 'admin')
        {
            return false;
        }
        else 
        {
            return true;
        }
     }
}
