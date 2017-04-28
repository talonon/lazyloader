<?php namespace Talonon\LazyLoader;

use Talonon\Ooops\Exceptions\InternalException;
use Talonon\Ooops\Interfaces\ResultInterface;
use Talonon\Ooops\Models\BaseGetSingleParams;
use Talonon\Ooops\Models\Entity;
use Talonon\Ooops\Operations\RDBMS\GetSingleOperation;
use Talonon\Ooops\Traits\RDBMS\EntityCrud;

class LazyLoader implements LazyLoadInterface, ResultInterface {

  use EntityCrud;

  /**
   * LazyLoader constructor.
   * @param $id
   * @param string $opClass
   */
  public function __construct(BaseGetSingleParams $params) {
    $this->_params = $params;
  }

  private static $cache;
  /**
   * @var BaseGetSingleParams
   */
  private $_params;

  /**
   * @param bool $canUseCache
   * @return mixed|Entity
   */
  public function GetResult(bool $canUseCache = true) {
    return $this->getEntity($this->_params);
  }

}

