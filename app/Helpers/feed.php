<?php

class Feed
{
 public static function html2string($html) 
 {
   $str = preg_replace('/<(?:.|\s)*?>/', "", $html);
   $str = substr($str, 0, 200);
   return $str;
 }

 public static function parser($url, $length) 
 {
  $rss = new \DOMDocument();
  $rss->load($url);
  $feed = array();
  foreach ($rss->getElementsByTagName('entry') as $node) {
    if ($length > 0) {
      $item = array ( 
              'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
              'date' => $node->getElementsByTagName('published')->item(0)->nodeValue,
              'desc' => Feed::html2string($node->getElementsByTagName('summary')->item(0)->nodeValue) . "orange...",
              );
      array_push($feed, $item);
      $length--;
    } else { break; }
  }
  return $feed;
 }
}
