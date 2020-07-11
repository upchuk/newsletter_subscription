<?php

namespace Drupal\database_subscriber;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\newsletter_subscription\NewsletterSubscriberInterface;
use Drupal\newsletter_subscription\NewsletterSubscription;

/**
 * Database newsletter subscriber.
 */
class DatabaseSubscriber implements NewsletterSubscriberInterface {

  use StringTranslationTrait;

  /**
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * DatabaseSubscriber constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * {@inheritdoc}
   */
  public function subscribeContact(NewsletterSubscription $subscription) {
    $this->entityTypeManager->getStorage('database_subscription')->create([
      'email' => $subscription->getEmail(),
      'data' => serialize($subscription->getData()),
      'status' => TRUE,
    ])->save();
  }
}
