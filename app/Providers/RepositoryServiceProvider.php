<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BaseRepository;
use App\Repositories\UserRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\JobRepository;
use App\Repositories\JobSeekerRepository;
use App\Repositories\ApplicationRepository;
use App\Repositories\SkillRepository;
use App\Repositories\JobCategoryRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // We don't need to bind BaseRepository as it's an abstract class that requires a Model
        // Each specific repository will extend BaseRepository and provide its own Model
        $this->app->bind(UserRepository::class, UserRepository::class);
        $this->app->bind(CompanyRepository::class, CompanyRepository::class);
        $this->app->bind(JobRepository::class, JobRepository::class);
        $this->app->bind(JobSeekerRepository::class, JobSeekerRepository::class);
        $this->app->bind(ApplicationRepository::class, ApplicationRepository::class);
        $this->app->bind(SkillRepository::class, SkillRepository::class);
        $this->app->bind(JobCategoryRepository::class, JobCategoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
