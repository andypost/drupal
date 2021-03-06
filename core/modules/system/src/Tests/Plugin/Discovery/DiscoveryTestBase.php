<?php

/**
 * @file
 * Contains \Drupal\system\Tests\Plugin\Discovery\DiscoveryTestBase.
 */

namespace Drupal\system\Tests\Plugin\Discovery;

use Drupal\Core\StringTranslation\TranslationWrapper;
use Drupal\simpletest\UnitTestBase;

/**
 * Base class for plugin discovery tests.
 */
abstract class DiscoveryTestBase extends UnitTestBase {

  /**
   * The discovery component to test.
   *
   * @var \Drupal\Component\Plugin\Discovery\DiscoveryInterface
   */
  protected $discovery;

  /**
   * The plugin definitions the discovery component is expected to discover.
   *
   * @var array
   */
  protected $expectedDefinitions;

  /**
   * An empty discovery component.
   *
   * This will be tested to ensure that the case where no plugin information is
   * found, is handled correctly.
   *
   * @var \Drupal\Component\Plugin\Discovery\DiscoveryInterface
   */
  protected $emptyDiscovery;

  /**
   * Tests getDefinitions() and getDefinition().
   */
  function testDiscoveryInterface() {
    // Ensure that getDefinitions() returns the expected definitions.
    // For the arrays to be identical (instead of only equal), they must be
    // sorted equally, which seems unnecessary here.
    $this->assertEqual($this->discovery->getDefinitions(), $this->expectedDefinitions);

    // Ensure that getDefinition() returns the expected definition.
    foreach ($this->expectedDefinitions as $id => $definition) {
      $this->assertDefinitionIdentical($this->discovery->getDefinition($id), $definition);
    }

    // Ensure that an empty array is returned if no plugin definitions are found.
    $this->assertIdentical($this->emptyDiscovery->getDefinitions(), array(), 'array() returned if no plugin definitions are found.');

    // Ensure that NULL is returned as the definition of a non-existing plugin.
    $this->assertIdentical($this->emptyDiscovery->getDefinition('non_existing', FALSE), NULL, 'NULL returned as the definition of a non-existing plugin.');
  }

  /**
   * Asserts a definition against an expected definition.
   *
   * Converts any instances of \Drupal\Core\Annotation\Translation to a string.
   *
   * @param array $definition
   *   The definition to test.
   * @param array $expected_definition
   *   The expected definition to test against.
   *
   * @return bool
   *   TRUE if the assertion succeeded, FALSE otherwise.
   */
  protected function assertDefinitionIdentical(array $definition, array $expected_definition) {
    $func = function (&$item){
      if ($item instanceof TranslationWrapper) {
        $item = (string) $item;
      }
    };
    array_walk_recursive($definition, $func);
    array_walk_recursive($expected_definition, $func);
    return $this->assertIdentical($definition, $expected_definition);
  }

}

