<?php

namespace Drupal\newsletter_subscription\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Subscription opt in entities.
 *
 * @ingroup newsletter_subscription
 */
interface SubscriptionOptInInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  /**
   * Gets the Subscription opt in name.
   *
   * @return string
   *   Name of the Subscription opt in.
   */
  public function getName();

  /**
   * Sets the Subscription opt in name.
   *
   * @param string $name
   *   The Subscription opt in name.
   *
   * @return \Drupal\newsletter_subscription\Entity\SubscriptionOptInInterface
   *   The called Subscription opt in entity.
   */
  public function setName($name);

  /**
   * Gets the Subscription opt in creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Subscription opt in.
   */
  public function getCreatedTime();

  /**
   * Sets the Subscription opt in creation timestamp.
   *
   * @param int $timestamp
   *   The Subscription opt in creation timestamp.
   *
   * @return \Drupal\newsletter_subscription\Entity\SubscriptionOptInInterface
   *   The called Subscription opt in entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Subscription opt in published status indicator.
   *
   * Unpublished Subscription opt in are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Subscription opt in is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Subscription opt in.
   *
   * @param bool $published
   *   TRUE to set this Subscription opt in to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\newsletter_subscription\Entity\SubscriptionOptInInterface
   *   The called Subscription opt in entity.
   */
  public function setPublished($published);

}
