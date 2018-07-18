<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// admin routes
// Route::prefix('admin')->group(function () {

//     Route::get('/dashboard', function () {
//       return view('admin.dashboard');
//     });

//    Route::get('/dashboard', 'UserController@dashboard');

// });
Route::group(['middleware' => 'role'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {

        Route::get('resource', array('as'=>'viewResource', 'uses' => 'ResourceController@resource'));
        Route::get('/screen-lock', ['as' => 'screen-lock', 'uses' => 'DashboardController@screenLock']);
        Route::post('/unlock', ['as' => 'unlock', 'uses' => 'DashboardController@unlock']);
    
        Route::get('/dashboard', ['as' => 'dashboardRoute', 'uses' => 'DashboardController@index']);
        Route::get('/graphdata/{startdate}/{enddate}/{type}', ['as' => 'dashboardGraph', 'uses' => 'DashboardController@graphdata']);
        Route::get('/rooster/load-connected-users/{userid}', ['as'=>'loadConnectedUsersRqst','uses'=>'RoosterController@loadConnectedUsers']);
        Route::get('/rooster/load-booked-reservate-users/{schedule_id}', ['as'=>'loadBookedReservatedUsersRqst','uses'=>'RoosterController@loadBookReservateUsers']);
        
        Route::post('/image-update/{company_id}', ['as' => 'imageupdate', 'uses' => 'UserController@updateImage']);
        #NOTE FOR OTHER TEAM, YOU CAN ADD THESE ROUTES INSIDE ABOVE ADMINPREFIX group,  but need to add 'as' => 'admin.'
        /***** Admin Rooster Start here*****/
        Route::get('/rooster/searchuser/{type}/{keyword}/{service_id}', ['as'=>'rooster.searchuser','uses'=>'RoosterController@searchUsers']);

        Route::get('/rooster/loadEvents/{scheduleid}', ['as'=>'rooster.loadEvents','uses'=>'RoosterController@loadEvents']);
        Route::get('/rooster/{usrid}/{schedule_id?}/{date?}', ['as'=>'roosterRqst','uses'=>'RoosterController@index']);
        //Route::get('/rooster/{schedule_id}/{date}','RoosterController@index');

        Route::post('/rooster/addServiceSchedule', ['as'=>'addServiceScheduleRqst','uses'=>'RoosterController@addServiceSchedule']);
        Route::post('/rooster/editSchedule/{schedule_id}', ['as'=>'editScheduleTabRqst','uses'=>'RoosterController@editServiceSchedule']);

        Route::delete('/rooster/deleteSchedule/{schedule_id}', ['as'=>'deleteScheduleRqst','uses'=>'RoosterController@deleteServiceSchedule']);

        Route::post('/rooster/saveConnectedUser', ['as'=>'saveConnectedUserRqst','uses'=>'RoosterController@saveConnectedUser']);
        Route::post('/rooster/updateConnectedUser/{rowid}', ['as'=>'updateConnectedUserRqst','uses'=>'RoosterController@updateConnectedUser']);
        Route::delete('/rooster/deleteConnectedUser/{userid}', ['as'=>'deleteConnectedUserRqst','uses'=>'RoosterController@deleteConnectedUser']);
        Route::post('/rooster/saveScheduleEvent', ['as'=>'saveScheduleEventRqst','uses'=>'RoosterController@saveScheduleEvent']);
        Route::post('/rooster/editServiceSchedule/{schedule_id}', ['as'=>'editServiceScheduleRqst','uses'=>'RoosterController@updateEvent']);
        Route::post('/rooster/deleteServiceSchedule', ['as'=>'deleteServiceScheduleRqst','uses'=>'RoosterController@deleteEvent']);
//    Route::get('/rooster/load-calendar/{scheduleid}',['as'=>'loadCalendarScheduleRqst','uses'=>'RoosterController@loadCalendarSchedule']);
    
    
    
           /**** Exercises Routes here*****/
        Route::get('/exercises', ['as' => 'exercisesViewRqst', 'uses' => 'ExercisesController@exerciseView']);
        Route::get('/exercises/createschedule/{userid}/{exerciseid}', ['as'=>'createscheduleRqst','uses'=>'ExercisesController@createschedule']);
        Route::post('/exercises/add-exercise-group', ['as' => 'addExerciseGroupRqst', 'uses' => 'ExercisesController@addExerciseGroup']);
        Route::post('/exercises/add-exercise', ['as' => 'addExerciseRqst', 'uses' => 'ExercisesController@addExercise']);
        Route::post('/exercises/edit-exercise/{id}', ['as' => 'editExerciseRqst', 'uses' => 'ExercisesController@editExercise']);
        Route::delete('/exercises/delete-exercise/{id}', ['as' => 'deleteExerciseRqst', 'uses' =>  'ExercisesController@deleteExercise']);
        Route::post('/exercises/edit-schedule/{id}', ['as' => 'editScheduleRqst', 'uses' => 'ExercisesController@editTrainingSchema']);
        Route::delete('/exercises/delete-exercise-schedule/{id}', ['as' => 'deleteexerciseScheduleRqst', 'uses' => 'ExercisesController@deleteTrainingExercise']);
        Route::get('/exercises/schema/pdf/{id}', ['as' => 'showPdfRoute', 'uses' => 'ExercisesController@showTrainingSchemaPdf']);

//    /*AJAX */
        Route::get('/exercises/search-user/{keyword}', ['as' => 'searchUserRqst','uses' => 'ExercisesController@searchUser']);
        Route::get('/exercises/show-schedules/{userid}', ['as' => 'showScheduleRqst', 'uses' => 'ExercisesController@showAddedExercises']);
        Route::get('/exercises/schema/loadAddedSchema/{users}', ['as' => 'loadAddedSchemaRqst','uses' => 'ExercisesController@loadAddedSchema']);

        Route::get('/exercises/load-user-session', ['as' => 'loadUserSessionRqst','uses' => 'ExercisesController@loadUserSession']);
        Route::delete('/exercises/delete/schema/{id}', ['as' => 'deleteSchemaRqst','uses' => 'ExercisesController@deleteSchedule']);
        Route::post('/exercises/save-schema/{id}', ['as' => 'saveSchemaRqst','uses' => 'ExercisesController@saveSchedule']);
        Route::get('/exercises/updateSessionUsers/{id}', ['as' => 'updateSessionRqst','uses' => 'ExercisesController@updateSession']);
        Route::get('/exercises/removeSessionUsers/{id}', ['as' => 'removeSessionRqst','uses' => 'ExercisesController@removeSessionUsers']);
        Route::get('/exercises/loadPredefinedSchema', ['as' => 'loadPredefinedRqst','uses' => 'ExercisesController@loadPredefinedSchema']);
        Route::get('/exercises/loadPredefinedSchemaFilter/{keyword}', ['as' => 'loadPredefinedFilterRqst','uses' => 'ExercisesController@loadPredefinedSchemaFilter']);
        Route::delete('/exercises/schema/deleteAddedSchema/{users}', ['as' => 'deleteAddedRqst','uses' => 'ExercisesController@deleteAddedSchema']);
        Route::get('/exercises/loadPredefinedSchema/exercise/{scheduleid}', ['as' => 'loadPredefinedExerRqst','uses' => 'ExercisesController@loadPredefinedSchemaExercises']);
        Route::get('/exercises/addpredefinedchedule/{userid}/{scheduleid}', 'ExercisesController@addpredefinedchedule');

        /*****Exercise Routes Ends Here ****/


        /**
        Routes for Trainig dropdowns
         **/

        Route::post('/exercises/savetrainingGoal/{userid}', ['as' => 'savetrainingGoalRequest', 'uses' => 'TrainingController@savetrainingGoal']);
        Route::post('/exercises/savetrainingMaterial/{userid}', ['as' => 'savetrainingMaterialRequest', 'uses' => 'TrainingController@savetrainingMaterial']);
        Route::post('/exercises/savetrainingTrainingLevel/{userid}', ['as' => 'savetrainingTrainingLevelRequest', 'uses' => 'TrainingController@savetrainingTrainingLevel']);
        Route::post('/exercises/savetrainingaccentgroup/{userid}', ['as' => 'savetrainingaccentgroupRequest', 'uses' => 'TrainingController@savetrainingaccentgroup']);


        Route::delete('/exercises/deletetrainingGoal/{id}', ['as' => 'deletetrainingGoalRequest', 'uses' => 'TrainingController@deletetrainingGoal']);
        Route::delete('/exercises/deletetrainingMaterial/{id}', ['as' => 'deletetrainingMaterialRequest', 'uses' => 'TrainingController@deletetrainingMaterial']);
        Route::delete('/exercises/deletetrainingTrainingLevel/{id}', ['as' => 'deletetrainingTrainingLevelRequest', 'uses' => 'TrainingController@deletetrainingTrainingLevel']);
        Route::delete('/exercises/deletetrainingaccentgroup/{id}', ['as' => 'deletetrainingaccentgroupRequest', 'uses' => 'TrainingController@deletetrainingaccentgroup']);

        Route::post('/exercises/updatetrainingGoal/{id}/{userid}', ['as' => 'updatetrainingGoalRequest', 'uses' => 'TrainingController@updatetrainingGoal']);
        Route::post('/exercises/updatetrainingMaterial/{id}/{userid}', ['as' => 'updatetrainingMaterialRequest', 'uses' => 'TrainingController@updatetrainingMaterial']);
        Route::post('/exercises/updatetrainingTrainingLevel/{id}/{userid}', ['as' => 'updatetrainingTrainingLevelRequest', 'uses' => 'TrainingController@updatetrainingTrainingLevel']);
        Route::post('/exercises/updatetrainingaccentgroup/{id}/{userid}', ['as' => 'updatetrainingaccentgroupRequest', 'uses' => 'TrainingController@updatetrainingaccentgroup']);
        Route::post('/exercises/profile/update/coaching/{id}', ['as' => 'profileupdatecoachingRqst', 'uses' => 'TrainingController@profileupdatecoaching']);






        /****Products starts here****/
        Route::post('products/editgroup/{id}', ['as' => 'editGroupRqst','uses'=> 'ProductsController@editprdouctgroup']);
        Route::post('products/editprdouctgroup/{iid}', 'ProductsController@editprdouctgroup');
        Route::post('products/editproducts/{productid}', ['as' => 'editProductRqst','uses'=>  'ProductsController@editproducts']);

        Route::get('/products', ['as' => 'productsRqst', 'uses' => 'ProductsController@productogroups']);
        Route::get('/products/product-group/{pgroupslug}', ['as' => 'showSubGroupRqst','uses'=>'ProductsController@groups']);
         Route::get('/products/product-sub-group/{psubgroupslug}', ['as' => 'showSubSubGroupsRqst', 'uses' =>  'ProductsController@subgroupproducts']);

         Route::post('/products/add-product-group', ['as' => 'addProductGroupRqst', 'uses' => 'ProductsController@addProductGroup']);
         Route::get('/products/view-orders', ['as' => 'viewOrdersRequest', 'uses' => 'ProductsController@viewOrders']);
         Route::post('/products/search-orders', ['as' => 'searchOrderRqst', 'uses' => 'ProductsController@viewOrders']);



         Route::post('/products/add-products', ['as' => 'addProductRqst', 'uses' => 'ProductsController@addProduct']);
         Route::delete('/products/deleteproducts/{id}', ['as' => 'deleteProductRqst', 'uses' =>'ProductsController@deleteproduct']);
         Route::delete('/products/deleteproductssubgroup/{id}', ['as' => 'deleteProductSubGrpRqst', 'uses' => 'ProductsController@deleteproductssubgroup']);




         Route::get('/products/getcart/{orderid}', [
         'uses' => 'ProductsController@getorderdetails'
         ]);

         Route::get('/products/cart/calculatetotalprice/{userid}', 'ProductsController@calculatetotalprice');
         Route::get('/products/cart/showpaypopup/{userid}', 'ProductsController@showPayPopup');

         Route::post('/products/cart/savecart', ['as' => 'saveCartRqst', 'uses' => 'ProductsController@savecart']);

//     Route::post('/products/add-products', ['as' => 'addProductRqst', 'uses' => 'ProductsController@addProduct']);


         //Route::get('/loadusertile/{userid}','ProductsController@showpreviouslystoredorders');
         Route::get('/products/loadusertile', [
         'uses' => 'ProductsController@loaduserlastaccessed'
         ]);

        Route::post('/products/saveProductSetting/{delflag}', [
        'as' => 'saveProductSettingRqst', 'uses' => 'ProductsController@saveProductSetting'
        ]);



//     //AJAX CALLS
         Route::get('/products/showpreviouslystoredorders/{userid}', [
         'uses' => 'ProductsController@showpreviouslystoredorders'
         ]);
         Route::post('/products/cart/savetransaction', [
         'as' => 'saveTransactionRqst','uses' => 'ProductsController@savetransaction'
         ]);
         Route::post('/products/cart/cancelorder', ['as' => 'cancelOrderRqst',
         'uses' => 'ProductsController@cancelorder'
         ]);


//     Route::get('/products/loadfromsessioncart',[
//         'uses' => 'ProductsController@loadfromsessioncart'
//     ]);

//     Route::get('/products/removeSessionUsers/{userid}',[
//         'uses' => 'ProductsController@removeSessionUsers'
//     ]);

         Route::post('/products/cart/editCartItem/{id}', [
         'as' => 'editCartItemRqst','uses' => 'ProductsController@editCartItem'
         ]);
         Route::delete('/products/cart/deleteCartItem/{id}', [
         'as' => 'deleteCartItemRqst','uses' => 'ProductsController@deleteCartItem'
         ]);


         Route::get('/products/searchuser/{keyword}', [
         'as' => 'products.searchuser',
         'uses' => 'ProductsController@searchusersonproducts'
         ]);

         Route::get('/products/createorder/{userid}/{productid}', [
         'as' => 'products.createorder',
         'uses' => 'ProductsController@createorder'
         ]);
//     /****Products Ends****/


//     /**AJAX*/
//     Route::get('/products/searchuser/{keyword}',['as' => 'products.searchuser','uses' => 'ProductsController@searchusersonproducts']);
//     /*Products routes ends here*/


        /*
     * Notifications Routes here
         * **/

        Route::get('/notifications/view-notifications/{id}', ['as' => 'viewnotificationsRqst', 'uses' => 'NotificationsController@viewNotifications']);




        /*****************************
        * Title: Why creating duplicate group for admin routes! Thus I moved other routes here to get it under same group & middlewere.
        * Team:
        * Created By:
        ******************************/
        Route::get('/users/fooddetails', ['as' => 'user.getfooddetails', 'uses' => 'UserController@getFoodDetails']);
       /*Users Index*/
    
        Route::get('users/index', ['as'=>'userIndexRoute','uses'=>'UserController@index']);
  
        Route::resource('/users', 'UserController');
        Route::get('/users/view/{id}', ['as'=>'user.dashboardRoute','uses'=>'UserController@user_dashboard']);
   
        Route::post('/users/add-daily-food', ['as' => 'user.daily_food', 'uses' => 'UserController@storeUserDailyFood']);
        Route::post('/users/add-food-used', ['as' => 'user.food_used', 'uses' => 'UserController@storeUserFoodUsed']);
        Route::post('/users/add-daily-values', ['as' => 'user.daily_values', 'uses' => 'UserController@storeUserDailyValues']);


        Route::post('/users/profile-update', 'UserController@updateProfileImage');
        Route::post('/imgage-update', 'UserController@updateImage');
        Route::post('/genrate-file', 'UserController@genrate_file');
        Route::get('/bulk-delete/roles', 'RolesController@bulkDestroyRequest');
        Route::post('/bulk-delete/company', ['as' => 'company.bulkdelete', 'uses' => 'CompanyController@bulkDestroyRequest']);

        Route::get('/bulk-delete/packages', 'PackageController@bulkDestroyRequest');

        Route::get('/bulk-delete/permissions', 'PermissionsController@bulkDestroyRequest');

        Route::get('/bulk-delete/role-permissions', 'RolePermissionsController@bulkDestroyRequest');

        Route::get('/bulk-delete/services', 'ServiceController@bulkDestroyRequest');

        Route::get('/bulk-delete/stories', 'StoryController@bulkDestroyRequest');

        Route::get('/bulk-delete/user-status', 'UserStatusController@bulkDestroyRequest');


        Route::post('/check-in', 'UserController@checkIn');
        Route::get('/check-in-remove', 'UserController@checkInRemove');
        Route::get('/log-remove', 'UserController@log_remove');
        Route::get('/accept-terms', 'UserController@acceptTerms');
        Route::get('/packages-get', 'PackageController@companyPackages');



        /*Rooster ends here*/
    });

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
//     Route::get('/dashboard', ['as' => 'dashboardRoute', 'uses' => 'DashboardController@index']);

//     /*** For Page ***/
//     Route::resource('pages', 'PageController');
//     Route::post('/pages/update/{page}', 'PageController@frontUpdate');
//     Route::get('/get-pages', ['as' => 'getPagesRoute', 'uses' => 'PageController@get']);
//     Route::get('/pages/published/{id}', ['as' => 'publishedPagesRoute', 'uses' => 'PageController@published']);
//     Route::get('/pages/unpublished/{id}', ['as' => 'unpublishedPagesRoute', 'uses' => 'PageController@unpublished']);

//     /*** For Gallery ***/
//     Route::resource('galleries', 'GalleryController');
//     Route::get('/get-galleries', ['as' => 'getGalleriesRoute', 'uses' => 'GalleryController@get']);
//     Route::get('/galleries/published/{id}', ['as' => 'publishedGalleriesRoute', 'uses' => 'GalleryController@published']);
//     Route::get('/galleries/unpublished/{id}', ['as' => 'unpublishedGalleriesRoute', 'uses' => 'GalleryController@unpublished']);

//     /*** For STORY ***/
//     Route::resource('stories', 'StoryController');
//     Route::get('/get-stories', ['as' => 'getStoriesRoute', 'uses' => 'StoryController@get']);
//     Route::get('/stories/published/{id}', ['as' => 'publishedStoriesRoute', 'uses' => 'StoryController@published']);
//     Route::get('/stories/unpublished/{id}', ['as' => 'unpublishedStoriesRoute', 'uses' => 'StoryController@unpublished']);

// /***********************Code by VH team started***********************/

        
        Route::post('users/destroy-bulk', ['as'=>'deleteBulkRequest','uses'=>'UserController@bulkDestroyURequest']);

//     /*** For Roles ***/
         Route::resource('roles', 'RolesController');
         Route::get('/get-roles', ['as' => 'getRolesRoute', 'uses' => 'RolesController@get']);

//     /*** For Roles ***/
         Route::resource('permissions', 'PermissionsController');
         Route::get('/get-permissions', ['as' => 'getPermissionsRoute', 'uses' => 'PermissionsController@get']);

         //     /*** For User Status ***/

         Route::resource('user_status', 'UserStatusController');

         Route::get('/get-user_status', ['as' => 'getUserStatusRoute', 'uses' => 'UserStatusController@get']);


//     /*** For Rolepermission ***/
        Route::resource('rolepermission', 'RolepermissionsController');
        Route::post('/rolepermission/add', ['as' => 'addpermisionRoute', 'uses' => 'UseraddController@addprmision']);

//     /*** For Packages ***/
        Route::resource('packages', 'PackageController');
        Route::get('/get-packages', ['as' => 'getPackagesRoute', 'uses' => 'PackageController@get']);
		Route::get('/get-invoices', ['as' => 'getInvoiceRoute', 'uses' => 'PackageController@getinvoices']);
		Route::get('/invoice-cron', ['as' => 'runInvoiceCron', 'uses' => 'PackageController@invoiceCron']);
		Route::get('/download-invoice/{id}', ['as' => 'downloadInvoiceRoute', 'uses' => 'PackageController@downloadPDF']);
        Route::get('/packages/deactivated/{id}', ['as' => 'deactivatedPackageRoute', 'uses' => 'PackageController@deactivated']);
        Route::get('/packages/activated/{id}', ['as' => 'activatedPackageRoute', 'uses' => 'PackageController@activated']);

//   /*** For User ***/
//   Route::resource('users', 'UserController');
//   Route::get('/get-users', ['as' => 'getUsersRoute', 'uses' => 'UserController@get']);
//   Route::get('/add-users', ['as' => 'newUsersRoute', 'uses' => 'UserController@new']);
//   Route::any('/user-add', ['as' => 'addUsersRoute', 'uses' => 'UserController@addnewuser']);

        //  /*** For Company ***/
        Route::resource('companys', 'CompanyController');
        Route::post('company/update/{id}', ['as' => 'updateCompanysRoute', 'uses' => 'CompanyController@update']);
        Route::post('company/updateUi', ['as' => 'updateCompanysUI', 'uses' => 'CompanyController@updateUi']);
        Route::get('/get-companys', ['as' => 'getCompanysRoute', 'uses' => 'CompanyController@get']);
        Route::get('/add-company', ['as' => 'newCompanysRoute', 'uses' => 'CompanyController@new']);
        Route::post('/company-add', ['as' => 'addCompanysRoute', 'uses' => 'CompanyController@addnewcompany']);
    
         /*
         * Used to save  opening hurs details by admin*/
        Route::post('companys/add-openinghours/{userid}', ['as' => 'saveOpeningHoursRqst', 'uses' => 'CompanyController@saveOpeningHours']);


//     /*** For Service ***/
        Route::resource('services', 'ServiceController');
        Route::get('/get-services', ['as' => 'getServicesRoute', 'uses' => 'ServiceController@get']);
        Route::get('/add-services', ['as' => 'newServicesRoute', 'uses' => 'ServiceController@new']);
        Route::post('/service-add', ['as' => 'addServicesRoute', 'uses' => 'ServiceController@addnewuser']);





//     /***** Admin Rooster Start here*****/
//     Route::get('/rooster','RoosterController@index');
//     Route::get('/rooster/{date}','RoosterController@index');
//     Route::post('/rooster/saveConnectedUser',['as'=>'saveConnectedUserRqst','uses'=>'RoosterController@saveConnectedUser']);
//     Route::delete('/rooster/deleteConnectedUser/{userid}',['as'=>'deleteConnectedUserRqst','uses'=>'RoosterController@deleteConnectedUser']);
//     /*Rooster ends here*/
        // Route for log table

        Route::get('/logs', 'DashboardController@getLogs')->name('logs.index');



        // Route for permissions table

        Route::get('/attach-permissions', 'PermissionsController@get_permissions_for_attach_role')->name('role.permissions');

        Route::post('/attach-permissions', 'PermissionsController@set_permissions_for_attach_role')->name('role.permissions.setP');

    
        /***** Test Module Route Start here*****/
        Route::get('/tests', ['as'=>'tests.index','uses'=>'TestController@index']);
        Route::get('/tests/view/{id}', ['as'=>'tests.view','uses'=>'TestController@show']);
        Route::get('/tests/edit/{id}', ['as'=>'tests.edit','uses'=>'TestController@edit']);
        Route::post('/tests/update/{id}', ['as'=>'tests.update','uses'=>'TestController@update']);
        Route::get('/tests/get', ['as'=>'tests.show','uses'=>'TestController@get']);
        Route::post('/tests/destroy/{id}', ['as'=>'tests.destroy','uses'=>'TestController@destroy']);
        Route::post('/tests/store', ['as'=>'tests.store','uses'=>'TestController@store']);
        Route::get('/tests/add', ['as'=>'tests.add','uses'=>'TestController@new']);
        Route::post('/tests/bulkdelete', ['as'=>'tests.bulkdelete','uses'=>'TestController@bulkDestroyRequest']);
        Route::post('/tests/answer/{id}', ['as'=>'tests.answer','uses'=>'TestController@storeAnswer']);

        /*Test Module Route ends here*/
    });

    Route::group(['prefix' => 'company', 'as' => 'company.'], function () {
        Route::get('/dashboard', ['as' => 'dashboardRoute', 'uses' => 'DashboardController@index']);

        /*** For Roles ***/
        Route::resource('roles', 'RolesController');
        Route::get('/get-roles', ['as' => 'getRolesRoute', 'uses' => 'RolesController@get']);

        /*** For Roles ***/
        Route::resource('permissions', 'PermissionsController');
        Route::get('/get-permissions', ['as' => 'getPermissionsRoute', 'uses' => 'PermissionsController@get']);

        /*** For Rolepermission ***/
        Route::resource('rolepermission', 'RolepermissionsController');
        //Route::post('/rolepermission/add', ['as' => 'addpermisionRoute', 'uses' => 'UseraddController@addprmision']);

        /*** For Service ***/
        Route::resource('services', 'ServiceController');
        Route::get('/get-services', ['as' => 'getServicesRoute', 'uses' => 'ServiceController@get']);
        Route::get('/add-services', ['as' => 'newServicesRoute', 'uses' => 'ServiceController@new']);
        Route::post('/service-add', ['as' => 'addServicesRoute', 'uses' => 'ServiceController@addnewuser']);

        /***** Company Rooster Start here*****/
        Route::get('/rooster', 'RoosterController@index');
        Route::get('/rooster/{date}', 'RoosterController@index');
        Route::post('/rooster/saveConnectedUser', ['as'=>'saveConnectedUserRqst','uses'=>'RoosterController@saveConnectedUser']);
        Route::delete('/rooster/deleteConnectedUser/{userid}', ['as'=>'deleteConnectedUserRqst','uses'=>'RoosterController@deleteConnectedUser']);
        /*Rooster ends here*/
    });

    Route::post('/updateImages', 'StoriesController@updateImages');

    Route::post('/subscribe_file_upload', 'HomeController@subscribe_file_upload')->name('subscribe_file_upload');
    Route::get('/profile', 'HomeController@profile');
    Route::post('/profile/update', 'HomeController@profileupdate');
    Route::get('/signout', 'HomeController@signout');
    Route::get('/org/{slug}/signout', 'HomeController@signout');
});
Route::resource('/stories', 'StoriesController');
Route::resource('/gallery', 'GalleryController');
Route::resource('/pages', 'PageController');

// users routes

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@homePage']);
Route::get('/org/{slug}', ['as' => 'homeSluggish', 'uses' => 'HomeController@homePage']);
Route::get('/contact', ['as' => 'contact', 'uses' => 'HomeController@contact']);
Route::get('/org/{slug}/contact', ['as' => 'contactSluggish', 'uses' => 'HomeController@contact']);

Route::get('/methods', ['as' => 'methodsRoute', 'uses' => 'HomeController@methodsPage']);

Route::get('/client', 'StoriesController@index');
Route::get('/org/{slug}/client', 'StoriesController@index');
Route::get('/service', 'ServiceController@userview');
Route::get('/org/{slug}/service', 'ServiceController@userview');
Route::get('/{slug}/service', 'ServiceController@userview');

Route::post('/login', 'HomeController@Login');
Route::post('/org/{slug}/login', 'HomeController@Login');
Route::post('/logevent', ['as' => 'logevent', 'uses' => 'DashboardController@logevent']);
Route::get('/org/{slug}/home', 'HomeController@index')->name('home');

Route::post('/subscribe', 'HomeController@subscribe')->name('subscribe');
Route::get('/org/{slug}/signup/{id}', 'HomeController@signup');
Route::get('/signup/{id}', 'HomeController@signup');
Route::get('org/{slug}/signup/{id}', 'HomeController@signup');
Route::get('/signup', 'HomeController@signup');
Route::get('org/{slug}/signup', 'HomeController@signup');
Route::post('/verifySignup', 'HomeController@verifySignup');
/* verify User */
Route::any('/verify-user/{token?}', ['as'=>'verify-user','uses'=>'HomeController@verifyUser']);

/*contact form mail function*/
Route::post('contact-form', ['as' => 'contactFormRoute', 'uses' => 'HomeController@mailContactForm']);
Route::post('org/{slug}/contact-form', ['as' => 'contactFormRouteSluggish', 'uses' => 'HomeController@mailContactForm']);
/*****************************
* Title: Global redirection route for auth middlewere to redirect not authenticated user.
* Team:
* Created By:
******************************/
Route::get('no-permission', function () {
    return redirect('/');
})->name('login');
