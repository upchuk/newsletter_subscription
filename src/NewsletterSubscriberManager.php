<?php

namespace Drupal\newsletter_subscription;

/**
 * Collects newsletter subscribers and delegates the subscription to them.
 */
class NewsletterSubscriberManager implements NewsletterSubscriberInterface {

  /**
   * The collected subscribers.
   *
   * @var \Drupal\newsletter_subscription\NewsletterSubscriberInterface[]
   */
  protected $subscribers;

  /**
   * @param \Drupal\newsletter_subscription\NewsletterSubscriberInterface $subscriber
   * @param $priority
   */
  public function addSubscriber(NewsletterSubscriberInterface $subscriber, $priority) {
    $this->subscribers[$priority] = $subscriber;
  }

  /**
   * {@inheritdoc}
   */
  public function subscribeContact(NewsletterSubscription $subscription) {
    foreach ($this->subscribers as $subscriber) {
      $subscriber->subscribeContact($subscription);
    }
  }

}
