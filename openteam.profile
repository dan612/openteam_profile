<?php

/**
 * @file
 * Enables modules and site configuration for the openteam profile.
 */

// Add any custom code here, like hook implementations.

use Drupal\Core\Form\FormStateInterface;

/**
 * Implements hook_form_alter().
 */
function openteam_form_alter(&$form, FormStateInterface $form_state, $form_id) {
  // form alter for openteam

  if ($form_id === "node_player_form") {
    //
    $form[field_hockey_position]['#states']= array(
      'invisible' => array(
        ':input[id="edit-field-sport-ref-4"]' => array('checked' => FALSE),
      ),
    );

    $form[field_football_position]['#states']= array(
      'invisible' => array(
        ':input[id="edit-field-sport-ref-3"]' => array('checked' => FALSE),
      ),
    );

  }
}
