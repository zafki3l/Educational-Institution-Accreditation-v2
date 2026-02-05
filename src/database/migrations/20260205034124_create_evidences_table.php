<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateEvidencesTable extends AbstractMigration
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
        $this->table('evidences', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'string', [
                'limit' => 36,
                'null' => false
            ])
            ->addColumn('name', 'string', [
                'null' => false
            ])
            ->addColumn('document_number', 'string', [
                'limit' => 50,
                'null' => false
            ])
            ->addColumn('issued_date', 'date', [
                'null' => false
            ])
            ->addColumn('issuing_authority', 'string', [
                'null' => false,
                'limit' => 100
            ])
            ->addColumn('file_url', 'string', [
                'null' => true
            ])
            ->create();
    }
}
