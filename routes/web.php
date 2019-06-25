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

//Route::get('/', function () {
//    return view('welcome');
//});
//Route::get('/teste ', function () {
//    return view('home.index');
//});
//Auth::routes();


// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//$this->post('register', 'Auth\RegisterController@register');
$this->post('registro', 'Painel\UserController@register')->name('registro');



// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');


//Route::fallback(function() {
//    return view('errors.404');
//})->name(404);



/****************************************************************************************
 * Rotas do Site
 ****************************************************************************************/
Auth::routes(['verify' => true]);

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', function () {
    return view('welcome');
})->name('home');


Route::get('/mail', 'Site\SiteController@sendMail');
Route::get('/create-lead', 'Site\SiteController@create')->name('site.create');
Route::post('/comment-post', 'Site\SiteController@commentPost')->name('comment');
Route::get('/contato', 'Site\SiteController@contato')->name('contato');
Route::post('/contato', 'Site\SiteController@sendContact')->name('contact');
Route::get('/blog/categoria/{url}', 'Site\SiteController@category');
Route::get('/blog/posts/{url}', 'Site\SiteController@blogpost')->name('blog-post');
Route::get('/blog', 'Site\SiteController@blog')->name('blog');
Route::post('/blog/search', 'Site\SiteController@search')->name('search.blog');
Route::get('/', 'Site\SiteController@index')->name('site');


/****************************************************************************************
 * Rotas do Painel
****************************************************************************************/
Route::group(['prefix' => 'painel', 'middleware' => ['auth', 'verified']], function (){
    //Usuários
    Route::any('/usuario/{id}/perfis/pesquisar', 'Painel\UserController@searchProfile')->name('user.profiles.search');
    Route::get('/usuario/{id}/perfis/{profileid}/delete', 'Painel\UserController@deleteProfile')->name('user.profile.delete');
    Route::post('/usuario/{id}/perfis/cadastrar', 'Painel\UserController@profilesAddUser')->name('user.profiles.add');
    Route::get('/usuario/{id}/perfis/cadastrar', 'Painel\UserController@profilesAdd')->name('user.profiles.add');
    Route::get('/usuario/{id}/perfis', 'Painel\UserController@profiles')->name('user.profiles');

    Route::any('/usuarios/pesquisar', 'Painel\UserController@search')->name('usuarios.search');
    Route::resource('/usuarios', 'Painel\UserController');
    Route::get('/profile', 'Painel\UserController@showProfile')->name('profile.show');
    Route::get('/profile-edit', 'Painel\UserController@editProfile')->name('profile.edit');
    Route::post('/profile-edit', 'Painel\UserController@updateProfile')->name('profile.editgo');
    //Categorias
    Route::any('/categorias/pesquisar', 'Painel\CategoryController@search')->name('categorias.search');
    Route::resource('/categorias', 'Painel\CategoryController');
    //Posts
    Route::any('/posts/pesquisar', 'Painel\PostController@search')->name('posts.search');
    Route::resource('/posts', 'Painel\PostController');

    //Comments
    Route::any('/comentarios/pesquisar', 'Painel\CommentController@search')->name('comments.search');
    Route::get('/comentarios/{id}/respostas', 'Painel\CommentController@answers');
    Route::resource('/comentarios', 'Painel\CommentController');
    Route::post('/comentarios/{id}/answer', 'Painel\CommentController@answersReply')->name('answer.reply');
    Route::post('/comentarios/{id}/destroy', 'Painel\CommentController@destroy')->name('comments.destroy');
    Route::get('/comentarios/{id}/resposta/{idAnswer}/delete', 'Painel\CommentController@destroyAnswer')->name('destroy-answer');

//Profiles
    Route::any('/perfil/{id}/usuarios/pesquisar', 'Painel\ProfileController@searchUser')->name('profile.users.search');
    Route::get('/perfis/{id}/usuarios/{userid}/delete', 'Painel\ProfileController@deleteUser')->name('profile.user.delete');
    Route::post('/perfis/{id}/usuarios/cadastrar', 'Painel\ProfileController@usersAddProfile')->name('profile.users.add');
    Route::get('/perfis/{id}/usuarios/cadastrar', 'Painel\ProfileController@usersAdd')->name('profile.users.add');
    Route::get('/perfis/{id}/usuarios', 'Painel\ProfileController@users')->name('profile.users');

    Route::any('/perfil/{id}/permissions/pesquisar', 'Painel\ProfileController@searchPermissions')->name('profile.permissions.search');
    Route::get('/perfis/{id}/permissions/{userid}/delete', 'Painel\ProfileController@deletePermissions')->name('profile.permissions.delete');
    Route::post('/perfis/{id}/permissions/cadastrar', 'Painel\ProfileController@permissionsAddProfile')->name('profile.permissions.add');
    Route::get('/perfis/{id}/permissions/cadastrar', 'Painel\ProfileController@permissionsAdd')->name('profile.permissions.add');
    Route::get('/perfis/{id}/permissions', 'Painel\ProfileController@permissions')->name('profile.permissions');

    Route::any('/perfis/pesquisar', 'Painel\ProfileController@search')->name('profiles.search');
    Route::resource('/perfis', 'Painel\ProfileController');

    //Permissões
    Route::any('/permissao/{id}/profiles/pesquisar', 'Painel\PermissionController@searchProfile')->name('permission.profiles.search');
    Route::get('/permissao/{id}/profiles/{profileid}/delete', 'Painel\PermissionController@deleteProfile')->name('permission.profile.delete');
    Route::post('/permissao/{id}/profiles/cadastrar', 'Painel\PermissionController@profilesAddPermission')->name('permission.profiles.add');
    Route::get('/permissao/{id}/profiles/cadastrar', 'Painel\PermissionController@profilesAdd')->name('permission.profiles.add');
    Route::get('/permissao/{id}/perfis', 'Painel\PermissionController@profiles')->name('permission.profiles');
    Route::any('/permissoes/pesquisar', 'Painel\PermissionController@search')->name('permissions.search');
    Route::resource('/permissoes', 'Painel\PermissionController');




//Setores
    Route::any('/sectors/pesquisar', 'Painel\SectorController@search')->name('sectors.search');
    Route::resource('/sectors', 'Painel\SectorController');

//Idéias
    Route::any('/ideas/pesquisar', 'Painel\IdeaController@search')->name('ideas.search');
    Route::any('/ideas/edit-assessor/{id}', 'Painel\IdeaController@editAssessor')->name('ideas.edit-assessor');
    Route::resource('/ideas', 'Painel\IdeaController');

    /* Área de acesso do cidadão;
     * */
    Route::any('/ideas-public/pesquisar', 'Painel\IdeaPublicController@search')->name('ideas-public.search');
    Route::resource('/ideas-public', 'Painel\IdeaPublicController');



//Parlamentetares
    Route::any('/parlamentares/pesquisar', 'Painel\ParlamentarController@search')->name('parlamentar.search');
    Route::resource('/parlamentares', 'Painel\ParlamentarController');


//Súmulas
    Route::any('/sumulas/pesquisar', 'Painel\SumulaController@search')->name('sumula.search');
    Route::resource('/sumulas', 'Painel\SumulaController');




    //Raiz painel
    Route::get('/', 'Painel\PainelController@index')->name('home.painel');



});


