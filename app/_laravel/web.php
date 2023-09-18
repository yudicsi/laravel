<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\db;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

use App\_laravel\Controllers\customer_Ctrl;
use App\_laravel\Controllers\m_customer_Ctrl;
use App\_laravel\Controllers\Kelas_Ctrl;
use App\_laravel\Controllers\matpel_Ctrl;
use App\_laravel\Controllers\Guru_Ctrl;
use App\_laravel\Controllers\kurikulum_Ctrl;


Route::get('kelas', [Kelas_Ctrl::class, 'index']);
Route::get('kelas-1', [Kelas_Ctrl::class, 'index']);
Route::post('store-kelas', [Kelas_Ctrl::class, 'store']);
Route::post('update-kelas', [Kelas_Ctrl::class, 'update']);
Route::post('edit-kelas', [Kelas_Ctrl::class, 'edit']);
Route::post('delete-kelas', [Kelas_Ctrl::class, 'destroy']);

Route::get('customer', [customer_Ctrl::class, 'index']);
Route::get('customer-1', [customer_Ctrl::class, 'index']);
Route::post('store-customer', [customer_Ctrl::class, 'store']);
Route::post('update-customer', [customer_Ctrl::class, 'update']);
Route::post('edit-customer', [customer_Ctrl::class, 'edit']);
Route::post('delete-customer', [customer_Ctrl::class, 'destroy']);

Route::get('m_customer', [m_customer_Ctrl::class, 'index']);
Route::get('m_customer-1', [m_customer_Ctrl::class, 'index']);
Route::post('store-m_customer', [m_customer_Ctrl::class, 'store']);
Route::post('update-m_customer', [m_customer_Ctrl::class, 'update']);
Route::post('edit-m_customer', [m_customer_Ctrl::class, 'edit']);
Route::post('delete-m_customer', [m_customer_Ctrl::class, 'destroy']);

Route::get('guru', [Guru_Ctrl::class, 'index']);
Route::get('guru-1', [Guru_Ctrl::class, 'index']);
Route::post('store-guru', [Guru_Ctrl::class, 'store']);
Route::post('update-guru', [Guru_Ctrl::class, 'update']);
Route::post('edit-guru', [Guru_Ctrl::class, 'edit']);
Route::post('delete-guru', [Guru_Ctrl::class, 'destroy']);
Route::post('Matpel_del_guru', [Guru_Ctrl::class, 'Matpel_del']);
Route::post('Matpel_add_guru', [Guru_Ctrl::class, 'Matpel_add']);

Route::get('kurikulum', [kurikulum_Ctrl::class, 'index']);
Route::get('kurikulum-1', [kurikulum_Ctrl::class, 'index']);
Route::post('store-kurikulum', [kurikulum_Ctrl::class, 'store']);
Route::post('update-kurikulum', [kurikulum_Ctrl::class, 'update']);
Route::post('edit-kurikulum', [kurikulum_Ctrl::class, 'edit']);
Route::post('delete-kurikulum', [kurikulum_Ctrl::class, 'destroy']);
Route::post('Matpel_del_kurikulum', [kurikulum_Ctrl::class, 'Matpel_del']);
Route::post('Matpel_add_kurikulum', [kurikulum_Ctrl::class, 'Matpel_add']);


Route::get('matpel-1', [matpel_Ctrl::class, 'index']);
Route::get('matpel', [matpel_Ctrl::class, 'index']);
Route::get('matpel-2', [matpel_Ctrl::class, 'xxx']);
Route::post('store-matpel', [matpel_Ctrl::class, 'store']);
Route::post('update-matpel', [matpel_Ctrl::class, 'update']);
Route::post('edit-matpel', [matpel_Ctrl::class, 'edit']);
Route::post('delete-matpel', [matpel_Ctrl::class, 'destroy']);

