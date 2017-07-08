<?php namespace Talonon\LazyLoader;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class LazyLoaderProvider extends ServiceProvider {

  public function register() {
    $this->app->singleton(
      LazyLoaderService::class, function () {
      return new LazyLoaderService();
    });
    $this->app->singleton(
      'lazyloader.abstracts', function () {
      return (new Collection());
    });
  }

  public function boot() {
    $service = $this->app->make(LazyLoaderService::class);
    $service->Register(
      LazyLoadResultInterface::class, function (LazyLoadResultInterface &$object) {
      return $object = $object->GetResult();
    });
    $service->Register(
      NullLazyLoader::class, function () {
      return null;
    });

  }

  public function provides() {
    return [
      LazyLoaderService::class,
    ];
  }

}