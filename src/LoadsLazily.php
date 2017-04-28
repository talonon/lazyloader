<?php namespace Talonon\LazyLoader;

trait LoadsLazily {

  /**
   * @param LazyLoadInterface|null $property
   * @return LazyLoadInterface
   */
  protected function ll(LazyLoadInterface $property = null) {
    if ($property === null || $property instanceof NullLazyLoader) {
      return new NullLazyLoader();
    } else if ($property instanceof LazyLoader) {
      return $property->GetResult();
    } else {
      return $property;
    }
  }

}

