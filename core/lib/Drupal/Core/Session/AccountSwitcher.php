<?php

/**
 * @file
 * Contains \Drupal\Core\Session\AccountSwitcher.
 */

namespace Drupal\Core\Session;

use Drupal\Core\Authentication\AccountSwitcher as AuthenticationAccountSwitcher;

/**
 * Provides BC wrapper for \Drupal\Core\Authentication\AccountSwitcher.
 *
 * @deprecated in Drupal 8.x-dev, will be removed before Drupal 8.0.0. Use
 *    \Drupal\Core\Authentication\AccountSwitcher instead.
 */
class AccountSwitcher extends AuthenticationAccountSwitcher {
}
