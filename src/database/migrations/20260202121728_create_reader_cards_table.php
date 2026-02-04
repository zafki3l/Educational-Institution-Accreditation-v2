<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateReaderCardsTable extends AbstractMigration
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
        $this->table('reader_cards', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'string', ['null' => false])
            ->addColumn('user_id', 'string', ['null' => false])
            ->addForeignKey('user_id', 'users', 'id', [
                'update' => 'CASCADE',
                'delete' => 'CASCADE'
            ])
            ->addColumn('issued_at', 'timestamp')
            ->addColumn('expired_at', 'timestamp')
            ->addColumn('status', 'integer', ['default' => 1])
            ->addTimestamps()
            ->create();
    }
}
