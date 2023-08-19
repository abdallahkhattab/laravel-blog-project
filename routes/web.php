<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\dashboard\dashboardController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\TestemonialController;
use App\Models\TeamMember;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\showController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('dashboard')->name('dashboard.')->group(function(){
    Route::get('/',[dashboardController::class , 'index'])->name('index');
    //Articles
    Route::get('/articles',[ArticleController::class , 'index'])->name('layouts.articles.index');
    Route::post('/articles',[ArticleController::class , 'store'])->name('layouts.articles.index');
    Route::get('/fetch-articles',[ArticleController::class , 'fetchAll'])->name('layouts.fetchArticle.index');
    Route::get('/edit/{id}',[ArticleController::class , 'edit'])->name('layouts.edit.index');
    Route::post('/update', [ArticleController::class, 'update'])->name('layouts.update.index');
    Route::get('/update', [ArticleController::class, 'update'])->name('layouts.update.index');
    Route::post('/delete', [ArticleController::class, 'delete'])->name('layouts.delete.index');
    //features
    
   Route::get('/features',[FeatureController::class , 'index'])->name('layouts.features.index');
   Route::post('/features',[FeatureController::class , 'store'])->name('layouts.features.index');
   Route::get('/fetch-features',[FeatureController::class , 'fetchAll'])->name('layouts.fetchfeatures.index');
   Route::get('/editfeature/{id}',[FeatureController::class , 'edit'])->name('layouts.editfeature.index');
   Route::post('/updatefeature', [FeatureController::class, 'update'])->name('layouts.updatefeature.index');
   Route::get('/updatefeature', [FeatureController::class, 'update'])->name('layouts.updatefeature.index');
   Route::post('/deletefeature', [FeatureController::class, 'delete'])->name('layouts.deletefeature.index');

   //testemonial
   Route::get('/testemonial',[TestemonialController::class,'index'])->name('layouts.testemonial.index');
   Route::post('/testemonial',[TestemonialController::class , 'store'])->name('layouts.testemonial.index');
   Route::get('/fetch-testemonial',[TestemonialController::class , 'fetchAll'])->name('layouts.fetchtestemonial.index');
   Route::get('/edittestemonial/{id}',[TestemonialController::class , 'edit'])->name('layouts.edittestemonial.index');
   Route::post('/updatetestemonial', [TestemonialController::class, 'update'])->name('layouts.updatetestemonial.index');
   Route::get('/updatetestemonial', [TestemonialController::class, 'update'])->name('layouts.updatetestemonial.index');
   Route::post('/deletetestemonial', [TestemonialController::class, 'delete'])->name('layouts.deletetestemonial.index');



   //team member
   Route::get('/member',[MemberController::class,'index'])->name('layouts.member.index');
   Route::post('/member',[MemberController::class,'store'])->name('layouts.member.store');
   Route::get('/fetch-member',[MemberController::class , 'fetchAll'])->name('layouts.fetchtemember.fetchall');
   Route::get('/editemember/{id}',[MemberController::class,'edit'])->name('layouts.member.update');
   Route::post('updatemember',[MemberController::class,'update'])->name('layouts.member.updatemember');
   Route::get('updatemember',[MemberController::class,'update'])->name('layouts.member.updatemember');
   Route::post('deletemember',[MemberController::class,'delete'])->name('layouts.member.delete');
   


   //services
   Route::get('/service',[ServiceController::class,'index'])->name('layouts.service.index');
   Route::post('/service',[ServiceController::class , 'store'])->name('layouts.service.index');
   Route::get('/fetch-service',[ServiceController::class,'fetchall'])->name('layouts.service.fetch');
   Route::get('/editservice/{id}',[ServiceController::class,'edit'])->name('layouts.service.update');
   Route::post('/updateservice',[ServiceController::class,'update'])->name('layouts.service.updateservice');
   Route::get('/updateservice',[ServiceController::class,'update'])->name('layouts.service.updateservice');
   Route::post('deleteservice',[ServiceController::class,'delete'])->name('layouts.service.delete');


   //plan

   Route::get('/plan',[PlanController::class,'index'])->name('layouts.plan.index');
   Route::post('/plan',[PlanController::class,'store'])->name('layouts.plan.store');
   Route::get('/fetch-plan',[PlanController::class,'fetchall'])->name('layouts.plan.fetch');  
   Route::get('/editeplan/{id}',[PlanController::class,'edit'])->name('layouts.plan.update');
   Route::post('/updateplan',[PlanController::class,'update'])->name('layouts.plan.updateplan');
   Route::get('/updateplan',[PlanController::class,'update'])->name('layouts.plan.updateplan');
   Route::post('/deleteplan',[PlanController::class,'delete'])->name('layouts.plan.delete');

   //blog

    });

    Route::get('/blog',[BlogController::class,'index'])->name('layouts.blog.index');
    Route::post('/form1',[BlogController::class,'form1submit'])->name('form1');
