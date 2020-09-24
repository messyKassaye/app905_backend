<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['prefix' => 'auth'], function(Router $api) {
        $api->post('signup', 'App\\Api\\V1\\Controllers\\SignUpController@signUp');
        $api->post('login', 'App\\Api\\V1\\Controllers\\LoginController@login');
        $api->post('driver_signup','App\\Api\\V1\\Controllers\\DriverSignup@signUp');

        $api->post('recovery', 'App\\Api\\V1\\Controllers\\ForgotPasswordController@sendResetEmail');
        $api->post('reset', 'App\\Api\\V1\\Controllers\\ResetPasswordController@resetPassword');

        $api->post('logout', 'App\\Api\\V1\\Controllers\\LogoutController@logout');
        $api->post('refresh', 'App\\Api\\V1\\Controllers\\RefreshController@refresh');
        $api->get('me', 'App\\Api\\V1\\Controllers\\UserController@me');
        $api->get('mobileMe','App\Api\V1\Controllers\\UserController@mobileMe');
        $api->post('config','App\\Api\\V1\\Controllers\\ConfigController@store');

    });



    $api->group(['middleware' => 'jwt.auth'], function(Router $api) {
        $api->get('protected', function() {
            return response()->json([
                'message' => 'Access to protected resources granted! You are seeing this text as you provided the token correctly.'
            ]);
        });

        $api->get('refresh', [
            'middleware' => 'jwt.refresh',
            function() {
                return response()->json([
                    'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!'
                ]);
            }
        ]);

        //admin routes
        $api->group(['prefix'=>'admin','middleware'=>'admin'],function (Router $api){
           $api->resource('fault_types','App\\Api\\V1\\Controllers\\FaultTypeController');
           $api->resource('districts','App\\Api\\V1\\Controllers\\DistrictController'); 
           $api->resource('managers','App\\Api\\V1\\Controllers\\ManagersController');
           $api->resource('region_woreda_city','App\\Api\\V1\\Controllers\\RegionWoredZoneCityController');
           $api->resource('district_areas','App\\Api\\V1\\Controllers\\DistrictControllingAreaController');
        });

        //admin routes
        $api->group(['prefix'=>'manager','middleware'=>'manager'],function (Router $api){
             $api->resource('technicians','App\\Api\\V1\\Controllers\\ManagersController');
             $api->resource('group_user','App\\Api\\V1\\Controllers\\GroupUserController');
             $api->resource('fault_group','App\\Api\\V1\\Controllers\\FaultGroupController');
         });

        $api->resource('groups','App\\Api\\V1\\Controllers\\GroupController');
        $api->resource('faults','App\\Api\\V1\\Controllers\\FaultController');
        $api->resource('fault_types','App\\Api\\V1\\Controllers\\FaultTypeController');

   });

   $api->get('accident_types','App\\Api\\V1\\Controllers\\FaultTypeController@index');
   $api->resource('accidents','App\\Api\\V1\\Controllers\\FaultController');
   $api->get('region_sub_city_woreda','App\\Api\\V1\\Controllers\\RegionWoredZoneCityController@index');
    $api->get('hello', function() {
        return response()->json([
            'message' => 'This is a simple example of item returned by your APIs. Everyone can see it.'
        ]);
    });
});
