<?php
namespace Thunderkiss52\LaravelDelayedReport;


use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Thunderkiss52\LaravelDelayedReport\Commands\CreateReportCommand;

class ReportProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-delayed-reports')
            ->hasCommand(CreateReportCommand::class)
            //->hasConfigFile()
            ->hasMigrations([
                'create_reports_table',
            ])
            ->publishesServiceProvider('ReportProvider')
            ->hasInstallCommand(function(InstallCommand $command) {
                $command
                    //->publishConfigFile()
                    ->publishMigrations();
                    //->copyAndRegisterServiceProviderInApp();
            });
    }

    public function packageBooted(): void
    {
        
    }

    public function packageRegistered(): void
    {
        
    }
}
