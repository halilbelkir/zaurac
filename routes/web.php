<?php

    use Illuminate\Support\Facades\Route;
    use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
    use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
    use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
    use Laravel\Fortify\Http\Controllers\NewPasswordController;
    use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
    use Laravel\Fortify\Http\Controllers\RegisteredUserController;
    use Laravel\Fortify\Http\Controllers\VerifyEmailController;
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

    Route::get('/', [App\Http\Controllers\frontController::class, 'index'])->name('index');
    Route::get('/hakkımızda', function () {return view('front.about');})->name('about');
    Route::get('/referanslarimiz', [App\Http\Controllers\frontController::class, 'clients'])->name('clients');
    Route::get('/iletisim', function () {return view('front.contact');})->name('contact');
    Route::get('/projelerimiz', function () {return view('front.projects.index');})->name('projects.list');
    Route::get('/projelerimiz/{seflink}', function () {return view('front.projects.detail');})->name('projects.detail');
    Route::get('/hizmetlerimiz', [App\Http\Controllers\frontController::class, 'services'])->name('services.list');
    Route::get('/hizmetlerimiz/{seflink}', [App\Http\Controllers\frontController::class, 'service'])->name('services.detail');
    Route::get('/zauracblog', [App\Http\Controllers\frontController::class, 'blog'])->name('blog.list');
    Route::get('/zauracblog/{seflink}', [App\Http\Controllers\frontController::class, 'blog_detail'])->name('blog.detail');
    Route::get('/site-haritasi', [App\Http\Controllers\frontController::class, 'sitemap'])->name('sitemap');
    Route::post('/send', [App\Http\Controllers\frontController::class, 'send'])->name('contact.send');
    Route::prefix('yonetimpaneli')->group(function ()
    {
        Route::get('/', function () {
            return view('auth.login');
        });
        Route::get('/register', [RegisteredUserController::class, 'create'])
            ->middleware('guest')
            ->name('register');

        Route::post('/register', [RegisteredUserController::class, 'store'])
            ->middleware('guest');

        Route::get('/login', [AuthenticatedSessionController::class, 'create'])
            ->middleware('guest')
            ->name('login');

        Route::post('/login', [AuthenticatedSessionController::class, 'store'])
            ->middleware('guest');

        Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
            ->middleware('guest')
            ->name('password.request');

        Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
            ->middleware('guest')
            ->name('password.email');

        Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
            ->middleware('guest')
            ->name('password.reset');

        Route::post('/reset-password', [NewPasswordController::class, 'store'])
            ->middleware('guest')
            ->name('password.update');

        Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
            ->middleware('auth')
            ->name('verification.notice');

        Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
            ->middleware(['auth', 'signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware(['auth', 'throttle:6,1'])
            ->name('verification.send');

        Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
            ->middleware('auth')
            ->name('password.confirm');

        Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
            ->middleware('auth');

        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
            ->middleware('auth')
            ->name('logout');


        Route::middleware(['auth:sanctum', 'verified'])->group(function ()
        {
            Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
            Route::get('user/datatables', [App\Http\Controllers\usersController::class, 'datatable'])->name('users.datatables');
            Route::get('user/destroy/{id}', [App\Http\Controllers\usersController::class, 'destroy'])->name('user.destroy');

            Route::get('reference/datatables', [App\Http\Controllers\ReferencesController::class, 'datatable'])->name('references.datatables');
            Route::get('reference/destroy/{id}', [App\Http\Controllers\ReferencesController::class, 'destroy'])->name('reference.destroy');
            Route::post('reference/sortable', [App\Http\Controllers\ReferencesController::class, 'sortable'])->name('references.sortable');

            Route::get('products/datatables', [App\Http\Controllers\ProductsController::class, 'datatable'])->name('products.datatables');
            Route::get('products/destroy/{id}', [App\Http\Controllers\ProductsController::class, 'destroy'])->name('product.destroy');

            Route::get('team/datatables', [App\Http\Controllers\teamController::class, 'datatable'])->name('team.datatables');
            Route::get('team/destroy/{id}', [App\Http\Controllers\teamController::class, 'destroy'])->name('teamm.destroy');
            Route::get('team/destroy-image/{id}', [App\Http\Controllers\teamController::class, 'destroyImage'])->name('team.destroy.image');
            Route::post('team/sortable', [App\Http\Controllers\teamController::class, 'sortable'])->name('team.sortable');

            Route::post('services/sortable', [App\Http\Controllers\servicesController::class, 'sortable'])->name('services.sortable');
            Route::get('services/datatables', [App\Http\Controllers\servicesController::class, 'datatable'])->name('services.datatables');
            Route::get('services/destroy/{id}', [App\Http\Controllers\servicesController::class, 'destroy'])->name('service.destroy');
            Route::get('services/destroy-image/{id}/{order}', [App\Http\Controllers\servicesController::class, 'destroyImage'])->name('services.destroy.image');

            Route::post('awards/sortable', [App\Http\Controllers\awardsController::class, 'sortable'])->name('awards.sortable');
            Route::get('awards/datatables', [App\Http\Controllers\awardsController::class, 'datatable'])->name('awards.datatables');
            Route::get('awards/destroy/{id}', [App\Http\Controllers\awardsController::class, 'destroy'])->name('award.destroy');
            Route::get('awards/destroy-image/{id}', [App\Http\Controllers\awardsController::class, 'destroyImage'])->name('awards.destroy.image');

            Route::get('pages/datatables', [App\Http\Controllers\pagesController::class, 'datatable'])->name('pages.datatables');
            Route::get('pages/destroy/{id}', [App\Http\Controllers\pagesController::class, 'destroy'])->name('page.destroy');
            Route::get('pages/destroy-image/{id}', [App\Http\Controllers\pagesController::class, 'destroyImage'])->name('pages.destroy.image');

            Route::get('blog/datatables', [App\Http\Controllers\blogController::class, 'datatable'])->name('blog.datatables');
            Route::get('blog/destroy/{id}', [App\Http\Controllers\blogController::class, 'destroy'])->name('blogg.destroy');
            Route::get('blog/destroy-image/{id}/{order}', [App\Http\Controllers\blogController::class, 'destroyImage'])->name('blog.destroy.image');
            Route::post('blog/sortable', [App\Http\Controllers\blogController::class, 'sortable'])->name('blog.sortable');

            Route::post('media/sortable', [App\Http\Controllers\mediaController::class, 'sortable'])->name('media.sortable');
            Route::get('media/datatables', [App\Http\Controllers\mediaController::class, 'datatable'])->name('media.datatables');
            Route::get('media/destroy/{id}', [App\Http\Controllers\mediaController::class, 'destroy'])->name('mediaa.destroy');
            Route::get('media/destroy-image/{id}', [App\Http\Controllers\mediaController::class, 'destroyImage'])->name('media.destroy.image');

            Route::post('gallery/sortable', [App\Http\Controllers\galleryController::class, 'sortable'])->name('gallery.sortable');
            Route::get('gallery/datatables', [App\Http\Controllers\galleryController::class, 'datatable'])->name('gallery.datatables');
            Route::get('gallery/destroy/{id}', [App\Http\Controllers\galleryController::class, 'destroy'])->name('galleryy.destroy');
            Route::get('gallery/destroy-image/{id}/{order}', [App\Http\Controllers\galleryController::class, 'destroyImage'])->name('gallery.destroy.image');

            Route::get('slider/datatables', [App\Http\Controllers\sliderController::class, 'datatable'])->name('slider.datatables');
            Route::get('slider/destroy/{id}', [App\Http\Controllers\sliderController::class, 'destroy'])->name('slide.destroy');
            Route::get('slider/destroy-image/{id}', [App\Http\Controllers\sliderController::class, 'destroyImage'])->name('slider.destroy.image');
            Route::post('slider/sortable', [App\Http\Controllers\sliderController::class, 'sortable'])->name('slider.sortable');

            Route::get('form/datatables', [App\Http\Controllers\formController::class, 'datatable'])->name('form.datatables');
            Route::get('form', [App\Http\Controllers\formController::class, 'index'])->name('form.index');

            Route::resource('users', App\Http\Controllers\usersController::class);
            Route::resource('settings', App\Http\Controllers\SettingsController::class);
            Route::resource('references', App\Http\Controllers\ReferencesController::class);
            Route::resource('products', App\Http\Controllers\ProductsController::class);
            Route::resource('team', App\Http\Controllers\teamController::class);
            Route::resource('services', App\Http\Controllers\servicesController::class);
            Route::resource('awards', App\Http\Controllers\awardsController::class);
            Route::resource('pages', App\Http\Controllers\pagesController::class);
            Route::resource('blog', App\Http\Controllers\blogController::class);
            Route::resource('media', App\Http\Controllers\mediaController::class);
            Route::resource('gallery', App\Http\Controllers\galleryController::class);
            Route::resource('slider', App\Http\Controllers\sliderController::class);
        });
    });
    Route::get('{seflink}', [App\Http\Controllers\frontController::class, 'pages'])->name('front.pages');
