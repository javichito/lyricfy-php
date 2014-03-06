<?php namespace Javichitone\Lyricfy;

class Provider
{
  protected $url;
  protected $base_url;
  protected $parameters;

  function __construct($parameters)
  {
    $this->base_url = "";
    $this->parameters = $parameters;
  }

  public function getUrl()
  {
    return $this->url;
  }

  public function setUrl($url)
  {
    $this->url = $url;
  }

  public function getBaseUrl()
  {
    return $this->base_url;
  }

  public function setBaseUrl($base_url)
  {
    $this->base_url = $base_url;
  }

  public function getParameters()
  {
    return $this->parameters;
  }

  public function setParameters($parameters)
  {
    $this->parameters = $parameters;
  }

  public function search()
  {
    try {
      return @file_get_contents(urldecode($this->url));
    }
    catch(Exception $e) {
      return NULL;
    }
  }
}