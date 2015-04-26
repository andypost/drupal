<?php

/**
 * @file
 * Contains \Drupal\Core\Authentication\AnonymousUserSession.
 */

namespace Drupal\Core\Authentication;

use Drupal\Core\Session\UserSession;

/**
 * An account implementation representing an anonymous user.
 */
class AnonymousUserSession extends UserSession {

  /**
   * Constructs a new anonymous user session.
   *
   * Intentionally don't allow parameters to be passed in like UserSession.
   */
  public function __construct() {
  }

}