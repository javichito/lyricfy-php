<?php namespace Javichitone\Lyricfy;

require_once 'tests/bootstrap.php';

class LyricfyTest extends \PHPUnit_Framework_Testcase
{
  function testDefaultProviders()
  {
    $fetcher = new Fetcher();
    $providers = $fetcher->getProviders();
    $this->assertContains('wikia', $providers);
    $this->assertContains('metro_lyrics', $providers);
  }

  /**
  * @expectedException Exception
  */
  function testRaiseExceptionWhenInvalid()
  {
    $fetcher = new Fetcher("auaa", 123, array(array()));
  }

  function testUseCustomProviders()
  {
    $fetcher = new Fetcher("metro_lyrics");
    $providers = $fetcher->getProviders();
    $this->assertEquals($providers[0], "metro_lyrics");
  }

  /**
  * @expectedException Exception
  */
  function testCallSearchWithInvalidParams()
  {
    $fetcher = new Fetcher();
    $fetcher->search();
  }

  function testReturnNullWhenLyricsNotFound()
  {
    $fetcher = new Fetcher();
    $this->assertNull($fetcher->search('2pac', 'aafawf'));
  }

  function testReturnLyricsWhenFound()
  {
    $fetcher = new Fetcher();
    $result = $fetcher->search("2pac", "Life goes on");
    $this->assertContains("life as a baller", $result->getLines());
  }
}