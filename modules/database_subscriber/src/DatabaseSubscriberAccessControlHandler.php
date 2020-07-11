<?php

namespace Drupal\database_subscriber;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Defines the access control handler for the database subscriber entity type.
 */
class DatabaseSubscriberAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view database subscriber');

      case 'update':
        return AccessResult::allowedIfHasPermissions($account, ['edit database subscriber', 'administer database subscriber'], 'OR');

      case 'delete':
        return AccessResult::allowedIfHasPermissions($account, ['delete database subscriber', 'administer database subscriber'], 'OR');

      default:
        // No opinion.
        return AccessResult::neutral();
    }

  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermissions($account, ['create database subscriber', 'administer database subscriber'], 'OR');
  }

}
