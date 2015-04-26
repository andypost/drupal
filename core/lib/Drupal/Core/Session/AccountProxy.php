<?php

/**
 * @file
 * Contains \Drupal\Core\Session\AccountProxy.
 */

namespace Drupal\Core\Session;

use Drupal\Core\Authentication\AccountProxy as AuthenticationAccountProxy;

/**
 * Provides BC wrapper for \Drupal\Core\Authentication\AccountProxy.
 *
 * @deprecated in Drupal 8.x-dev, will be removed before Drupal 8.0.0. Use
 *    \Drupal\Core\Authentication\AccountProxy instead.
 */
class AccountProxy extends AuthenticationAccountProxy {
}
