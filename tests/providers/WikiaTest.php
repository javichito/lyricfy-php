<?php namespace Javichitone\Lyricfy\Providers;

require_once 'tests/bootstrap.php';

class WikiaTest extends \PHPUnit_Framework_Testcase
{
  function testFormatParametersWithSemicolon()
  {
    $provider = new Wikia(array(
        "artist_name" => "Coldplay",
        "song_name"   => "Fix You"
      ));
    $this->assertEquals("Coldplay:Fix_You", $provider->formatParameters());
  }

  /**
   * @vcr wikia_404.yml
   */
  function testReturnNullWhenNotFound()
  {
    $provider = new Wikia(array(
        "artist_name" => "2pac",
        "song_name"   => "fawfawf"
      ));

    $this->assertEquals(NULL, $provider->search());
  }

  function testReturnCollectionWhenFound()
  {
    $provider = new Wikia(array(
        "artist_name" => "2pac",
        "song_name"   => "life goes on"
      ));
    $result = $provider->search();

    $this->assertEquals("array", gettype($result));
  }

  /**
   * @vcr wikia_200.yml
   */
  function testReturnLyricsWithoutHtmlTags()
  {
    $provider = new Wikia(array(
        "artist_name" => "Coldplay",
        "song_name"   => "Fix You"
      ));
    $result = implode(" ", $provider->search());

    $this->assertNotRegExp("/<*>/", $result);
  }
}
