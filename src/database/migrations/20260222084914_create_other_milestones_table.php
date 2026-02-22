<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateOtherMilestonesTable extends AbstractMigration
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
        $table = $this->table('other_milestones', [
            'id' => false,
            'primary_key' => ['id'],
        ]);

        $table
            ->addColumn('id', 'integer', [
                'identity' => true,
            ])
            ->addColumn('evidence_id', 'string', [
                'limit' => 36,
                'null' => false,
            ])
            ->addColumn('milestone_id', 'integer', [
                'null' => false,
                'signed' => true,
            ])
            ->addTimestamps()
            ->addIndex(['evidence_id', 'milestone_id'], [
                'unique' => true,
                'name' => 'uniq_evidence_milestone',
            ])
            ->addForeignKey('evidence_id', 'evidences', 'id', [
                'update' => 'CASCADE',
                'delete' => 'CASCADE',
            ])
            ->addForeignKey('milestone_id', 'milestones', 'id', [
                'update' => 'CASCADE',
                'delete' => 'CASCADE',
            ])
            ->create();
    }
}
