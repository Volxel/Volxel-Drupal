<?php

/**
 * @file
 * Contains \Drupal\volxel\Form\VolxelForm
 */

namespace Drupal\volxel\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class VolxelForm extends ConfigFormBase
{
  /**
   * {@inheritdoc }
   */
  public function getFormId()
  {
    return "volxel_form";
  }
  /**
   * {@inheritdoc }
   */
  protected function getEditableConfigNames()
  {
    return ["volxel.settings"];
  }
  /**
   * {@inheritdoc }
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form = parent::buildForm($form, $form_state);
    $config = $this->config("volxel.settings");

    $form["page_title"] = [
      '#type' => 'textfield',
      '#title' => t('Volxel Title'),
      '#default_value' => $config->get("page_title"),
      '#description' => t('I\'m just trying out Drupal'),
    ];

    return $form;
  }
  /**
   * {@inheritdoc }
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    if ($form_state->getValue("page_title") == NULL) {
      $form_state->setErrorByName("page_title", t("Please enter a valid page title."));
    }
  }
  /**
   * {@inheritdoc }
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $config = $this->config("volxel.settings");
    $config->set("volxel.page_title", $form_state->getValue("page_title"));
    return parent::submitForm($form, $form_state);
  }
}
