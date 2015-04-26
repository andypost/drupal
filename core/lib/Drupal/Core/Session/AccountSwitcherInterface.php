<?php

/**
 * @file
 * Contains \Drupal\Core\Session\AccountSwitcherInterface.
 */

namespace Drupal\Core\Session;

use Drupal\Core\Authentication\AccountSwitcherInterface as AuthenticationAccountSwitcherInterface;

/**
 * Provides BC wrapper for \Drupal\Core\Authentication\AccountSwitcherInterface.
 *
 * @deprecated in Drupal 8.x-dev, will be removed before Drupal 8.0.0. Use
 *    \Drupal\Core\Authentication\AccountSwitcherInterface instead.
 */
interface AccountSwitcherInterface extends AuthenticationAccountSwitcherInterface {
}
