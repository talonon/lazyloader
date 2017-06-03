<?php namespace Talonon\LazyLoader;

trait LoadsLazily {

  private $_lazy;

  /**
   * @param LazyLoadInterface|null $property
   * @return LazyLoadInterface
   */
  protected function ll(LazyLoadInterface &$property = null) {
    return $this->_getLazy()->Load($property);
  }

  private function _getLazy() {
    if (!$this->_lazy) {
      $this->_lazy = app(LazyLoaderService::class);
    }
    return $this->_lazy;
  }
}
