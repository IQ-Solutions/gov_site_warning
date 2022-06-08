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

    $form['display_banner'] = [
      '#title' => $this->t("Enable government site banner"),
      '#description' => $this->t("Enable the pop up display."),
      '#type' => 'checkbox',
      '#default_value' => $config->get('display_banner'),
    ];

    $form['always_show'] = [
      '#title' => $this->t("Banner should always display."),
      '#description' => $this->t("Warning banner will always display regardless of how often the user visits the site."),
      '#type' => 'checkbox',
      '#default_value' => !empty($config->get('always_show')) ?
      $config->get('always_show') : 0,
    ];

    $form['banner_message'] = [
      '#title' => $this->t("US government warning banner message"),
      '#description' => $this->t("Text displayed in modal pop up"),
      '#type' => 'text_format',
      '#required' => TRUE,
      '#default_value' => $config->get('banner_message'),
      '#format' => $config->get('banner_message_format'),
    ];

    $form['filter_by_path'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Display banner on the listed paths.'),
      '#description' => $this->t('Enter a new path on each line. To include sub-paths add an asterisk Example: <br>"&lt;front&gt;": front page<br>"/example": only this page<br>"/example/*": this page and pages below it<br>"!/example": not on this page'),
      '#default_value' => $config->get('filter_by_path'),
      '#format' => 'plain_text',
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
      ->set('filter_by_path', $form_state->getValue('filter_by_path'))
      ->set('always_show', $form_state->getValue('always_show'))
      ->set('banner_message_format', $formatted_text['format'])
      ->save();

    parent::submitForm($form, $form_state);
  }

}
