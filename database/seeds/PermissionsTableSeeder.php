
<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            Permission::truncate();

                $permission = [
                    ['permission' => 'Users page', 'route_name' => 'admin.users.index'],
                    ['permission' => 'Users Page Tab 1', 'route_name' => 'admin.users.index','block_name'=>'users.tab1','parent'=>'admin.users.index'],
                    ['permission' => 'Users Page Tab 2', 'route_name' => 'admin.users.index','block_name'=>'users.tab2','parent'=>'admin.users.index'],
                    ['permission' => 'Users Page Tab 3', 'route_name' => 'admin.users.index','block_name'=>'users.tab3','parent'=>'admin.users.index'],
                    ['permission' => 'Users Page Tab 4', 'route_name' => 'admin.users.index','block_name'=>'users.tab4','parent'=>'admin.users.index'],
                    ['permission' => 'Users Page Tab 5', 'route_name' => 'admin.users.index','block_name'=>'users.tab5','parent'=>'admin.users.index'],
                    ['permission' => 'Users Page Tab 6', 'route_name' => 'admin.users.index','block_name'=>'users.tab6','parent'=>'admin.users.index'],
                    ['permission' => 'Users Page Tab 7', 'route_name' => 'admin.users.index','block_name'=>'users.tab7','parent'=>'admin.users.index'],
                    ['permission' => 'Users Page Tab 8', 'route_name' => 'admin.users.index','block_name'=>'users.tab8','parent'=>'admin.users.index'],
                    ['permission' => 'Users Page Tab 9', 'route_name' => 'admin.users.index','block_name'=>'users.tab9','parent'=>'admin.users.index'],
                    ['permission' => 'Users add', 'route_name' => 'admin.users.add','parent'=>'admin.users.index'],
                    ['permission' => 'Users Edit', 'route_name' => 'admin.users.edit','parent'=>'admin.users.index'],
                    ['permission' => 'Users Delete', 'route_name' => 'admin.users.delete','parent'=>'admin.users.index'],
                    ['permission' => 'Role add', 'route_name' => 'admin.roles.add','parent'=>'users.tab8'],
                    ['permission' => 'Role Edit', 'route_name' => 'admin.roles.edit','parent'=>'users.tab8'],
                    ['permission' => 'Role Delete', 'route_name' => 'admin.roles.delete','parent'=>'users.tab8'],
                    ['permission' => 'Check in', 'route_name' => 'admin.checkin.add','parent'=>'admin.users.index'],
                    ['permission' => 'Check in Delete', 'route_name' => 'admin.checkin.delete','parent'=>'users.tab6'],
                    ['permission' => 'Permission add', 'route_name' => 'admin.permissions.add','parent'=>'users.tab9'],
                    ['permission' => 'Permission Edit', 'route_name' => 'admin.permissions.edit','parent'=>'users.tab9'],
                    ['permission' => 'Permission Delete', 'route_name' => 'admin.permissions.delete','parent'=>'users.tab9'],
                    
                    ['permission' => 'Packages page', 'route_name' => 'admin.packages.index'],
                    ['permission' => 'Users Page Tab 1', 'route_name' => 'admin.packages.index','block_name'=>'packages.tab1','parent'=>'admin.packages.index'],
                    ['permission' => 'Users Page Tab 2', 'route_name' => 'admin.packages.index','block_name'=>'packages.tab2','parent'=>'admin.packages.index'],
                    ['permission' => 'Users Page Tab 3', 'route_name' => 'admin.packages.index','block_name'=>'packages.tab3','parent'=>'admin.packages.index'],
                    
                    ['permission' => 'Packages add', 'route_name' => 'admin.packages.add','parent'=>'packages.tab1'],
                    ['permission' => 'Permission Edit', 'route_name' => 'admin.packages.edit','parent'=>'packages.tab1'],
                    ['permission' => 'Permission Delete', 'route_name' => 'admin.packages.delete','parent'=>'packages.tab1'],
                    ['permission' => 'Service add', 'route_name' => 'admin.services.add','parent'=>'packages.tab2'],
                    ['permission' => 'Service Edit', 'route_name' => 'admin.services.edit','parent'=>'packages.tab2'],
                    ['permission' => 'Service Delete', 'route_name' => 'admin.services.delete','parent'=>'packages.tab2'],
                    
                    ['permission' => 'Tests', 'route_name' => 'admin.tests.index'],
                    ['permission' => 'Tests add', 'route_name' => 'admin.tests.add','parent'=>'admin.tests.index'],
                    ['permission' => 'Tests Edit', 'route_name' => 'admin.tests.edit','parent'=>'admin.tests.index'],
                    ['permission' => 'Tests Delete', 'route_name' => 'admin.tests.delete','parent'=>'admin.tests.index'],

                    ['permission' => 'Companys', 'route_name' => 'admin.companys.index'],
                    ['permission' => 'Companys add', 'route_name' => 'admin.companys.add','parent'=>'admin.companys.index'],
                    ['permission' => 'Companys Edit', 'route_name' => 'admin.companys.edit','parent'=>'admin.companys.index'],
                    ['permission' => 'Companys Delete', 'route_name' => 'admin.companys.delete','parent'=>'admin.companys.index'],

                    ['permission' => 'Companys', 'route_name' => 'admin.companys.index'],
                    ['permission' => 'Companys add', 'route_name' => 'admin.companys.add','parent'=>'admin.companys.index'],
                    ['permission' => 'Companys Edit', 'route_name' => 'admin.companys.edit','parent'=>'admin.companys.index'],
                    ['permission' => 'Companys Delete', 'route_name' => 'admin.companys.delete','parent'=>'admin.companys.index'],
                      
                ];

                foreach ($permission as $menu) {
                    Permission::create($menu);
                }
        }
}
