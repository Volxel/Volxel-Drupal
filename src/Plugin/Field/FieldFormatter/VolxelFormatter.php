<?php

namespace Drupal\volxel\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\Annotation\FieldFormatter;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\file\FileInterface;


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

    $zip_url = NULL;
    $json_url = NULL;
    $exr_url = NULL;

    $unused_urls = [];

    foreach ($items as $delta => $item) {
      /** @var \Drupal\file\Entity\File $file */
      $file = $item->entity;
      if (!$file) {
        continue;
      }

      $uri = $file->getFileUri();
      $filename = $file->getFileName();
      $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

      $mime = $file->getMimeType();

      if (empty($mime)) {
        $mime = \Drupal::service("file.mime_type.guesser")->guess($uri) ?? "";
      }

      $mime = strtolower($mime);

      $url = \Drupal::service("file_url_generator")->generateAbsoluteString($file->getFileUri());

      if (in_array($mime, ["application/zip", "application/x-zip-compressed"]) || $ext === "zip") {
        $zip_url = $url;
      } elseif (strpos($mime, "json") !== FALSE || $ext === "json") {
        $json_url = $url;
      } elseif ($ext === "exr" || strpos($mime, "exr") !== FALSE) {
        $exr_url = $url;
      } else {
        $unused_urls[] = $uri;
      }
    }

    $unique_id = \Drupal\Component\Utility\Html::getUniqueId("volxel-viewer");
    $elements[] = [
      "#theme" => "volxel_viewer",
      "#zip_url" => $zip_url,
      "#json_url" => $json_url,
      "#exr_url" => $exr_url,
      "#unused_urls" => $unused_urls,
      "#unique_id" => $unique_id,
      "#attached" => [
        "library" => ["volxel/volxel_3d_viewer"]
      ]
    ];

    return $elements;
  }
}
