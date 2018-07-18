<?php
/*
* This helper class will provide micro functions to get user access roles & permissions easily, from role,permission & pivot table.
* We will use them to query access of a user.
*
*/

use App\PermissionPivot;

/*
*   This function will get already attahced permission with a role.
*   @parm 'id'
*   i.e: getUserNameById('1')
*/
function attachedPermission($roleId, $permissionId)
{
    $result = PermissionPivot::where('role_id', $roleId)->where('permission_id', $permissionId)->first();
    if (!empty($result)) {
        return 'checked="checked"';
    } else {
        return '';
    }
}
