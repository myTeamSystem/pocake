<?php

use Cake\Auth\DefaultPasswordHasher;
use Migrations\AbstractMigration;

class CreateAdminSeedMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    // public function change()
    // {

    // }

    public function up()
    {
        $faker = Faker\Factory::create();
        $populator = new Faker\ORM\CakePHP\Populator($faker);
        $populator->addEntity('Users', 1, [
            'firts_name' => 'Israel',
            'last_name' => 'Rios',
            'email' => 'irios@gmail.com',
            'password' => function () {
                $hasher = new DefaultPasswordHasher();
                return $hasher-> hash('secret');
            },
            'role' => 'admin',
            'active' => 1,
            'created' => function () use ($faker) {
                return $faker->dateTimeBetween($startDate = 'now', $endDate = 'now');
            },
            'modified' => function () use ($faker) {
                return $faker->dateTimeBetween($startDate = 'now', $endDate = 'now');
            }
        ]);

        $populator->execute();
    }
}
