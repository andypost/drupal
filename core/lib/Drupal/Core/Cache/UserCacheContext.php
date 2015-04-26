<?php

/**
 * @file
 * Contains \Drupal\Core\Cache\UserCacheContext.
 */

namespace Drupal\Core\Cache;

use Drupal\Core\Authentication\AccountInterface;

/**
 * Defines the UserCacheContext service, for "per user" caching.
 */
class UserCacheContext implements CacheContextInterface {

  /**
   * Constructs a new UserCacheContext service.
   *
   * @param \Drupal\Core\Authentication\AccountInterface $user
   *   The current user.
   */
  public function __construct(AccountInterface $user) {
    $this->user = $user;
  }

  /**
   * {@inheritdoc}
   */
  public static function getLabel() {
    return t('User');
  }

  /**
   * {@inheritdoc}
   */
  public function getContext() {
    return "u." . $this->user->id();
  }

}
