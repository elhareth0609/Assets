<?php

namespace App\Providers;

use App\Interfaces\AssetRepositoryInterface;
use App\Interfaces\DepreciationEntryRepositoryInterface;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Interfaces\LocationRepositoryInterface;
use App\Interfaces\TypeRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\AssetRepository;
use App\Repositories\DepreciationEntryRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\LocationRepository;
use App\Repositories\TypeRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {
    public function register() {
        $this->app->bind(DepreciationEntryRepositoryInterface::class, DepreciationEntryRepository::class);
        $this->app->bind(TypeRepositoryInterface::class, TypeRepository::class);
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->bind(AssetRepositoryInterface::class, AssetRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
