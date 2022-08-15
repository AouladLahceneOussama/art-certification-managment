<?php

use Illuminate\Routing\Router;
use App\Models\Administrator;

Admin::routes();
Route::resource("/admin/auth/users",App\Admin\Controllers\AdministratorController::class)->middleware(config('admin.route.middleware'));
Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('administrators', AdministratorController::class);
    $router->resource('/works/paintings', TableauController::class);
    $router->resource('/works/sculptures', SculptureController::class);
    $router->resource('/works/lithographies', LitoController::class);
    $router->resource('demands', DemandeController::class);
    $router->resource('recherches', RchercheParCodeController::class);
    $router->resource('certificats', CertificatController::class);
    $router->resource('media/tableaux', TableauxMediaController::class);
    $router->resource('media/sculptures', SculptureMediaController::class);
    $router->resource('media/lithographies', LithographMediaController::class);
    $router->resource('/abonnements', AbonnementController::class);
    $router->resource('messages', MessagesController::class);
    $router->get('/{artist}/abonnement',function($artist){
        $artist = Administrator::where('username','=',$artist)->first();
        return view('paiement',['artist' => $artist]);
    });
});
