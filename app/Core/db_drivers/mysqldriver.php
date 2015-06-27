<?php

include_once 'interface.dbdriver.php';

class MYSQLdriver implements DBdriver
{
  protected $pdo;
  protected $table;

  public function __construct ($table)
  {
   try {
       $this->pdo = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
       $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $this->table = $table;
    } catch (DBException $e) {
    echo 'The connect can not create: ' . $e->getMessage();
   }
  }

  public function all ($foreign_id=null)
  {
    if ($foreign_id != null)
    {
        $query = $this->pdo->query("SELECT * FROM ". $this->table . " WHERE topic_id = " . $foreign_id);
        $items = new ArrayObject($query->fetchAll(\PDO::FETCH_ASSOC));
        if (isset($items)) {
            return $items;
        } else {
            return null;
        }
    }
    else
    {
        $query = $this->pdo->query("SELECT * FROM ". $this->table . " ORDER BY date DESC");
        $items = new ArrayObject($query->fetchAll(\PDO::FETCH_ASSOC));
        if (isset($items)) {
            return $items;
        } else {
            return null;
        }
     }
  }

  public function insert ($values)
  {
    $queryKeys = '';
    $queryValues = '';
    foreach ($values as $key=>$value)
    {
      $queryKeys = $queryKeys . $key . ' , ';
      $queryValues = $queryValues ."'". addslashes($value) ."'".' , ';
    }
    $queryKeys = $queryKeys . "created_at, updated_at";
    $queryValues = $queryValues . CURRENT_TIMESTAMP . ' , ' . CURRENT_TIMESTAMP;
    echo 'INSERT INTO '. $this->table .' ( '. $queryKeys .' ) VALUES ( '. $queryValues .' )';
    $query=$this->pdo->prepare('INSERT INTO '. $this->table .' ( '. $queryKeys .' ) VALUES ( '. $queryValues .' )');
    $query->execute();
  }

  public function delete ($id)
  {
    $query=$this->pdo->prepare('DELETE FROM ' . $this->table .  ' where id = ' . $id);
    $query->execute();
  }
}
