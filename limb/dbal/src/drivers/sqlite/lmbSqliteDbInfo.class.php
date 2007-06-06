<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com 
 * @copyright  Copyright &copy; 2004-2007 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html 
 */
lmb_require('limb/dbal/src/drivers/lmbDbInfo.class.php');
lmb_require('limb/dbal/src/drivers/sqlite/lmbSqliteTableInfo.class.php');

/**
 * class lmbSqliteDbInfo.
 *
 * @package dbal
 * @version $Id$
 */
class lmbSqliteDbInfo extends lmbDbInfo
{
  protected $connection;
  protected $isExisting = false;
  protected $isTablesLoaded = false;

  function __construct($connection, $name, $isExisting = false)
  {
    $this->connection = $connection;
    $this->isExisting = $isExisting;
    parent::__construct($name);
  }

  function getConnection()
  {
    return $this->connection;
  }

  function loadTables()
  {
    if($this->isExisting && !$this->isTablesLoaded)
    {
      $queryId = $this->connection->execute("SHOW TABLES FROM '" . $this->name . "'");
      while(is_array($value = sqlite_fetch_single($queryId)))
      {
        $this->tables[$value] = null;
      }
      $this->isTablesLoaded = true;
    }
  }

  function getTable($name)
  {
    if(!$this->hasTable($name))
    {
      throw new lmbDbException("Table does not exist '$name'");
    }
    if(is_null($this->tables[$name]))
    {
      $this->tables[$name] = new lmbSqliteTableInfo($this, $name, true);
    }
    return $this->tables[$name];
  }
}

?>
