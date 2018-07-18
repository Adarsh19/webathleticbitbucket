<?php
/*
* This helper class will provide micro functions to get user data easily, from users table.
* We will use them to query log data.
*
*/

use App\User;

/*
*   This function will get username from by user id.
*   @parm 'id'
*   i.e: getUserNameById('1')
*/
function getUserNameById($id)
{
    $result = User::find($id);
    return $result->name;
}
