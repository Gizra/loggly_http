<?php

/**
 * @file
 * Contains \Drupal\logs_http\EventSubscriber\LogsHttpEventSubscriber.
 */

namespace Drupal\logs_http\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class LogsHttpEventSubscriber implements EventSubscriberInterface {

  /**
   * Initializes logs_http module requirements.
   *
   * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
   *  The event to process.
   */
  public function onRequest(GetResponseEvent $event) {
    drupal_register_shutdown_function('logs_http_shutdown');
    set_exception_handler('_logs_http_exception_handler');
  }

  /**
   * Implements EventSubscriberInterface::getSubscribedEvents().
   *
   * @return array
   *   An array of event listener definitions.
   */
  static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = array('onRequest');

    return $events;
  }

}
