<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateNewMilestonesTable extends AbstractMigration
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
        $table = $this->table('milestones', [
            'id' => false,
            'primary_key' => ['id'],
        ]);

        $table
            ->addColumn('id', 'integer', [
                'identity' => true,
            ])
            ->addColumn('criteria_id', 'string', [
                'limit' => 36,
                'null' => false,
            ])
            ->addColumn('code', 'string', [
                'limit' => 20,
                'null' => false,
                'comment' => 'VD: 1.1.1',
            ])
            ->addColumn('order', 'integer', [
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'limit' => 255,
                'null' => false,
            ])
            ->addIndex(['criteria_id', 'code'], [
                'unique' => true,
                'name' => 'uniq_milestone_code_per_criteria',
            ])
            ->addIndex(['criteria_id', 'order'], [
                'unique' => true,
                'name' => 'uniq_milestone_order_per_criteria',
            ])
            ->addForeignKey(
                'criteria_id',
                'criterias',
                'id',
                [
                    'delete' => 'CASCADE',
                    'update' => 'CASCADE',
                ]
            )
            ->create();
    }
}
