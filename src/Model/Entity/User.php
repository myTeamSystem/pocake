<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;

/**
 * User Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $role
 * @property bool $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Bookmark[] $bookmarks
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    // los true en pocas palabras son los datos que seran persistentes en la base de datos (como obligatorios)
    protected $_accessible = [
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'password' => true,
        'role' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'bookmarks' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    /**
    *
    * setters y getter de password
    * Este metodo nos sirve para encriptar las contrseñas
    * se debe colocar el use Cake\Auth\DefaultPasswordHasher;
    */
    protected function _setPassword($value)
    {
        if(!empty($value)) // condicional para el monento que se edite el usuario no vuelva a encriptar el contenido del campo
        {
            $hasher = new DefaultPasswordHasher();
            return $hasher->hash($value);
        }
            else 
        {
            $id_user = $this->_properties['id']; // de esta manera se recupera el id del usuario que se esta persistieno
            $user = TableRegistry::get('Users')->recoverPassword($id_user); // para mantener el codigo ordenado creamo el metodo de las consulta de contraseña en UsersTabl
            return $user; 
        }    

    }

    /**
     * Metodo que transforma un string a uper case
     * 
     */
    // protected function toUperCase($value) {
    //     return strtoupper($value);
    // }

    protected function _getFirstName($firstName){
        return strtoupper($firstName);
    }

    protected function _settFirstName($firstName){
        return strtoupper($firstName);
    }

    protected function _getLastName($firstName){
        return strtoupper($firstName);
    }

    protected function _setLastName($firstName){
        return strtoupper($firstName);
    }

    protected function _getEmail($firstName){
        return strtoupper($firstName);
    }

    protected function _setEmail($firstName){
        return strtoupper($firstName);
    }

    // protected function _getRole($firstName){
    //     return strtoupper($firstName);
    // }

    // protected function _setRole($firstName){
    //     return strtoupper($firstName);
    // }

}
