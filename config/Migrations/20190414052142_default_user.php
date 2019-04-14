<?php

use Phinx\Migration\AbstractMigration;

class DefaultUser extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->query(
            "INSERT INTO `users` (`fullname`, `username`, `password`, `last_login`) VALUES
            ('admin', 'admin', '$2y$10$iHm4CQMPDvhHnrvxPeuYCOVyfaz3IUIoQN5M2JocGiLhmlz8dg6Fi', '2019-04-14 05:24:22');
            ");
    }
}
