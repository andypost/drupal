<?php

/**
 * @file
 * Contains \Drupal\Core\Session\AccountProxyInterface.
 */

namespace Drupal\Core\Session;

use Drupal\Core\Authentication\AccountProxyInterface as AuthenticationAccountProxyInterface;

/**
 * Provides BC wrapper for \Drupal\Core\Authentication\AccountProxyInterface.
 *
 * @deprecated in Drupal 8.x-dev, will be removed before Drupal 8.0.0. Use
 *    \Drupal\Core\Authentication\AccountProxyInterface instead.
 */
interface AccountProxyInterface extends AuthenticationAccountProxyInterface {
}
