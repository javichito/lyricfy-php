<?php
error_reporting(0);

require_once 'vendor/autoload.php';

\VCR\VCR::configure()->setCassettePath('tests/fixtures');

require_once 'library/javichitone/lyricfy/Song.php';
require_once 'library/javichitone/lyricfy/Provider.php';
require_once 'library/javichitone/lyricfy/providers/Wikia.php';
