<?php
use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('email', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('password', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('is_admin', 'boolean', [
            'default' => false,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addIndex([
            'email',
        ], [
            'name' => 'UNIQUE_EMAIL',
            'unique' => true,
        ]);
        $table->create();
    }
}
