<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// email認証を有効にする
Auth::routes(['verify' => true]);

// トップページ
Route::get('/', 'StepsController@top')->name('top');
// ステップ一覧ページ
Route::get('/index', 'StepsController@index')->name('index');
// ステップ一覧ページを表示するためのajaxリクエストを受け取る
Route::get('/index/ajax', 'StepsController@indexAjax')->name('indexAjax');
// ステップ詳細ページ
Route::get('/steps', 'StepsController@detail')->name('detail');
// ステップ詳細ページを表示するためのajaxリクエストを受け取る
Route::get('/steps/ajax', 'ChildStepsController@detailAjax')->name('detalAjax');
// ログアウトさせる
Route::get('/logout', 'UsersController@logout')->name('logout');

// 以下はemail認証されたユーザーのみ表示させる
Route::middleware(['verified'])
    ->group(function() {
        // マイページ
        Route::get('/mypage', 'UsersController@mypage')->name('mypage');
        // プロフィール編集ページ
        Route::get('/mypage/prof-edit', 'UsersController@profEdit')->name('profEdit');
        // プロフィール編集のリクエストを受け取る
        Route::post('/mypage/prof-edit/update', 'UsersController@profUpdate')->name('profUpdate');
        // マイページで自分が登録したステップを表示するためのajaxリクエストを受け取る
        Route::get('/mypage/my-step', 'StepsController@myStep')->name('my-step');
        // マイページで自分が挑戦中のステップを表示するためのajaxリクエストを受け取る
        Route::get('/mypage/challenge-step', 'ChallengeController@challengeStep')->name('challenge-step');

        // チャレンジページ
        Route::get('/steps/challenge', 'ChallengeController@challenge')->name('challenge');
        // チャレンジページを表示するためのajaxリクエストを受け取る
        Route::get('/steps/challenge/ajax', 'ChallengeController@challengeAjax')->name('challengeAjax');
        // 子ステップをクリアするリクエストを受け取る
        Route::get('/steps/challenge/clear', 'ChallengeController@clear')->name('clear');
        // 子ステップの進捗をリセットするリクエストを受け取る
        Route::get('/steps/challenge/reset', 'ChallengeController@reset')->name('reset');

        // ステップ作成ページ
        Route::get('/steps/new', 'StepsController@new')->name('new');
        // ステップ作成のリクエストを受け取る
        Route::post('/steps/create', 'StepsController@create')->name('create');
        // 子ステップ作成ページ
        Route::get('/steps/new-child', 'ChildStepsController@new')->name('newChild');
        // 子ステップ作成のリクエストを受け取る
        Route::post('/steps/create-child', 'ChildStepsController@create')->name('createChild');

        // 編集するステップを選択するページ
        Route::get('/choice', 'StepsController@choice')->name('choice');
        // 編集するステップを選択する際に、自分の登録したステップを表示するためのajaxリクエストを受け取る
        Route::get('/edit/ajax', 'ChildStepsController@editAjax')->name('editAjax');
        // ステップを編集するページ
        Route::get('/edit', 'StepsController@edit')->name('edit');
        // ステップ編集のリクエストを受け取る
        Route::post('/edit/update', 'StepsController@update')->name('update');
        // 子ステップを編集するページ
        Route::get('/edit-child', 'ChildStepsController@edit')->name('editChild');
        // 子ステップ編集のリクエストを受け取る
        Route::post('/edit/update-child', 'ChildStepsController@update')->name('updateChild');
    });
