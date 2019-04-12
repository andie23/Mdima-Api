<?php

use Phinx\Migration\AbstractMigration;

class SummaryViewUpdate extends AbstractMigration
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
        DROP VIEW IF EXISTS summary;
        CREATE VIEW summary AS SELECT
        
        (select count(*) from schedules 
         inner join groups on groups.id=schedules.group_id
         inner join programmes on groups.programme_id = programmes.id
         where programmes.is_published = 1) as 'blackout_count',

        (select min(starting_date) from schedules	
         inner join groups on groups.id=schedules.group_id
         inner join programmes on groups.programme_id = programmes.id
         where programmes.is_published = 1) as 'starting_date',
        
        (select max(ending_date) from schedules	
         inner join groups on groups.id=schedules.group_id
         inner join programmes on groups.programme_id = programmes.id
         where programmes.is_published = 1) as 'ending_date',
        
        (select count(*) from allocations
         inner join groups on groups.id=allocations.group_id
         inner join programmes on groups.programme_id = programmes.id
         where programmes.is_published = 1) as 'areas_affected',
        
        (select count(DISTINCT regions.id) 
         from allocations
         inner join areas on areas.id = area_id
         inner join locations on locations.id = areas.location_id
         inner join regions on regions.id = locations.region_id
         inner join groups on groups.id=allocations.group_id
         inner join programmes on groups.programme_id = programmes.id
         where programmes.is_published = 1) as 'regions_affected',

         curdate() as 'date';
    ");
    }
}
