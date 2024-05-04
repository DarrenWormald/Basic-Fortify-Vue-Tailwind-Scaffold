<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Illuminate\Http\Request;
use Laravel\Fortify\Features;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $feat = collect(config('fortify.features'));

        

        return array_merge(parent::share($request), [
            //
            'config' => config()->get(['app.name']),
            'auth' => [
                'user' => $request->user() ? UserResource::make($request->user()) : null,
            ],
            'features' => collect(config('fortify.features'))->mapWithKeys(fn ($key) => [$key => true])->merge([
                'security' => Features::hasSecurityFeatures(),
            ]),
            'toast' => session('toast'),
            'ziggy' => [
                'route_name' => Route::currentRouteName(),
            ],
        ]);
    }
}
