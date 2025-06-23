<?php

use Illuminate\Support\Facades\Route;

Route::get('/graphql-playground', function () {
    return view('graphql-playground');
});