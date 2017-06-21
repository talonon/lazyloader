<?php namespace Talonon\LazyLoader;

use Illuminate\Database\Eloquent\Collection;

class LazyLoaderService implements \Serializable {

  public function __construct() {
    $this->_abstracts = new Collection();
  }
  /**
   * @var Collection
   */
  private $_abstracts;

  public function serialize() {
    return [];
  }

  public function unserialize($serialized) {
    // noop
  }

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
    $this->_abstracts[$abstract] = $concrete;
  }

  private function _getConcrete(LazyLoadInterface &$property) {
    $registered = false;
    if (($result = $this->_abstracts[get_class($property)] ?? null)) {
      $registered = true;
    } else {
      $result = $this->_abstracts->first(
        function ($concrete, $abstract) use (&$property) {
          return ($property instanceof $abstract);
        }
      );
    }
    $result && !$registered && $this->Register(get_class($property), $result);
    return $result;
  }
}