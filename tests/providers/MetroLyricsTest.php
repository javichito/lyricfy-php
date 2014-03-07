<?php namespace Javichitone\Lyricfy\Providers;

require_once 'tests/bootstrap.php';

class MetroLyricsTest extends \PHPUnit_Framework_Testcase
{
  function testFormatParametersWithHyphen()
  {
    $provider = new MetroLyrics(array(
        "artist_name" => "Coldplay",
        "song_name"   => "Fix You"
      ));
    $this->assertEquals("fix-you-lyrics-coldplay", $provider->formatParameters());
  }

  function testReturnNullWhenNotFound()
  {
    $provider = new MetroLyrics(array(
        "artist_name" => "2pac",
        "song_name"   => "fawfawf"
      ));

    $this->assertEquals(NULL, $provider->search());
  }

  function testReturnCollectionWhenFound()
  {
    $provider = new MetroLyrics(array(
        "artist_name" => "2pac",
        "song_name"   => "life goes on"
      ));
    $result = $provider->search();

    $this->assertEquals("array", gettype($result));
  }

  function testReturnLyricsWithoutHtmlTags()
  {
    $provider = new MetroLyrics(array(
        "artist_name" => "Coldplay",
        "song_name"   => "Fix You"
      ));
    $result = implode(" ", $provider->search());

    $this->assertNotRegExp("/<*>/", $result);
  }
}