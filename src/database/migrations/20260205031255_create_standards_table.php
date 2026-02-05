<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateStandardsTable extends AbstractMigration
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
        $this->table('standards', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'string', [
                'limit' => 36,
                'null' => false
            ])
            ->addColumn('name', 'string', [
                'null' => false
            ])
            ->addColumn('department_id', 'string', [
                'limit' => 30,
                'null' => false
            ])
            ->addForeignKey('department_id', 'departments', 'id', [
                'update' => 'CASCADE',
                'delete' => 'CASCADE'
            ])
            ->create();
    }
}
