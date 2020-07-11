<?php

namespace Drupal\database_subscriber;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityViewBuilder;

/**
 * Provides a view controller for a database subscriber entity type.
 */
class DatabaseSubscriberViewBuilder extends EntityViewBuilder {

  /**
   * {@inheritdoc}
   */
  protected function getBuildDefaults(EntityInterface $entity, $view_mode) {
    $build = parent::getBuildDefaults($entity, $view_mode);
    // The database subscriber has no entity template itself.
    unset($build['#theme']);
    return $build;
  }

}
