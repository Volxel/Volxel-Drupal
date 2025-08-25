<?php

namespace Drupal\volxel\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;


/**
 * @FieldFormatter(
 *   id = "volxel_formatter",
 *   label = @Translation("Volxel Formatter"),
 *   field_types = {
 *     "file"
 *   }
 * )
 */
class VolxelFormatter extends FormatterBase
{
  public function viewElements(FieldItemListInterface $items, $langcode)
  {
    $elements = [];

    $urls = [];
    foreach ($items as $delta => $item) {
      $file = $item->entity;
      if ($file) {
        $urls[] = \Drupal::service("file_url_generator")->generateAbsoluteString($file->getFileUri());
      }
    }

    $unique_id = \Drupal\Component\Utility\Html::getUniqueId("volxel-viewer");
    $elements[] = [
      "#theme" => "volxel_viewer",
      "#urls" => $urls,
      "#unique_id" => $unique_id,
      "#attached" => [
        "library" => ["volxel/volxel_3d_viewer"]
      ]
    ];

    return $elements;
  }
}
