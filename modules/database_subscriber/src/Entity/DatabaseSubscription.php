<?php

namespace Drupal\database_subscriber\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\database_subscriber\DatabaseSubscriberInterface;

/**
 * Defines the database subscription entity class.
 *
 * @ContentEntityType(
 *   id = "database_subscription",
 *   label = @Translation("Database Subscription"),
 *   label_collection = @Translation("Database Subscriptions"),
 *   handlers = {
 *     "view_builder" = "Drupal\database_subscriber\DatabaseSubscriberViewBuilder",
 *     "list_builder" = "Drupal\database_subscriber\DatabaseSubscriberListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\database_subscriber\DatabaseSubscriberAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\database_subscriber\Form\DatabaseSubscriberForm",
 *       "edit" = "Drupal\database_subscriber\Form\DatabaseSubscriberForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   base_table = "database_subscription",
 *   admin_permission = "access database subscription overview",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "email",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/database-subscription/add",
 *     "canonical" = "/database-subscription/{database_subscription}",
 *     "edit-form" = "/admin/structure/database-subscription/{database_subscription}/edit",
 *     "delete-form" = "/admin/structure/database-subscription/{database_subscription}/delete",
 *     "collection" = "/admin/content/database-subscription"
 *   },
 * )
 */
class DatabaseSubscription extends ContentEntityBase implements DatabaseSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public function isEnabled() {
    return (bool) $this->get('status')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setStatus($status) {
    $this->set('status', $status);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * @inheritDoc
   */
  public function getEmail() {
    return $this->get('email')->value;
  }

  /**
   * @inheritDoc
   */
  public function getData() {
    return unserialize($this->get('data')->value);
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Status'))
      ->setDescription(t('A boolean indicating whether the database subscriber is enabled.'))
      ->setDefaultValue(TRUE)
      ->setSetting('on_label', 'Enabled')
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'settings' => [
          'display_label' => FALSE,
        ],
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'boolean',
        'label' => 'above',
        'weight' => 0,
        'settings' => [
          'format' => 'enabled-disabled',
        ],
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['email'] = BaseFieldDefinition::create('email')
      ->setLabel(t('Email'))
      ->setDescription(t('The email to subscribe.'))
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'type' => 'basic_string',
        'label' => 'above',
        'weight' => 0,
      ]);

    $fields['data'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Data'))
      ->setDescription(t('Extra data from the subscription'))
      ->setSettings(array(
        'text_processing' => 0,
      ));

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Authored on'))
      ->setDescription(t('The time that the database subscriber was created.'))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'timestamp',
        'weight' => 20,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('form', [
        'type' => 'datetime_timestamp',
        'weight' => 20,
      ])
      ->setDisplayConfigurable('view', TRUE);

    return $fields;
  }

}
