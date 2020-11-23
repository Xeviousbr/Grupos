<?php

Route::auth();

Route::any('frutas','GrupoController@Frutas');
Route::any('naepoca','GrupoController@NaEpoca');
Route::any('novafruta','GrupoController@NovaFruta');