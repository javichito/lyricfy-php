<?php namespace Javichitone\Lyricfy;

require_once 'tests/bootstrap.php';

class SongTest extends \PHPUnit_Framework_Testcase
{
  public function testTitleCanBeRetrieved()
  {
    $song = new Song("Hero", "Nickelback", []);
    $this->assertEquals("Hero", $song->getTitle());
  }

  public function testAuthorCanBeRetrieved()
  {
    $song = new Song("Hero", "Nickelback", []);
    $this->assertEquals("Nickelback", $song->getAuthor());
  }

  public function testLinesCanBeRetrieved()
  {
    $lines = ["first paragraph", "second paragraph"];
    $song = new Song("Hero", "Nickelback", $lines);
    $this->assertEquals($lines, $song->getLines());
  }

  public function testBodyCanBeRetrieved()
  {
    $lines = ["first paragraph", "second paragraph"];
    $song = new Song("Hero", "Nickelback", $lines);
    $this->assertEquals("first paragraph\\nsecond paragraph", $song->body());
  }

  public function testBodyWithCustomSeparator()
  {
    $lines = ["first paragraph", "second paragraph"];
    $song = new Song("Hero", "Nickelback", $lines);
    $this->assertEquals("first paragraph<br>second paragraph", $song->body("<br>"));
  }
}
