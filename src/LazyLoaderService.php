<?php namespace Talonon\LazyLoader;

use Illuminate\Database\Eloquent\Collection;

class LazyLoaderService {

  public function __construct() {
  }

  /**
   * @var Collection
   */
  private $_abstracts;

  /**
   * @param LazyLoadInterface|null $property
   * @return LazyLoadInterface
   */
  public function Load(LazyLoadInterface &$property = null) {
    if ($property === null) {
      return null;
    }
    $result = $this->_getConcrete($property);
    return $property = ($result ? $result($property) : $property);
  }

  public function Register($abstract, Callable $concrete) {
    app('lazyloader.abstracts')->put($abstract, $concrete);
  }

  private function _getConcrete(LazyLoadInterface &$property) {
    /** @var Collection $abstracts */
    $abstracts = app('lazyloader.abstracts');
    $registered = false;
    if (($result = $abstracts[get_class($property)] ?? null)) {
      $registered = true;
    } else {
      $result = $abstracts->first(
        function ($concrete, $abstract) use (&$property) {
          return ($property instanceof $abstract);
        }
      );
    }
    $result && !$registered && $this->Register(get_class($property), $result);
    return $result;
  }
}