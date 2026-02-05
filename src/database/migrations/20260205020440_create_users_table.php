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
        $this->table('users', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'string', [
                'limit' => 36,
                'null' => false
            ])
            ->addColumn('auth_id', 'string', [
                'limit' => 36,
                'null' => false
            ])
            ->addColumn('first_name', 'string', [
                'null' => false
            ])
            ->addColumn('last_name', 'string', [
                'null' => false
            ])
            ->addColumn('email', 'string', [
                'null' => false
            ])
            ->addColumn('password', 'string', [
                'limit' => 100,
                'null' => false
            ])
            ->addColumn('role_id', 'integer', [
                'signed' => false,
                'null' => false
            ])
            ->addForeignKey('role_id', 'roles', 'id', [
                'update' => 'CASCADE',
                'delete' => 'CASCADE'
            ])
            ->addIndex('auth_id', ['unique' => true])
            ->addIndex('email', ['unique' => true])
            ->addTimestamps()
            ->create();
    }
}
