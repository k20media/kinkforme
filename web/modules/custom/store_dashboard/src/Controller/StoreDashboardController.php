<?php

namespace Drupal\store_dashboard\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Security\TrustedCallbackInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class StoreDashboardController extends ControllerBase implements TrustedCallbackInterface {

  protected $formBuilder;

  public function __construct(FormBuilderInterface $formBuilder) {
    $this->formBuilder = $formBuilder;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('form_builder')
    );
  }

  public function dashboardPage() {
    // Ensure you use the fully qualified namespace of the form class
    $form = $this->formBuilder->getForm('Drupal\commerce_order\Form\DashboardMetricsForm');
    return $form;
  }

  // Implement the TrustedCallbackInterface
  public static function trustedCallbacks() {
    return ['adjustForm'];
  }

  public function adjustForm(array $form) {
    //if (isset($form['filters']['store_id'])) {
        unset($form['filters']);
    //}
    return $form;
  }
}
