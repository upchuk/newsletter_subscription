<?php

namespace Drupal\newsletter_subscription\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Url;
use Drupal\newsletter_subscription\Exception\PublicNewsletterSubscriptionException;
use Drupal\newsletter_subscription\NewsletterSubscriberInterface;
use Drupal\newsletter_subscription\NewsletterSubscription;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Controller class that handles the callback for optin emails.
 */
class NewsletterController extends ControllerBase {

  /**
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * @var \Drupal\newsletter_subscription\NewsletterSubscriberInterface
   */
  protected $newsletterSubscriber;

  /**
   * Constructor
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   * @param \Drupal\newsletter_subscription\NewsletterSubscriberInterface $newsletterSubscriber
   * @param \Drupal\Core\Form\FormBuilderInterface $formBuilder
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager, NewsletterSubscriberInterface $newsletterSubscriber, FormBuilderInterface $formBuilder, MessengerInterface $messenger) {
    $this->entityTypeManager = $entityTypeManager;
    $this->newsletterSubscriber = $newsletterSubscriber;
    $this->formBuilder = $formBuilder;
    $this->messenger = $messenger;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('newsletter_subscription.subscriber_manager'),
      $container->get('form_builder'),
      $container->get('messenger')
    );
  }

  /**
   * Subscribes the contact as a reaction to their opt-in.
   *
   * @param $token
   *
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
  public function handleOptIn($token) {
    $optin = $this->entityTypeManager->getStorage('subscription_opt_in')->loadByProperties(['token' => $token]);
    if (!$optin) {
      throw new NotFoundHttpException();
    }

    $optin = reset($optin);
    $subscription = new NewsletterSubscription($optin->get('email')->value);

    $url = Url::fromRoute('<front>');
    $response = new RedirectResponse($url->toString());

    try {
      $this->newsletterSubscriber->subscribeContact($subscription);
    }
    catch (PublicNewsletterSubscriptionException $e) {
      $this->messenger->addError($e->getMessage());
      return $response;
    }

    $this->messenger->addMessage($this->t('You have been subscribed to our mailing list.'));
    $this->entityTypeManager->getStorage('subscription_opt_in')->delete([$optin]);
    return $response;
  }

}
