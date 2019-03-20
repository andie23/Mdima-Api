<?php

use Phinx\Migration\AbstractMigration;

class DatabaseInstallion extends AbstractMigration
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
        $this->query("
        
                CREATE TABLE `allocations` (
                    `id` int(11) NOT NULL,
                    `area_id` int(11) NOT NULL,
                    `group_id` int(11) NOT NULL
                );

                CREATE TABLE `areas` (
                    `id` int(11) NOT NULL,
                    `name` varchar(125) NOT NULL,
                    `location_id` int(11) NOT NULL
                );

                CREATE TABLE `groups` (
                    `id` int(11) NOT NULL,
                    `name` varchar(255) NOT NULL
                );

                CREATE TABLE `locations` (
                    `id` int(11) NOT NULL,
                    `name` varchar(125) NOT NULL,
                    `region_id` int(11) NOT NULL
                );

                CREATE TABLE `regions` (
                    `id` int(11) NOT NULL,
                    `name` varchar(125) NOT NULL
                );

                CREATE TABLE `schedules` (
                    `id` int(11) NOT NULL,
                    `duration` int(11) NOT NULL,
                    `starting_date` datetime NOT NULL,
                    `ending_date` datetime NOT NULL,
                    `group_id` int(11) NOT NULL,
                    `name` varchar(255) NOT NULL
                );

                ALTER TABLE `allocations`
                ADD PRIMARY KEY (`id`);

                ALTER TABLE `areas`
                ADD PRIMARY KEY (`id`);

                ALTER TABLE `groups`
                ADD PRIMARY KEY (`id`),
                ADD UNIQUE KEY `name` (`name`);

                ALTER TABLE `locations`
                ADD PRIMARY KEY (`id`);

                ALTER TABLE `regions`
                ADD PRIMARY KEY (`id`);

                ALTER TABLE `schedules`
                ADD PRIMARY KEY (`id`);

                ALTER TABLE `allocations`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

                ALTER TABLE `areas`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

                ALTER TABLE `groups`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

                ALTER TABLE `locations`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

                ALTER TABLE `regions`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

                ALTER TABLE `schedules`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
        ");

    }
}
