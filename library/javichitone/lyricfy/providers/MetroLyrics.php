<?php namespace Javichitone\Lyricfy\Providers;

use Sunra\PhpSimple\HtmlDomParser;

class MetroLyrics extends \Javichitone\Lyricfy\Provider
{
  function __construct($parameters)
  {
    parent::__construct($parameters);
    $this->base_url = "http://m.metrolyrics.com/";
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
    $artist_name = strtolower(str_replace(" ", "-", $this->parameters['artist_name']));
    $song_name = strtolower(str_replace(" ", "-", $this->parameters['song_name']));
    return "$song_name-lyrics-$artist_name";
  }

  private function htmlToArray($html)
  {
    $container = ($container = $html->find('p.lyricsbody', 0)) ? $container : $html->find('p.gnlyricsbody', 0);

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