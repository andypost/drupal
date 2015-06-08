<?php

/**
 * @file
 * Contains \Drupal\Core\Session\AnonymousUserSession.
 */

namespace Drupal\Core\Session;

use Drupal\Core\Authentication\AnonymousUser;

/**
 * Provides BC wrapper for \Drupal\Core\Authentication\AnonymousUser.
 *
 * @deprecated in Drupal 8.x-dev, will be removed before Drupal 8.0.0. Use
 *   \Drupal\Core\Authentication\AnonymousUser instead.
 */
class AnonymousUserSession extends AnonymousUser {
}
