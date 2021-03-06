<?php

namespace Drupal\newsletter_subscription\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Subscription opt in edit forms.
 *
 * @ingroup newsletter_subscription
 */
class SubscriptionOptInForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = &$this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addStatus($this->t('Created the %label Subscription opt in.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        $this->messenger()->addStatus($this->t('Saved the %label Subscription opt in.', [
          '%label' => $entity->label(),
        ]));
    }

    $form_state->setRedirect('entity.subscription_opt_in.canonical', ['subscription_opt_in' => $entity->id()]);
  }

}
