<?php

namespace Drupal\database_subscriber;

use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Provides an interface defining a database subscriber entity type.
 */
interface DatabaseSubscriberInterface extends ContentEntityInterface {

  /**
   * Gets the database subscriber creation timestamp.
   *
   * @return int
   *   Creation timestamp of the database subscriber.
   */
  public function getCreatedTime();

  /**
   * Sets the database subscriber creation timestamp.
   *
   * @param int $timestamp
   *   The database subscriber creation timestamp.
   *
   * @return \Drupal\database_subscriber\DatabaseSubscriberInterface
   *   The called database subscriber entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the database subscriber status.
   *
   * @return bool
   *   TRUE if the database subscriber is enabled, FALSE otherwise.
   */
  public function isEnabled();

  /**
   * Sets the database subscriber status.
   *
   * @param bool $status
   *   TRUE to enable this database subscriber, FALSE to disable.
   *
   * @return \Drupal\database_subscriber\DatabaseSubscriberInterface
   *   The called database subscriber entity.
   */
  public function setStatus($status);

  /**
   * Returns the email.
   *
   * @return string
   */
  public function getEmail();

  /**
   * Returns the extra data.
   *
   * @return array
   */
  public function getData();

}
