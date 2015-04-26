<?php

/**
 * @file
 * Contains \Drupal\Tests\Core\Authentication\AnonymousUserTest.
 */

namespace Drupal\Tests\Core\Authentication;

use Drupal\Tests\UnitTestCase;
use Drupal\Core\Authentication\AnonymousUser;
use Drupal\user\RoleInterface;

/**
 * @coversDefaultClass \Drupal\Core\Authentication\AnonymousUser
 * @group Session
 */
class AnonymousUserTest extends UnitTestCase {

  /**
   * Tests the method getRoles exclude or include locked roles based in param.
   *
   * @covers ::getRoles
   * @todo Move roles constants to a class/interface
   */
  public function testUserGetRoles() {
    $anonymous_user = new AnonymousUser();
    $this->assertEquals(array(RoleInterface::ANONYMOUS_ID), $anonymous_user->getRoles());
    $this->assertEquals(array(), $anonymous_user->getRoles(TRUE));
  }

}
