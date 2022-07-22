<?php

namespace Duodoctor\Setuprolepermission;

use Illuminate\Support\ServiceProvider;
use Command\SetupCommand;
use Command\ProprietarioCommand;
use Command\MakeConfigFileCommand;

class SetupRolePermissionServiceProvider extends ServiceProvider {

    /**
     * Boots the service provider.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SetupCommand::class,
                ProprietarioCommand::class,
                MakeConfigFileCommand::class
            ]);
        }
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        //
    }
}