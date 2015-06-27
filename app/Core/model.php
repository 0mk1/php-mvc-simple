<?php

include_once 'app/Core/db_drivers/mysqldriver.php';
include_once 'app/Core/db_drivers/xmldriver.php';
include_once 'app/Core/db_drivers/jsondriver.php';

class Model
{
  public $table;

  public function __construct ()
  {
    $this->connection = Model::connection($this->table);
  }

  public function all ($foreign_id=null)
  {
    return $this->connection->all($foreign_id);
  }

  public function delete ($id)
  {
    $this->connection->delete($id);
  }

  public function insert ($values)
  {
    $this->connection->insert($values);
  }

  private static function connection ($table)
  {
    switch (DB_TYPE)
    {
      case "mysql":
        $connection = new MYSQLdriver($table);
        return $connection;
        break;
      case "json":
        $connection = new JSONdriver($table);
        return $connection;
        break;
      case "xml":
        $connection = new XMLdriver($table);
        return $connection;
        break;
    }
  }
}
