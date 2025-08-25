<?php

namespace Drupal\volxel\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use \Drupal\file\Plugin\Field\FieldWidget\FileWidget;

/**
 * @FieldWidget(
 *   id = "volxel_3d_viewer",
 *   label = @Translation("Volxel File Widget"),
 *   field_types = {
 *     "file"
 *   }
 * )
 */
class VolxelWidget extends FileWidget
{
  public static function defaultSettings()
  {
    return parent::defaultSettings();
  }

  public function settingsForm(array $form, FormStateInterface $form_state)
  {
    dpm($form);
    return parent::settingsForm($form, $form_state);
  }

  public function widgetFormElements(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    dpm($form);
    $elements = parent::widgetFormElements($items, $delta, $element, $form, $form_state);

    return $elements;
  }
}
