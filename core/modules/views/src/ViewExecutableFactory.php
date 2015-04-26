<?php

/**
 * @file
 * Contains \Drupal\views\ViewExecutableFactory.
 */

namespace Drupal\views;

use Drupal\Core\Routing\RouteProviderInterface;
use Drupal\Core\Authentication\AccountInterface;
use Drupal\views\ViewEntityInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Defines the cache backend factory.
 */
class ViewExecutableFactory {

  /**
   * Stores the current user.
   *
   * @var \Drupal\Core\Authentication\AccountInterface
   */
  protected $user;

  /**
   * The request stack.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;

  /**
   * The views data.
   *
   * @var \Drupal\views\ViewsData
   */
  protected $viewsData;

  /**
   * The route provider.
   *
   * @var \Drupal\Core\Routing\RouteProviderInterface
   */
  protected $routeProvider;

  /**
   * Constructs a new ViewExecutableFactory
   *
   * @param \Drupal\Core\Authentication\AccountInterface $user
   *   The current user.
   * @param \Symfony\Component\HttpFoundation\RequestStack $request_stack
   *   The request stack.
   * @param \Drupal\views\ViewsData $views_data
   *   The views data.
   * @param \Drupal\Core\Routing\RouteProviderInterface $route_provider
   *   The route provider.
   */
  public function __construct(AccountInterface $user, RequestStack $request_stack, ViewsData $views_data, RouteProviderInterface $route_provider) {
    $this->user = $user;
    $this->requestStack = $request_stack;
    $this->viewsData = $views_data;
    $this->routeProvider = $route_provider;
  }

  /**
   * Instantiates a ViewExecutable class.
   *
   * @param \Drupal\views\ViewEntityInterface $view
   *   A view entity instance.
   *
   * @return \Drupal\views\ViewExecutable
   *   A ViewExecutable instance.
   */
  public function get(ViewEntityInterface $view) {
    $view = new ViewExecutable($view, $this->user, $this->viewsData, $this->routeProvider);
    $view->setRequest($this->requestStack->getCurrentRequest());
    return $view;
  }

}
