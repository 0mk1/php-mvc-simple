<?php

interface DBdriver
{
  public function __construct ($table);
  public function all ($foreign_id=null);
  public function insert ($values);
  public function delete ($id);
}
