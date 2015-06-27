<?php

include_once 'interface.dbdriver.php';

class JSONdriver implements DBdriver
{
  protected $file;
  protected $table;

  public function __construct ($table)
  {
    $this->filePath = "storage/DB.json";
    $this->file = file_get_contents($this->filePath);
    $this->table = $table;
  }

  public function all ($foreign_id=null)
  {
    $items = json_decode($this->file, true);

    if ($foreign_id != null)
    {
        if (isset($items[$this->table])) {
          $result = array();
          foreach($items[$this->table] as $row)
          {
            if($row['topic_id']==$foreign_id)
            {
              array_push($result, $row);
            }
          }
          return $result;
          unset($items);
        } else {
          return null;
          unset($items);
        }
    }
    else
    {
        if (isset($items[$this->table])) {
            return $items[$this->table];
            unset($items);
        } else {
            return null;
            unset($items);
        }
     }
  }

  public function insert ($values)
  {
    $file = $this->file;
    $table = $this->table;
    $items = json_decode($file, true);

    $insert = array();

    $i = 1;
    foreach ($items[$table] as $item)
    {
      if ($i <= $item["id"])
      {
        $i = $item["id"];
      }
    }
    $insert["id"] = $i + 1;

    foreach ($values as $key=>$value)
    {
      $insert[$key] = $value;
    }
    $insert["created_at"] = date(c);
    $insert["updated_at"] = date(c);

    array_push($items[$table],$insert);

    $items = json_encode($items);
    file_put_contents($this->filePath, $items);
  }

  public function delete ($id)
  {
    $file = $this->file;
    $items = json_decode($file, true);
    $table = $this->table;

    foreach ($items[$table] as $row)
    {
      if ($row["id"] == $id)
      {
        unset($items[$table][$id-1]);
        foreach ($items["comments"] as $key=>$value)
        {
          if ($items["comments"][$key]["topic_id"] == $id)
          {
            unset($items["comments"][$key]);
          }
        }
      }
    }
    $items = json_encode($items);
    file_put_contents($this->filePath, $items);
  }
}
