<?php

use Phinx\Seed\AbstractSeed;

class RoleSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $data = [
          [
              'name' => 'Администратор',
              'code' => '001'
          ],
          [
              'name' => 'Пользователь',
              'code' => '002'
          ]
        ];
        $this->table('roles')->insert($data)->save();
    }
}
