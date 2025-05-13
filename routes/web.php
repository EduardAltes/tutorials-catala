<?php

use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

use App\Http\Controllers\TutorialController;

Route::get('/', function () {
    return redirect()->route('tutorials.index');
})->name('home');

Route::get('/tutorials', [TutorialController::class, 'index'])->name('tutorials.index');
Route::get('/tutorials/{slug}', [TutorialController::class, 'show'])->name('tutorials.show');


// == SEO ==
Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create()
        ->add(Url::create('/'))
        ->add(Url::create('/tutorials'));

    foreach (\App\Models\Tutorial::all() as $tutorial) {
        $sitemap->add(Url::create('/tutorials/' . $tutorial->slug));
    }

    return $sitemap->toResponse(request());
});

Route::get('/robots.txt', function () {
    return response()->view('robots')->header('Content-Type', 'text/plain');
});
