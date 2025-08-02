<?php

namespace App\Providers;

use App\Interfaces\AssetRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\SubCategoryRepositoryInterface;
use App\Repositories\AssetRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\SubCategoryRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {
    public function register() {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(SubCategoryRepositoryInterface::class, SubCategoryRepository::class);
        $this->app->bind(AssetRepositoryInterface::class, AssetRepository::class);

    }
}
