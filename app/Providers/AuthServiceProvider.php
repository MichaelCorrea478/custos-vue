<?php

namespace App\Providers;

use App\Models\Ingredient;
use App\Models\Production;
use App\Models\Recipe;
use App\Policies\IngredientPolicy;
use App\Policies\ProductionPolicy;
use App\Policies\RecipePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Ingredient::class => IngredientPolicy::class,
        Recipe::class => RecipePolicy::class,
        Production::class => ProductionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
