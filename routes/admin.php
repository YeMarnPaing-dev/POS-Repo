<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\ProductExportController;


Route::group(['prefix'=>'admin','middleware'=>'adminmiddleware'], function(){
Route::get('dashboard',[AdminController::class,'dashboard'])->name('admin#dashboard');

Route::get('product/export', [ProductExportController::class, 'export'])->name('product.export');

Route::get('product/export-pdf', [ProductController::class, 'exportPdf'])->name('products.export.pdf');

Route::group(['prefix'=>'category'],function(){
    Route::get('list',[CategoryController::class,'list'])->name('category#list');
    Route::post('create',[CategoryController::class,'create'])->name('category#create');
    Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
    Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
    Route::post('update/{id}',[CategoryController::class,'update'])->name('category#update');

});
Route::group(['prefix'=>'product'],function(){
    Route::get('createPage',[ProductController::class,'createPage'])->name('product#createPage');
    Route::post('create',[ProductController::class,'create'])->name('product#create');
    Route::get('list/{action?}',[ProductController::class,'list'])->name('product#list');
    Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
    Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
    Route::post('update',[ProductController::class,'update'])->name('product#update');
    Route::get('detail/{id}',[ProductController::class,'detail'])->name('product#detail');

});

Route::group(['prefix'=>'profile'],function(){
Route::get('change/password',[ProfileController::class,'changePasswordPage'])->name('profile#changepasswordPage');
Route::post('change/password',[ProfileController::class,'changePassword'])->name('profile#changepassword');
Route::get('edit',[ProfileController::class,'profileEdit'])->name('profile#edit');
Route::post('update',[ProfileController::class,'profileUpdate'])->name('profile#Update');

});

Route::group(['middleware'=>'superAdminMiddleware'],function(){

Route::group(['prefix'=>'payment'],function(){
Route::get('createPayment/',[PaymentController::class,'payment'])->name('payment#admin');
Route::post('create',[PaymentController::class,'paymentCreate'])->name('payment#create');
Route::get('delete/{id}',[PaymentController::class,'paymentDelete'])->name('payment#delete');
Route::get('edit/{id}',[PaymentController::class,'paymentedit'])->name('payment#edit');
Route::post('update/{id}',[PaymentController::class,'paymentUpdate'])->name('payment#Update');

});

Route::group(['prefix'=>'account'],function(){
Route::get('create/newAdmin',[AdminController::class,'createAdminPage'])->name('account#newAccountPage');
Route::Post('create/newAdmin',[AdminController::class,'createAdmin'])->name('account#createAdmin');
Route::get('admin/list',[AdminController::class,'adminlist'])->name('account#adminlist');
Route::get('admin/delete/{id}',[AdminController::class,'admindelete'])->name('account#admindelete');
Route::get('user/list',[AdminController::class,'userlist'])->name('account#userlist');
Route::get('user/delete/{id}',[AdminController::class,'userDelete'])->name('account#userdelete');

});

Route::group(['prefix'=>'order'],function(){
    Route::get('list',[OrderController::class,'list'])->name('order#list');
     Route::get('product/{orderCode}',[OrderController::class,'product'])->name('order#product');
     Route::get('reject',[OrderController::class,'orderCode'])->name('order#Reject');
     Route::get('statusChange',[OrderController::class,'orderStatusChange'])->name('order#Status');
      Route::get('confirm',[OrderController::class,'orderConfirm'])->name('order#Confirm');
      Route::get('sale',[OrderController::class,'saleInformation'])->name('order#Sale');

});



});




});
