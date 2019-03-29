<?php
use Migrations\AbstractMigration;

class CreateSummaryView extends AbstractMigration
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
        $this->query("
            CREATE VIEW summary AS SELECT
            (select count(*) from schedules)  as 'blackout_count',
            (select min(starting_date) from schedules) as 'starting_date',
            (select max(ending_date) from schedules) as 'ending_date',
            (select count(*) from allocations) as 'areas_affected',
            (
            select count(DISTINCT regions.id) 
            from allocations
            inner join areas on areas.id = area_id
            inner join locations on locations.id = areas.location_id
            inner join regions on regions.id = locations.region_id
            ) as 'regions_affected',
            curdate() as 'date'
        ");
    }
}
