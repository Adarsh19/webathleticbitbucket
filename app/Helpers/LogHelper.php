<?php
/*
* This helper class will provide micro functions to get log data easily, from activity_log table.
* We will use them to query log data.
*
*/

use Illuminate\Support\Facades\DB;
use \Spatie\Activitylog\Models\Activity;

/*
*   This function will get data from a table with respect to specific column for a date range.
*   @parm 'table name','column name','from date','to date'
*   i.e: getDataByDateRange('users','created_at','2018-05-24','2018-06-02')
*/
function getLogByLogName($log_name)
{
    $log_name=trans($log_name);
    $result = Activity::where('log_name', $log_name)->orderBy('created_at', 'DESC')->simplePaginate(9);
    return $result;//dd($result);
}
