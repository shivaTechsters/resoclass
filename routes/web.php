<?php

use App\Events\Web\Registred;
use App\Http\Controllers\Web\RegistrationController;
use App\Mail\Web\SendRegistrationMail;
use App\Models\Registration;
use App\Models\ShortLink;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Barryvdh\DomPDF\Facade\Pdf;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/artisan/optimize', function () {
    Artisan::call('optimize:clear');
    dd('Application optimized');
});

Route::get('/artisan/migrate', function () {
    Artisan::call('migrate');
    dd('Database migrated');
});
Route::get('/artisan/seed', function () {
    Artisan::call('db:seed');
    dd('Database seeded');
});

Route::get('/storage/link', function () {
    Artisan::call('storage:link');
    dd('Storage Linked');
});

Route::get('/', [RegistrationController::class, 'viewRegister'])->name('web.view.register');
Route::post('/register', [RegistrationController::class, 'handleRegister'])->name('web.handle.register');
Route::get('/thank-you/{id}/{date_of_birth}', [RegistrationController::class, 'viewThankYou'])->name('web.view.thankyou');

Route::get('/test', function() {
    
    $registration = Registration::first();

    $pdf = Pdf::loadView('web.admit-card', [
        'registration' => $registration
    ]);

    return $pdf->stream();

    // // Mail::to($registration->email)->send(new SendRegistrationMail($registration));

    // return view('web.registration-mail',[
    //     'registration' => $registration
    // ]);

});

Route::get('/ln/{token}', function ($token) {
    $short_link = ShortLink::where('token', $token)->first();
    if (is_null($short_link)) {
        return abort(404);
    }
    return redirect($short_link->url);
})->name('web.view.shortlink');
