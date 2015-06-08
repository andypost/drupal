<?php

/**
 * @file
 * Contains \Drupal\Tests\user\Unit\Plugin\Core\Entity\UserTest.
 */

namespace Drupal\Tests\user\Unit\Plugin\Core\Entity;

use Drupal\Core\Language\LanguageInterface;
use Drupal\Tests\Core\Session\UserSessionTest;
use Drupal\user\Entity\User;
  use Drupal\user\RoleInterface;

  /**
 * @coversDefaultClass \Drupal\user\Entity\User
 * @group user
 */
class UserTest extends UserSessionTest {

  /**
   * {@inheritdoc}
   */
  protected function createUserSession(array $rids = array(), $authenticated = FALSE) {
    $roles = array();
    foreach ($rids as $rid) {
      $roles[] = array(
        'target_id' => $rid,
      );
    }
    $values = ['roles' => [LanguageInterface::LANGCODE_DEFAULT => $roles]];

    $user = $this->getMockBuilder('Drupal\user\Entity\User')
      ->disableOriginalConstructor()
      ->setMethods(array('id'))
      ->getMock();

    $reflect = new \ReflectionObject($user);
    $property = $reflect->getProperty('values');
    $property->setAccessible(TRUE);
    $property->setValue($user, $values);

    $user->expects($this->any())
      ->method('id')
      // @todo Also test the uid = 1 handling.
      ->will($this->returnValue($authenticated ? 2 : 0));
    return $user;
  }

  /**
   * Tests the method getRoles exclude or include locked roles based in param.
   *
   * @see \Drupal\user\Entity\User::getRoles()
   * @covers ::getRoles
   */
  public function testUserGetRoles() {
    // Anonymous user.
    $user = $this->createUserSession(array());
    $this->assertEquals(array(RoleInterface::ANONYMOUS_ID), $user->getRoles());
    $this->assertEquals(array(), $user->getRoles(TRUE));

    // Authenticated user.
    $user = $this->createUserSession(array(), TRUE);
    $this->assertEquals(array(RoleInterface::AUTHENTICATED_ID), $user->getRoles());
    $this->assertEquals(array(), $user->getRoles(TRUE));
  }

}
