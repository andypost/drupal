<?php

/**
 * @file
 * Contains \Drupal\Core\Authentication\AccountProxyInterface.
 */

namespace Drupal\Core\Authentication;

/**
 * Defines an interface for a service which has the current account stored.
 *
 * @ingroup user_api
 */
interface AccountProxyInterface extends AccountInterface {

  /**
   * Sets the currently wrapped account.
   *
   * Setting the current account is highly discouraged! Instead, make sure to
   * inject the desired user object into the dependent code directly.
   *
   * A preferable method of account impersonation is to use
   * \Drupal\Core\Authentication\AccountSwitcherInterface::switchTo() and
   * \Drupal\Core\Authentication\AccountSwitcherInterface::switchBack().
   *
   * @param \Drupal\Core\Authentication\AccountInterface $account
   *   The current account.
   */
  public function setAccount(AccountInterface $account);

  /**
   * Gets the currently wrapped account.
   *
   * @return \Drupal\Core\Authentication\AccountInterface
   *   The current account.
   */
  public function getAccount();

  /**
   * Sets the id of the initial account.
   *
   * Never use this method, its sole purpose is to work around weird effects
   * during mid-request container rebuilds.
   *
   * @param int $account_id
   *   The id of the initial account.
   */
  public function setInitialAccountId($account_id);

}
