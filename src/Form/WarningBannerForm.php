<?php

namespace Drupal\gov_site_warning\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Settings form for Commerce Repeat Order.
 */
class WarningBannerForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'gov_site_warning.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'gov_site_warning_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('gov_site_warning.settings');

    $form['banner_message'] = [
      '#title' => $this->t("US government warning banner message"),
      '#description' => $this->t("Text displayed in modal pop up"),
      '#type' => 'text_format',
      '#required' => TRUE,
      '#default_value' => $config->get('banner_message'),
      '#format' => $config->get('banner_message_format'),
    ];

    $form['display_banner'] = [
      '#title' => $this->t("Show/Hide Government site banner"),
      '#description' => $this->t("Show or hide the pop up."),
      '#type' => 'checkbox',
      '#default_value' => $config->get('display_banner'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $formatted_text = $form_state->getValue('banner_message');
    $this->config('gov_site_warning.settings')
      ->set('banner_message', $formatted_text['value'])
      ->set('display_banner', $form_state->getValue('display_banner'))
      ->set('banner_message_format', $formatted_text['format'])
      ->save();

    parent::submitForm($form, $form_state);
  }

}
