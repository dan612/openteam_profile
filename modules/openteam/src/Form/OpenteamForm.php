<?php

/**
 * @file
 * Contains \.
 */

namespace Drupal\openteam\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class OpenteamForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */

  public function getFormId() {
    return 'openteam_form';
  }

  /**
   * {@inheritdoc}
   */

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = parent::buildForm($form, $form_state);
    $config = $this->config('openteam.settings');

    $tax = 'Sports';
    $terms = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree($tax);
    $sports = array();

    foreach ($terms as $term => $val) {
      $sports[$term] = $val->name;
    }

    $form['sports'] = array(
      '#type' => 'checkboxes',
      '#title' => $this->t('Sports'),
      '#options' => $sports,
      '#default_value' => $config->get('openteam.sports'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */

  public function gatherData(){
    dsm("nice");
  }

  /**
   * {@inheritdoc}
   */

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('openteam.settings');
    $values = $form_state->getValue('sports');
    $config_vals = array();

    foreach ($values as $val) {
      if ($val != null) {
        $config_vals[] = $val;
      }
    }
    
    $config->set('openteam.sports', $config_vals);
    $config->save();

    return parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */

  protected function getEditableConfigNames() {
    return [
      'openteam.settings',
    ];
  }
}
