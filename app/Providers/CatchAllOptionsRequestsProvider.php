<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * If the incoming request is an OPTIONS request
 * we will register a handler for the requested route
 */
class CatchAllOptionsRequestsProvider extends ServiceProvider {

  public function register()
  {
    $request = app('request');

    if ($request->isMethod('OPTIONS'))
    {
        app()->options($request->path(), function() { return response('', 200, [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Authorization'
        ]
        ); });
    }
  }

}
