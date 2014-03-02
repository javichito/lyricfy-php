<?php
namespace Javichitone\Lyricfy;

class Song
{
  private $title;
  private $author;
  private $lines;

  function __construct($title, $author, $lines)
  {
    $this->title  = $title;
    $this->author = $author;
    $this->lines  = $lines;
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function getAuthor()
  {
    return $this->author;
  }

  public function getLines()
  {
    return $this->lines;
  }

  public function setTitle($title)
  {
    $this->title = $title;
  }

  public function setAuthor($author)
  {
    $this->author = $author;
  }

  public function setLines($lines)
  {
    $this->lines = $lines;
  }

  public function body($separator = '\n')
  {
    return implode($separator, $this->lines);
  }
}