<?php namespace Talonon\LazyLoader;

use Talonon\Ooops\Interfaces\ResultInterface;
use Talonon\Ooops\Models\Entity;

class ClosureLazyLoader implements LazyLoadInterface, ResultInterface {

  /**
   * LazyClosureLoader constructor.
   * @param $id
   * @param \Closure $opClass
   */
  public function __construct(\Closure $callable) {
    $this->_closure = $callable;
  }

  private static $cache;
  /**
   * @var \Closure
   */
  private $_closure;

  /**
   * @param bool $canUseCache
   * @return mixed|Entity
   */
  public function GetResult(bool $canUseCache = true) {
    $func = $this->_closure;
    return $func();
  }

}

