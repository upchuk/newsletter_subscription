<?php

namespace Drupal\database_subscriber\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the database subscriber entity edit forms.
 */
class DatabaseSubscriberForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $entity = $this->getEntity();
    $result = $entity->save();
    $link = $entity->toLink($this->t('View'))->toRenderable();

    $message_arguments = ['%label' => $this->entity->label()];
    $logger_arguments = $message_arguments + ['link' => render($link)];

    if ($result == SAVED_NEW) {
      $this->messenger()->addStatus($this->t('New database subscriber %label has been created.', $message_arguments));
      $this->logger('database_subscriber')->notice('Created new database subscriber %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The database subscriber %label has been updated.', $message_arguments));
      $this->logger('database_subscriber')->notice('Updated new database subscriber %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.database_subscription.canonical', ['database_subscriber' => $entity->id()]);
  }

}
