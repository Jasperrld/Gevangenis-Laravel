<?php

use App\Http\Controllers\Admin\CellController;
use App\Http\Controllers\Admin\HistorieController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\PrisonCaseController;
use App\Http\Controllers\Admin\PrisonerController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VisitController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\ProfileController;
use App\Models\PrisonCase;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('open.home');
})->name('home');

Route::get('/bezoekregeling', function () {
    return view('open.bezoekregeling');
});

Route::get('/historie', function () {
    return view('open.historie');
});

Route::get('/arrestantencomplex', function () {
    return view('open.arrestantencomplex');
});

Route::get('/kijkjeincel', function () {
    return view('open.kijkjeincel');
});

Route::get('/login', function () {
    return view('open.login');
});

// Routes that require authentication
Route::middleware(['auth'])->group(function () {

    // PrisonerController
    // Route::group(['middleware' => ['role:maatschappelijkwerker|portier|opnameofficier|admin']], function () {
            Route::delete('/admin/prisoners/{prisoner}', [PrisonerController::class, 'destroy'])
            ->middleware('permission:delete prisoner')
            ->name('prisoners.destroy');

            Route::get('/admin/prisoners/{prisoner}/delete', [PrisonerController::class, 'delete'])
                ->middleware('permission:delete prisoner')
                ->name('prisoners.delete');

            Route::get('/admin/prisoners', [PrisonerController::class, 'index'])
            ->middleware('permission:index prisoner')
            ->name('prisoners.index');

            Route::get('/admin/prisoners/location/{location}', [PrisonerController::class, 'filterByLocation'])->name('prisoners.filterByLocation');


            Route::get('/admin/prisoners/create', [PrisonerController::class, 'create'])
            ->middleware('permission:create prisoner')
            ->name('prisoners.create');

        Route::post('/admin/prisoners', [PrisonerController::class, 'store'])
            ->middleware('permission:create prisoner')
            ->name('prisoners.store');

        Route::get('/admin/prisoners/{prisoner}', [PrisonerController::class, 'show'])
            ->middleware('permission:show prisoner')
            ->name('prisoners.show');


        Route::get('/admin/prisoners/{prisoner}/edit', [PrisonerController::class, 'edit'])
        ->middleware('permission:edit prisoner')
        ->name('prisoners.edit');

        Route::put('/admin/prisoners/{prisoner}', [PrisonerController::class, 'update'])
            ->middleware('permission:edit prisoner')
            ->name('prisoners.update');

        Route::get('/prisoners/{prisoner}/transfer', [PrisonerController::class, 'transferToHistorie'])
        ->name('prisoners.transfer');

    // });



      // CellController

      Route::get('/admin/cells', [CellController::class, 'index'])->name('cells.index')
      ->middleware('permission:index cell');

      Route::get('/admin/cells/create', [CellController::class, 'create'])->name('cells.create')
      ->middleware('permission:create cell');

      Route::post('/admin/cells', [CellController::class, 'store'])->name('cells.store')
      ->middleware('permission:create cell');

      Route::get('/admin/cells/{cell}/edit', [CellController::class, 'edit'])->name('cells.edit')
      ->middleware('permission:edit cell');

      Route::put('/admin/cells/{cell}', [CellController::class, 'update'])->name('cells.update')
      ->middleware('permission:edit cell');

      Route::delete('/admin/cells/{cell}', [CellController::class, 'destroy'])->name('cells.destroy')
      ->middleware('permission:delete cell');


      Route::get('/admin/cells/{cell}', [CellController::class, 'show'])
      ->middleware('permission:show cell')
      ->name('cells.show');


        Route::get('/admin/cells/location/{location}', [CellController::class, 'filterByLocation'])
        ->name('cells.filterByLocation');

    // EIND CELL CONTROLLER





    // VISITORS CONTROLLER ROUTES

    Route::get('/admin/visitors', [VisitorController::class, 'index'])
    ->middleware('permission:index visitor')
    ->name('visitors.index');

    Route::get('/admin/visitors/create', [VisitorController::class, 'create'])
    ->middleware('permission:create visitor')
    ->name('visitors.create');

    Route::post('/admin/visitors', [VisitorController::class, 'store'])
    ->middleware('permission:create visitor')
    ->name('visitors.store');

    Route::get('/admin/visitors/{visitor}/edit', [VisitorController::class, 'edit'])
    ->middleware('permission:edit visitor')
    ->name('visitors.edit');

    Route::put('/admin/visitors/{visitor}', [VisitorController::class, 'update'])
    ->middleware('permission:edit visitor')
        ->name('visitors.update');

    Route::delete('/admin/visitors/{visitor}', [VisitorController::class, 'destroy'])
    ->middleware('permission:delete visitor')
    ->name('visitors.destroy');

    Route::get('/admin/visitors/{visitor}/delete', [VisitorController::class, 'delete'])
    ->middleware('permission:delete visitor')
        ->name('visitors.delete');

    Route::get('/admin/visitors/{visitor}', [VisitorController::class, 'show'])
    ->middleware('permission:show visitor')
    ->name('visitors.show');

    Route::get('/admin/visitors/location/{location}', [VisitorController::class, 'filterByLocation'])
    ->name('visitors.filterByLocation');


      // END VISITORS CONTROLLER ROUTES

    // VISITS CONTROLLER ROUTES

    Route::get('/admin/visits', [VisitController::class, 'index'])
    ->middleware('permission:index visit')
    ->name('visits.index');

    Route::get('/admin/visits/create', [VisitController::class, 'create'])
    ->middleware('permission:create visit')
    ->name('visits.create');

    Route::post('/admin/visits', [VisitController::class, 'store'])
    ->middleware('permission:create visit')
    ->name('visits.store');

    Route::get('/admin/visits/{visit}/edit', [VisitController::class, 'edit'])
    ->middleware('permission:edit visit')
    ->name('visits.edit');

    Route::put('/admin/visits/{visit}', [VisitController::class, 'update'])
    ->middleware('permission:edit visit')
        ->name('visits.update');

    Route::delete('/admin/visits/{visit}', [VisitController::class, 'destroy'])
    ->middleware('permission:delete visit')
    ->name('visits.destroy');

    Route::get('/admin/visits/{visit}/delete', [VisitController::class, 'delete'])
    ->middleware('permission:delete visit')
        ->name('visits.delete');

    Route::get('/admin/visits/{visit}', [VisitController::class, 'show'])
    ->middleware('permission:show visit')
    ->name('visits.show');

    Route::get('/admin/visits/location/{location}', [VisitController::class, 'filterByLocation'])
    ->name('visits.filterByLocation');
    // END VISITS CONTROLLER ROUTES

    // LOG CONTROLLER ROUTES

    Route::get('/admin/logs', [LogController::class, 'index'])->name('logs.index')
    ->middleware('permission:index log');

    Route::get('/admin/logs/{log}', [LogController::class, 'show'])->name('logs.show')
    ->middleware('permission:show log');



    // END LOG CONTROLLER ROUTES

    // LOCATION CONTROLLER ROUTES
    Route::get('/admin/locations', [LocationController::class, 'index'])->name('locations.index')
    ->middleware('permission:index location');

    Route::get('/admin/locations/create', [LocationController::class, 'create'])->name('locations.create')
    ->middleware('permission:create location');

    Route::post('/admin/locations', [LocationController::class, 'store'])->name('locations.store')
    ->middleware('permission:create location');

    Route::get('/admin/locations/{location}/edit', [LocationController::class, 'edit'])->name('locations.edit')
    ->middleware('permission:edit location');

    Route::put('/admin/locations/{location}', [LocationController::class, 'update'])->name('locations.update')
    ->middleware('permission:edit location');

    Route::delete('/admin/locations/{location}', [LocationController::class, 'destroy'])->name('locations.destroy')
    ->middleware('permission:delete location');

    Route::get('locations/{location}/confirm-delete', [LocationController::class, 'confirmDelete'])->name('locations.confirmDelete')
    ->middleware('permission:delete location');




    // END LOCATION CONTROLLER ROUTES

     // Admin panel
     Route::group(['middleware' => ['role:admin']], function () {

        Route::get('/admin/panel', function () {
            return view('admin.adminpanel.indexpanel');
        })->name('adminpanel.index');

    });

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/admin/panel/roles', [RoleController::class, 'index'])->name('admin.roles.index');
        Route::get('/admin/panel/roles/create', [RoleController::class, 'create'])->name('admin.roles.create');
        Route::post('/admin/panel/roles/store', [RoleController::class, 'store'])->name('admin.roles.store');
        Route::get('/admin/panel/roles/{role}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');
        Route::get('/admin/panel/roles/{role}', [RoleController::class, 'show'])->name('admin.adminpanel.roles.show');
        Route::put('/admin/panel/roles/{role}/update', [RoleController::class, 'update'])->name('admin.roles.update');
        Route::delete('/admin/panel/roles/{role}/destroy', [RoleController::class, 'destroy'])->name('admin.roles.destroy');
    });


    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/admin/panel/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/admin/panel/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/admin/panel/users/store', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/admin/panel/users/{user}', [UserController::class, 'show'])->name('admin.adminpanel.users.show');
        Route::get('/admin/panel/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/admin/panel/users/{user}/update', [UserController::class, 'update'])->name('admin.users.update');
    });




       // PrisonCaseController

        //    Route::get('prisoncases/{prisonCase}/delete', [PrisonCaseController::class, 'delete'])
        //    ->name('prisoncases.delete');


        // Route::resource('/admin/prisoncases', PrisonCaseController::class);


    // END PRISONCASECONTROLLER


     // PrisonCaseController

          // Custom route for deleting a specific prison case
          Route::get('/admin/prisoncases/{prisonCase}/delete', [PrisonCaseController::class, 'delete'])
          ->middleware('permission:delete prisoncase')
          ->name('prisoncases.delete');

          // Resourceful routes for managing prison cases
          Route::get('/admin/prisoncases', [PrisonCaseController::class, 'index'])
          ->middleware('permission:index prisoncase')
          ->name('prisoncases.index');

          Route::get('/admin/prisoncases/create', [PrisonCaseController::class, 'create'])
          ->middleware('permission:create prisoncase')
          ->name('prisoncases.create');

          Route::post('/admin/prisoncases', [PrisonCaseController::class, 'store'])
          ->middleware('permission:create prisoncase')
          ->name('prisoncases.store');

          Route::get('/admin/prisoncases/{prisonCase}/edit', [PrisonCaseController::class, 'edit'])
          ->middleware('permission:edit prisoncase')
          ->name('prisoncases.edit');

          Route::put('/admin/prisoncases/{prisonCase}', [PrisonCaseController::class, 'update'])
          ->middleware('permission:edit prisoncase')
          ->name('prisoncases.update');


          Route::delete('/admin/prisoncases/{prisonCase}', [PrisonCaseController::class, 'destroy'])
          ->middleware('permission:delete prisoncase')
          ->name('prisoncases.destroy');

          Route::get('/admin/prisoncases/{prisoncase}', [PrisonCaseController::class, 'show'])
          ->middleware('permission:show prisoncase')
          ->name('prisoncases.show');

          Route::get('/admin/prisoncases/location/{location}', [PrisonCaseController::class, 'filterByLocation'])
            ->name('prisoncases.filterByLocation');

  // END PRISONCASECONTROLLER

    // Routes that require email verification
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // Profile management routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


    // HISTORIE ROUTES WEB

    Route::get('/admin/histories', [HistorieController::class, 'index'])
    ->middleware('permission:index historie')
    ->name('histories.index');

Route::get('/admin/histories/create', [HistorieController::class, 'create'])
    ->middleware('permission:create historie')
    ->name('histories.create');

Route::post('/admin/histories', [HistorieController::class, 'store'])
    ->middleware('permission:create historie')
    ->name('histories.store');

Route::get('/admin/histories/{historie}', [HistorieController::class, 'show'])
    ->middleware('permission:show historie')
    ->name('histories.show');

Route::get('/admin/histories/{historie}/edit', [HistorieController::class, 'edit'])
    ->middleware('permission:edit historie')
    ->name('histories.edit');

Route::put('/admin/histories/{historie}', [HistorieController::class, 'update'])
    ->middleware('permission:edit historie')
    ->name('histories.update');

Route::delete('/admin/histories/{historie}', [HistorieController::class, 'destroy'])
    ->middleware('permission:delete historie')
    ->name('histories.destroy');

Route::get('/admin/histories/{historie}/delete', [HistorieController::class, 'delete'])
    ->middleware('permission:delete historie')
    ->name('histories.delete');

Route::get('/admin/histories/location/{location}', [HistorieController::class, 'filterByLocation'])
    ->name('histories.filterByLocation');

    // END HISTORIE ROUTES

require __DIR__.'/auth.php';
