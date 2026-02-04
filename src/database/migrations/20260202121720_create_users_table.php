<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUsersTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $this->table('users', ['id' => false, 'primary_key' => 'id'])
            ->addColumn('id', 'string', ['null' => false])
            ->addColumn('first_name', 'string', ['null' => false])
            ->addColumn('last_name', 'string', ['null' => false])
            ->addColumn('email', 'string', ['null' => false])
            ->addIndex(['email'], ['unique' => true])
            ->addColumn('address_id', 'string', ['null' => false])
            ->addForeignKey('address_id', 'addresses', 'id', [
                'update' => 'CASCADE',
                'delete' => 'CASCADE'
            ])
            ->addColumn('role_id', 'integer', ['signed' => false, 'null' => false])
            ->addForeignKey('role_id', 'roles', 'id', [
                'update' => 'CASCADE',
                'delete' => 'CASCADE'
            ])
            ->addTimestamps()
            ->create();
    }
}
