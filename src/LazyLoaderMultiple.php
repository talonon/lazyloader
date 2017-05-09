<?php namespace Talonon\LazyLoader;

use Illuminate\Support\Collection;
use Talonon\Ooops\Interfaces\ResultInterface;
use Talonon\Ooops\Models\BaseGetMultipleParams;
use Talonon\Ooops\Traits\RDBMS\EntityCrud;

class LazyLoaderMultiple implements LazyLoadInterface, ResultInterface {

  use EntityCrud;

  /**
   * LazyLoader constructor.
   * @param $id
   * @param string $opClass
   */
  public function __construct(BaseGetMultipleParams $params) {
    $this->_params = $params;
  }

  private static $cache;
  /**
   * @var BaseGetMultipleParams
   */
  private $_params;

  /**
   * @param bool $canUseCache
   * @return Collection
   */
  public function GetResult(bool $canUseCache = true) {
    return $this->getEntities($this->_params);
  }

}

