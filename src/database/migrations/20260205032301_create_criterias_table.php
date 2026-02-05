<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateCriteriasTable extends AbstractMigration
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
        $this->table('criterias', ['id' => false, 'primary_key' => 'id'])
            ->addColumn('id', 'string', [
                'limit' => 36,
                'null' => false
            ])
            ->addColumn('standard_id', 'string', [
                'limit' => 36,
                'null' => false
            ])
            ->addColumn('name', 'string', [
                'null' => false
            ])
            ->addColumn('suggested_evidence_sources', 'text', [
                'null' => true
            ])
            ->addForeignKey('standard_id', 'standards', 'id', [
                'update' => 'CASCADE',
                'delete' => 'CASCADE'
            ])
            ->create();
    }
}
