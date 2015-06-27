<?php

include_once 'interface.dbdriver.php';

/*
 * W pełni nie działa
 * TODO:
 * insert -> wyszukiwanie największego pola id z pliku
 * insert -> nie działa wrzucanie z entry
 * all -> nie działa dla jednego rekordu
 *
 */

class XMLdriver implements DBdriver
{
  protected $table;

  public function __construct ($table)
  {
    $this->table = $table;
    //each table has its own file
    $this->filePath = "storage/". $table . ".xml";
  }

  public function all ($foreign_id=null)
  {
    $xml = simplexml_load_file($this->filePath);
    $items = json_decode(json_encode($xml), true);
    $result = array();

    if ($foreign_id != null)
    {
        if (isset($items)) {
          foreach($items["entry"] as $row)
          {
            if($row["topic_id"]==$foreign_id)
            {
              array_push($result, $row); //TODO
            }
          }
          return $result;
        } else {
          return array();
        }
    }
    else
    {
      if (isset($items))
      {
         foreach($items["entry"] as $row)
         {
          array_push($result, $row); //TODO
         }
         return $result;
         unset($items);
      } else {
          return array();
          unset($items);
        }
     }
  }

  public function insert ($values)
  {
    $file = $this->filePath;
    $table = $this->table;

    $xml = new \DOMDocument('1.0');
    $xml->preserveWhiteSpace = false;
    $xml->formatOutput = true;
    $xml->load($file);
    $rootXml = $xml->documentElement;

    $id = 2; //TODO

    $entry = $xml->createElement('entry id="'.$id.'"');
    $rootXml->appendChild($entry);

    foreach ($values as $key=>$value)
    {
      $element = $xml->createElement($key,$value);
      $rootXml->appendChild($element);
    }
    $el1 = $xml->createElement("created_at", date(c));
    $rootXml->appendChild($el1);

    $el2 = $xml->createElement("updated_at", date(c));
    $rootXml->appendChild($el2);

    $xml->save($file);
  }

  public function delete ($id)
  {
    $file = $this->filePath;
    $file1 = "storage/comments.xml";

    $xml = simplexml_load_file($file);
    $xml1 = simplexml_load_file($file1);

    $target = $xml->xpath('//topics/entry[@id = "'.$id.'"]');
    $target1 = $xml1->xpath('//comments/entry[@topic_id = "'.$id.'"]');

    if ($target)
    {
      $domRef = dom_import_simplexml($target[0]);
      $domRef->parentNode->removeChild($domRef);

      $dom = new \DOMDocument('1.0');
      $dom->preserveWhiteSpace = false;
      $dom->formatOutput = true;
      $dom->loadXML($xml->asXML());
      $dom->save($file);
      if ($target1)
      {
        for ($i = 0;$i<count($target1);$i++)
        {
          $domRef1 = dom_import_simplexml($target1[$i]);
          $domRef1->parentNode->removeChild($domRef1);
        }
        $dom1 = new \DOMDocument('1.0');
        $dom1->preserveWhiteSpace = false;
        $dom1->formatOutput = true;
        $dom1->loadXML($xml1->asXML());
        $dom1->save($file1);
      }
    }
  }
}
