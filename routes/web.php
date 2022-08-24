<?php
//-----------------------------------------------------------------
//| Web Routes
//|--------------------------------------------------------------------------
//|
//| Here is where
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PageController;
/*
|--------- you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//PAGE CONTROLLER
Route::get('/', [PageController::class, 'welcome'])->name('welcome');
Route::get('/ebook', [PageController::class, 'ebook'])->name('ebook');
Route::get('/ebook/thanks', [PageController::class, 'ebookthankyou'])->name('ebookThanks');
Route::get('/terms-and-conditions', [PageController::class, 'terms_and_conditions'])->name('terms-and-conditions');
Route::get('/ccpa', [PageController::class, 'ccpa'])->name('ccpa');
Route::get('/donotsell', [PageController::class, 'donotsell'])->name('donotsell');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/thankyou', [PageController::class, 'thankyou'])->name('thankyou');

Route::post('/post', [PageController::class, 'post'])->name('post');

Route::get('/admin/leads/2ansdf8mfd7d6fn8s67fnd', [PageController::class, 'leads'])->name('leads');

Route::get('/1', [PageController::class, 'prepaidFuneral'])->name('prepaid-funeral');
Route::post('/1/funeral-post', [PageController::class, 'funeralPost'])->name('funeral-post');

Route::get('/1/confirm', [PageController::class, 'prepaidFuneralConfirm'])->name('prepaid-funeral-confirm');

Route::get('/1/confirm-info', [PageController::class, 'funeralConfirmInfo'])->name('funeral-confirm-info');
Route::post('/1/funeral-info-post', [PageController::class, 'funeralConfirmInfoPost'])->name('funeral-info-post');

Route::get('/1/confirm-info-step2', [PageController::class, 'funeralConfirmInfoStep2'])->name('funeral-confirm-info-step2');
Route::post('/1/funeral-info-step2-post', [PageController::class, 'funeralConfirmInfoStep2Post'])->name('funeral-info-step2-post');

Route::get('/1/confirm-info-step3', [PageController::class, 'funeralConfirmInfoStep3'])->name('funeral-confirm-info-step3');
Route::post('/1/funeral-info-step3-post', [PageController::class, 'funeralConfirmInfoStep3Post'])->name('funeral-info-step3-post');


Route::get('/1/congratulations', [PageController::class, 'funeralThankyou'])->name('funeral-thankyou');



// new for url 2

Route::get('/2', [PageController::class, 'prepaidFuneral2'])->name('prepaid-funeral2');
Route::post('/2/funeral-post', [PageController::class, 'funeralPost2'])->name('funeral-post2');

//Route::get('/2/confirm', [PageController::class, 'prepaidFuneralConfirm'])->name('prepaid-funeral-confirm');

Route::get('/2/confirm-info', [PageController::class, 'funeralConfirmInfo2'])->name('funeral-confirm-info2');
Route::post('/2/funeral-info-post', [PageController::class, 'funeralConfirmInfo2Post'])->name('funeral-info-post2');

Route::get('/2/confirm-info-step2', [PageController::class, 'funeralConfirmInfo2Step2'])->name('funeral-confirm-info2-step2');
Route::post('/2/funeral-info-step2-post', [PageController::class, 'funeralConfirmInfo2Step2Post'])->name('funeral-info2-step2-post');

Route::get('/2/confirm-info-step3', [PageController::class, 'funeralConfirmInfo2Step3'])->name('funeral-confirm-info2-step3');
Route::post('/2/funeral-info-step3-post', [PageController::class, 'funeralConfirmInfo2Step3Post'])->name('funeral-info2-step3-post');


Route::get('/2/congratulations', [PageController::class, 'funeral2Thankyou'])->name('funeral2-thankyou');



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
