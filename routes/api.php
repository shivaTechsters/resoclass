<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\ContactEnquiryController;
use App\Http\Controllers\API\NewsletterEmailController;
use App\Http\Controllers\API\ServiceQuoteController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\TestimonialController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Web\RegistrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/send-verification-otp', [RegistrationController::class, 'handleSendVerificationOTP'])->name('web.handle.send.otp');

Route::middleware('auth:sanctum')->group(function () {

    
});