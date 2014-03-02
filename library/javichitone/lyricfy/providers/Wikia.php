<?php namespace Javichitone\Lyricfy\Providers;

use Sunra\PhpSimple\HtmlDomParser;

class Wikia extends \Javichitone\Lyricfy\Provider
{
  function __construct($parameters)
  {
    parent::__construct($parameters);
    $this->base_url = "http://lyrics.wikia.com/";
    $this->url = urlencode($this->base_url . $this->formatParameters());
  }

  public function search()
  {
    if($dom = parent::search()) {
      $html = HtmlDomParser::str_get_html($dom);
      $html = $this->htmlToArray($html);
      return $html;
    }

    return NULL;
  }

  public function formatParameters()
  {
    $artist_name = str_replace(" ", "_", $this->parameters['artist_name']);
    $song_name = str_replace(" ", "_", $this->parameters['song_name']);
    return "$artist_name:$song_name";
  }

  private function htmlToArray($html)
  {
    $container = $html->find('div.lyricbox', 0);

    if ($container) {
      $result = array();

      foreach ($container->find('text') as $ele) {
        if ($line = trim(html_entity_decode($ele->innertext))) {
          if ($this->isLyric($line)) {
            $result[] = $line;
          }
        }
      }

      return $result;
    }

    return NULL;
  }

  private function isLyric($line)
  {
    return (
        preg_match("/Ringtone/", $line) == FALSE &&
        preg_match("/^Ad$/", $line) == FALSE
      );
  }
}