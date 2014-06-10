<?php

/**
 * @file
 * Contains \Drupal\forum\Access\RouteProcessor.
 */

namespace Drupal\forum\Access;

use Drupal\Core\RouteProcessor\OutboundRouteProcessorInterface;
use Drupal\Core\Access\CsrfTokenGenerator;
use Drupal\taxonomy\Entity\Term;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;

/**
 * Processes the inbound path by resolving it to the forum page.
 */
class RouteProcessor implements OutboundRouteProcessorInterface {

  /**
   * {@inheritdoc}
   */
  public function processOutbound(Route $route, array &$parameters) {
    if ($route->getPath() == '/taxonomy/term/{taxonomy_term}' && isset($parameters['taxonomy_term'])) {
      // Take over URI construction for taxonomy terms that are forums.
      if ($vid = \Drupal::config('forum.settings')->get('vocabulary')) {
        if (Term::load($parameters['taxonomy_term'])->bundle() == $vid) {
          $route->setPath('/forum/{taxonomy_term}');
        }
      }
    }
  }

}

