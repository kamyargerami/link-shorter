<?php

use Pecee\SimpleRouter\SimpleRouter;


SimpleRouter::group(['namespace' => 'Api\V1', 'prefix' => '/api/v1/'], function () {
    SimpleRouter::get('ping', 'HealthController@ping');

    SimpleRouter::get('all', 'LinkController@all');
    SimpleRouter::post('short', 'LinkController@short');

});