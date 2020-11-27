<?php

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::get('/', ['as' => 'acceuil', 'uses' => 'front\FrontController@index']);
Route::get('presentation',['as' => 'presentation', 'uses' => 'front\FrontController@presentation']);
Route::get('info_telecom',['as' => 'info_telecom', 'uses' => 'front\FrontController@info_telecom']);
Route::get('securite_electronique',['as' => 'securite_electronique', 'uses' => 'front\FrontController@securite_electronique']);
Route::get('electricite_batiment',['as' => 'electricite_batiment', 'uses' => 'front\FrontController@electricite_batiment']);
Route::get('fibre_optique',['as' => 'fibre_optique', 'uses' => 'front\FrontController@fibre_optique']);
Route::get('etude_assistance',['as' => 'etude_assistance', 'uses' => 'front\FrontController@etude_assistance']);
Route::get('contact',['as' => 'contact', 'uses' => 'front\FrontController@contact']);

Route::get('blog',['as' => 'blog', 'uses' => 'front\FrontController@blog']);
Route::get('article/{id}',['as' => 'article', 'uses' => 'front\FrontController@article']);

Route::post('send_contact',['as' => 'send_contact' , 'uses' => 'front\FrontController@send_contact']);







Route::group(['middleware' => ['authorized']], function () {

    /* users */
    Route::get('users', 'back\UserController@index')->name('user.index');
    Route::get('users/create', 'back\UserController@create')->name('user.create');
    Route::post('users/store', 'back\UserController@store')->name('user.store');
    Route::get('users/edit/{id}', 'back\UserController@edit')->name('user.edit');
    Route::get('users/delete/{id}', 'back\UserController@delete')->name('user.delete');
    Route::post('users/update/{id}', 'back\UserController@update')->name('user.update') ;
   // Route::get('/users/delete/{id}', 'UserController@destroy')->name('user.delete') ;
    //Route::get('/users/disable/{id}', 'UserController@disable')->name('user.disable') ;

      /* tache */
    Route::get('taches', 'back\TacheController@index')->name('tache.index');
    Route::get('taches/create', 'back\TacheController@create')->name('tache.create');
    Route::post('taches/store', 'back\TacheController@store')->name('tache.store');
    Route::get('taches/edit/{id}', 'back\TacheController@edit')->name('tache.edit');
    Route::get('taches/show/{id}', 'back\TacheController@show')->name('tache.show');
    Route::get('taches/valider/{id}', 'back\TacheController@valider')->name('tache.valider');
    Route::get('taches/reopen/{id}', 'back\TacheController@reopen')->name('tache.reopen');
    Route::post('taches/update/{id}', 'back\TacheController@update')->name('tache.update') ;

    /* Project */
    Route::get('projects', 'back\ProjectController@index')->name('project.index');
    Route::get('projects/create', 'back\ProjectController@create')->name('project.create');
    Route::post('projects/store', 'back\ProjectController@store')->name('project.store');
    Route::get('projects/edit/{id}', 'back\ProjectController@edit')->name('project.edit');
    Route::post('projects/update/{id}', 'back\ProjectController@update')->name('project.update') ;
    Route::get('projects/show/{id}', 'back\ProjectController@show')->name('project.show');


    /* Tasks */
    Route::get('tasks', 'back\TaskController@index')->name('task.index');
    Route::get('tasks/create/{id}', 'back\TaskController@create')->name('task.create');
    Route::post('tasks/store/{id}', 'back\TaskController@store')->name('task.store');
    Route::get('tasks/edit/{id}', 'back\TaskController@edit')->name('task.edit');
    Route::post('tasks/update/{id}', 'back\TaskController@update')->name('task.update');
    Route::get('tasks/show/{id}', 'back\TaskController@show')->name('task.show');
    Route::get('tasks/start/{id}', 'back\TaskController@start')->name('task.start') ;
    Route::post('tasks/stop/{id}', 'back\TaskController@stop')->name('task.stop') ;
    Route::get('tasks/pause/{id}', 'back\TaskController@pause')->name('task.pause') ;
    Route::post('tasks/valider/{id}', 'back\TaskController@valider')->name('task.valider') ;
    Route::post('tasks/reopen/{id}', 'back\TaskController@reopen')->name('task.reopen') ;

    /* SubTasks */
    Route::get('subtasks/create/{id}', 'back\SubtaskController@create')->name('subtask.create');
    Route::post('subtasks/store/{id}', 'back\SubtaskController@store')->name('subtask.store');
    Route::get('subtasks/edit/{id}', 'back\SubtaskController@edit')->name('subtask.edit');
    Route::post('subtasks/update/{id}', 'back\SubtaskController@update')->name('subtask.update');
    Route::get('subtasks/show/{id}', 'back\SubtaskController@show')->name('subtask.show');
    Route::get('subtasks/start/{id}', 'back\SubtaskController@start')->name('subtask.start') ;
    Route::post('subtasks/stop/{id}', 'back\SubtaskController@stop')->name('subtask.stop') ;
    Route::get('subtasks/pause/{id}', 'back\SubtaskController@pause')->name('subtask.pause') ;
    Route::post('subtasks/valider/{id}', 'back\SubtaskController@valider')->name('subtask.valider') ;
    Route::post('subtasks/reopen/{id}', 'back\SubtaskController@reopen')->name('subtask.reopen') ;


    /* Intervention */
    Route::get('interventions', 'back\InterventionController@index')->name('intervention.index');
    Route::get('interventions/create', 'back\InterventionController@create')->name('intervention.create');
    Route::post('interventions/store', 'back\InterventionController@store')->name('intervention.store');
    Route::get('interventions/edit/{id}', 'back\InterventionController@edit')->name('intervention.edit');
    Route::post('interventions/update/{id}', 'back\InterventionController@update')->name('intervention.update') ;
    Route::get('interventions/show/{id}', 'back\InterventionController@show')->name('intervention.show');
    Route::get('interventions/start/{id}', 'back\InterventionController@start')->name('intervention.start') ;
    Route::post('interventions/stop/{id}', 'back\InterventionController@stop')->name('intervention.stop') ;
    Route::get('interventions/pause/{id}', 'back\InterventionController@pause')->name('intervention.pause') ;
    Route::post('interventions/valider/{id}', 'back\InterventionController@valider')->name('intervention.valider') ;
    Route::post('interventions/reopen/{id}', 'back\InterventionController@reopen')->name('intervention.reopen') ;

    /* PDF reader */
    Route::get('readPDF/{id}', 'back\InterventionController@readPDF')->name('readPDF');

    /* Blog */
    Route::get('blogs', 'back\BlogController@index')->name('blog.index');
    Route::get('blogs/create', 'back\BlogController@create')->name('blog.create');
    Route::post('blogs/store', 'back\BlogController@store')->name('blog.store');
    Route::get('blogs/edit/{id}', 'back\BlogController@edit')->name('blog.edit');
    Route::post('blogs/update/{id}', 'back\BlogController@update')->name('blog.update') ;
    Route::get('blogs/show/{id}', 'back\BlogController@show')->name('blog.show');

    /*stock*/
    Route::get('stocks', 'back\StockController@index')->name('stock.index');
    Route::get('stocks/create', 'back\StockController@create')->name('stock.create');
    Route::post('stocks/store', 'back\StockController@store')->name('stock.store');
    Route::get('stocks/edit/{id}', 'back\StockController@edit')->name('stock.edit');
    Route::post('stocks/update/{id}', 'back\StockController@update')->name('stock.update');
    Route::get('stocks/consommer/{id}', 'back\StockController@consommer')->name('stock.consommer');
    Route::post('stocks/storeconsommation/{id}', 'back\StockController@storeconsommation')->name('stock.storeconsommation');
    Route::get('stock/createtype','back\StockController@createtype')->name('stock.createtype');

    Route::get('fournisseurs', 'back\FournisseurController@index')->name('fournisseur.index');
    Route::get('fournisseurs/create', 'back\FournisseurController@create')->name('fournisseur.create');
    Route::post('fournisseurs/store', 'back\FournisseurController@store')->name('fournisseur.store');

    Route::get('articles', 'back\ArticleController@index')->name('article.index');
    Route::get('articles/create', 'back\ArticleController@create')->name('article.create');
    Route::post('articles/store', 'back\ArticleController@store')->name('article.store');


});




