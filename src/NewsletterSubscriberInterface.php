<?php

namespace Drupal\newsletter_subscription;

/**
 * Interface used by newsletter subscribers to subscribe contacts.
 */
interface NewsletterSubscriberInterface {

  /**
   * Subscribes a contact to all the registered subscribers.
   *
   * @param NewsletterSubscription $subscription
   */
  public function subscribeContact(NewsletterSubscription $subscription);
}
