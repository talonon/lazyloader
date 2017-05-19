<?php namespace Talonon\LazyLoader;

trait LoadsLazily {

  public function __construct() {
    $this->_lazy = app(LazyLoaderService::class);
   }

  private $_lazy;

  /**
   * @param LazyLoadInterface|null $property
   * @return LazyLoadInterface
   */
  protected function ll(LazyLoadInterface &$property = null) {
    return $this->_lazy->Load($property);
  }
}
