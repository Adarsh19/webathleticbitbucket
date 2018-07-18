<?php
/*
* This helper class will provide micro functions to get data easily, from db.
* We will use them queries for special purpose.
*
*/

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/*
*   This function will get data from a table with respect to specific column for a date range.
*   @parm 'table name','column name','from date','to date'
*   i.e: getDataByDateRange('users','created_at','2018-05-24','2018-06-02')
*/
function getDataByDateRange($table, $column, $from, $to = null)
{
    if ($to == null) {
        $to = Carbon::today();
    }
    $result = DB::table($table)->select('*')->whereBetween($column, [$from, $to])->get();
    return $result;//dd($result);
}
