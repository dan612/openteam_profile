<?php
/**
 * @file
 * Contains \Drupal\openteam\Controller\HelloController.
 */
namespace Drupal\openteam\Controller;

class HelloController {
  public function content() {
    return array(
      '#type' => 'markup',
      '#markup' => t('Hello, World!'),
    );
  }
}
