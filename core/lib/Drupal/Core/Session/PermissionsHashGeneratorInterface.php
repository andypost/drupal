<?php

/**
 * @file
 * Contains Drupal\Core\Session\PermissionsHashGeneratorInterface.
 */

namespace Drupal\Core\Session;
use Drupal\Core\Authentication\AccountInterface;

/**
 * Defines the user permissions hash generator interface.
 */
interface PermissionsHashGeneratorInterface {

  /**
   * Generates a hash that uniquely identifies a user's permissions.
   *
   * @param \Drupal\Core\Authentication\AccountInterface $account
   *   The user account for which to get the permissions hash.
   *
   * @return string
   *   A permissions hash.
   */
  public function generate(AccountInterface $account);

}
