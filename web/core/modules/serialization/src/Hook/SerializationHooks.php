<?php

namespace Drupal\serialization\Hook;

use Drupal\Core\Url;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Hook\Attribute\Hook;

/**
 * Hook implementations for serialization.
 */
class SerializationHooks {

  /**
   * Implements hook_help().
   */
  #[Hook('help')]
  public function help($route_name, RouteMatchInterface $route_match) {
    switch ($route_name) {
      case 'help.page.serialization':
        $output = '';
        $output .= '<h2>' . t('About') . '</h2>';
        $output .= '<p>' . t('The Serialization module provides a service for serializing and deserializing data to and from formats such as JSON and XML.') . '</p>';
        $output .= '<p>' . t('Serialization is the process of converting data structures like arrays and objects into a string. This allows the data to be represented in a way that is easy to exchange and store (for example, for transmission over the Internet or for storage in a local file system). These representations can then be deserialized to get back to the original data structures.') . '</p>';
        $output .= '<p>' . t('The serializer splits this process into two parts. Normalization converts an object to a normalized array structure. Encoding takes that array and converts it to a string.') . '</p>';
        $output .= '<p>' . t('This module does not have a user interface. It is used by other modules which need to serialize data, such as <a href=":rest">REST</a>.', [
          ':rest' => \Drupal::moduleHandler()->moduleExists('rest') ? Url::fromRoute('help.page', [
            'name' => 'rest',
          ])->toString() : '#',
        ]) . '</p>';
        $output .= '<p>' . t('For more information, see the <a href=":doc_url">online documentation for the Serialization module</a>.', [':doc_url' => 'https://www.drupal.org/documentation/modules/serialization']) . '</p>';
        return $output;
    }
  }

}
