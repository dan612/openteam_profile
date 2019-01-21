<?php

namespace dan612\OpenTEAM\Composer;

use Composer\Script\Event;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;

/**
 * Updates the version number in OpenTEAM's component info files.
 */
class ReleaseVersion {

  /**
   * Script entry point.
   *
   * @param \Composer\Script\Event $event
   *   The script event.
   */
  public static function execute(Event $event) {
    $arguments = $event->getArguments();
    $version = reset($arguments);

    // Find all .info files in OpenTEAM...except in the installed code base.
    $finder = (new Finder())
      ->name('*.info.yml')
      ->in('.')
      ->exclude('docroot');

    /** @var \Symfony\Component\Finder\SplFileInfo $info_file */
    foreach ($finder as $info_file) {
      $info = Yaml::parse($info_file->getContents());

      // Wrapping the version number in << and >> will cause the dumper to quote
      // the string, which is necessary for compliance with the strict PECL
      // parser.
      $info['version'] = '<<' . $version . '>>';
      $info = Yaml::dump($info, 2, 2);
      // Now that the version number will be quoted, strip out the << and >>
      // escape sequence.
      $info = str_replace(['<<', '>>'], NULL, $info);

      file_put_contents($info_file->getPathname(), $info);
    }
  }

}
