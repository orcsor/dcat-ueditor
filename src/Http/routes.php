<?php

use Orcsor\DcatUeditor\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::any('/ueditor/serve', Controllers\DcatUeditorController::class . '@index');
