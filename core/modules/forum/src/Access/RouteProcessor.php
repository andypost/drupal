<?php

/**
 * @file
 * Contains \Drupal\forum\Access\RouteProcessor.
 */

namespace Drupal\forum\Access;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\Core\RouteProcessor\OutboundRouteProcessorInterface;
use Symfony\Component\Routing\Route;

/**
 * Processes the inbound path by resolving it to the forum page.
 */
class RouteProcessor implements OutboundRouteProcessorInterface {

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface $configFactory
   */
  protected $configFactory;

  /**
   * Entity manager service.
   *
   * @var \Drupal\Core\Entity\EntityManagerInterface
   */
  protected $entityManager;

  /**
   * Constructs a RouteProcessor object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   * @param \Drupal\Core\Entity\EntityManagerInterface $entity_manager
   *   The entity manager service.
   */
  function __construct(ConfigFactoryInterface $config_factory, EntityManagerInterface $entity_manager) {
    $this->configFactory = $config_factory;
    $this->entityManager = $entity_manager;
  }

  /**
   * {@inheritdoc}
   */
  public function processOutbound(Route $route, array &$parameters) {
    // @todo Check the route machine name here https://drupal.org/node/2283851
    if ($route->getPath() == '/taxonomy/term/{taxonomy_term}' && !empty($parameters['taxonomy_term'])) {
      // Take over URI construction for taxonomy terms that are forums.
      if ($vid = $this->configFactory->get('forum.settings')->get('vocabulary')) {
        if ($this->entityManager->getStorage('taxonomy_term')->load($parameters['taxonomy_term'])->getVocabularyId() == $vid) {
          $route->setPath('/forum/{taxonomy_term}');
        }
      }
    }
  }

}
