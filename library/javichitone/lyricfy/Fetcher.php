<?php
namespace Javichitone\Lyricfy;

use Javichitone\Lyricfy\Song;
use Javichitone\Lyricfy\Providers\Wikia;
use Javichitone\Lyricfy\Providers\MetroLyrics;

class Fetcher
{
  private $providers;

  function __construct()
  {
    $this->providers = array(
      'wikia' => Wikia,
      'metro_lyrics' => MetroLyrics
    );
  }

  public function search($artist, $song)
  {
    $key = strtolower($artist) . "-" . strtolower($song);

    foreach ($this->providers as $provider => $klass) {
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
}