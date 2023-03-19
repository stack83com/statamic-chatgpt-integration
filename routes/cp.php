<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stack83\StatamicChatGPT\Http\Controllers\ChatController;

Route::group(['prefix' => 'api'], static function (){
    Route::any('chat', [ChatController::class, 'complete']);
});

