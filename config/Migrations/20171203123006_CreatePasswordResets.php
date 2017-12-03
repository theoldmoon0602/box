<?php
use Migrations\AbstractMigration;

class CreatePasswordResets extends AbstractMigration
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
        $table = $this->table('password_resets');
        $table->addColumn('email', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('token', 'string', [
            'default' => null,
            'limit' => 64,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
		$table->addForeignKey('email', 'users', 'email');
        $table->create();
    }
}
