<?php

/**
 * @file
 * Contains \Drupal\forum\Access\RouteProcessor.
 */

namespace Drupal\forum\Access;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\RouteProcessor\OutboundRouteProcessorInterface;
use Drupal\taxonomy\Entity\Term;
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
   * Constructs a RouteProcessor object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   */
  function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * {@inheritdoc}
   */
  public function processOutbound(Route $route, array &$parameters) {
    // @todo Check the route machine name here https://drupal.org/node/2283851
    if ($route->getPath() == '/taxonomy/term/{taxonomy_term}' && !empty($parameters['taxonomy_term'])) {
      // Take over URI construction for taxonomy terms that are forums.
      if ($vid = $this->configFactory->get('forum.settings')->get('vocabulary')) {
        if (Term::load($parameters['taxonomy_term'])->getVocabularyId() == $vid) {
          $route->setPath('/forum/{taxonomy_term}');
        }
      }
    }
  }

}
