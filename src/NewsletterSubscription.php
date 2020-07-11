<?php

namespace Drupal\newsletter_subscription;

/**
 * Value object that holds the data necessary for the newsletter subscription.
 */
class NewsletterSubscription {

  /**
   * The email to subscribe.
   *
   * @var string
   */
  protected $email;

  /**
   * Extra data about the subscription.
   *
   * @var array
   */
  protected $data;

  /**
   * NewsletterSubscription constructor.
   *
   * @param $email
   */
  public function __construct($email) {
    $this->email = $email;
  }

  /**
   * @return array
   */
  public function getData() {
    return $this->data;
  }

  /**
   * @param array $data
   */
  public function setData($data) {
    $this->data = $data;
  }

  /**
   * @return string
   */
  public function getEmail() {
    return $this->email;
  }

}
