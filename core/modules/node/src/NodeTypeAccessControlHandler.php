<?php

/**
 * @file
 * Contains \Drupal\taxonomy\NodeTypeAccessControlHandler.
 */

namespace Drupal\node;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Authentication\AccountInterface;

/**
 * Defines the access control handler for the node type entity type.
 *
 * @see \Drupal\node\Entity\NodeType
 */
class NodeTypeAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, $langcode, AccountInterface $account) {
    if ($operation == 'delete') {
      if ($entity->isLocked()) {
        return AccessResult::forbidden()->cacheUntilEntityChanges($entity);
      }
      else {
        return parent::checkAccess($entity, $operation, $langcode, $account)->cacheUntilEntityChanges($entity);
      }
    }
    return parent::checkAccess($entity, $operation, $langcode, $account);
  }

}
