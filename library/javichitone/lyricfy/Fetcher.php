<?php namespace Javichitone\Lyricfy;

use Javichitone\Lyricfy\Song;
use Javichitone\Lyricfy\Providers\Wikia;
use Javichitone\Lyricfy\Providers\MetroLyrics;

class Fetcher
{
  private $providers;

  function __construct()
  {
    $this->providers = array('wikia', 'metro_lyrics');

    if ($providers = func_get_args()) {
      foreach ($providers as $provider) {
        if (!in_array($provider, $this->providers)) {
          throw new \Exception();
        }
      }
      $this->providers = $providers;
    }
  }

  public function getProviders()
  {
    return $this->providers;
  }

  public function search($artist, $song)
  {
    if (!isset($artist) || !isset($song)) {
      throw new \Exception();
    }

    $key = strtolower($artist) . "-" . strtolower($song);

    foreach ($this->providers as $provider) {
      $klass = '\Javichitone\Lyricfy\Providers\\' . $this->camelize($provider);
      $fetcher = new $klass(array(
          'artist_name' => $artist,
          'song_name'   => $song
        ));

      if( $lyric_body = $fetcher->search() ) {
        return new Song($song, $artist, $lyric_body);
      }
    }

    return NULL;
  }

  private function camelize($string)
  {
    return str_replace(" ", "", ucfirst( implode( " ", explode("_", $string) ) ));
  }
}