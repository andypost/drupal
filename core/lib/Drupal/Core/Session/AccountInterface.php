<?php

/**
 * @file
 * Contains \Drupal\Core\Session\AccountInterface.
 */

namespace Drupal\Core\Session;

use Drupal\Core\Authentication\AccountInterface as AuthenticationAccountInterface;

/**
 * Provides BC wrapper for \Drupal\Core\Authentication\AccountInterface.
 *
 * @deprecated in Drupal 8.x-dev, will be removed before Drupal 8.0.0. Use
 *    \Drupal\Core\Authentication\AccountInterface instead.
 */
interface AccountInterface extends AuthenticationAccountInterface {
}
