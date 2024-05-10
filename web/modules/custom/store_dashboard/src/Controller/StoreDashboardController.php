<?php

namespace Drupal\store_dashboard\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Form\FormBuilderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Url;

/**
 * Controller for the store dashboard.
 */
class StoreDashboardController extends ControllerBase {

    /**
     * The form builder.
     *
     * @var \Drupal\Core\Form\FormBuilderInterface
     */
    protected $formBuilder;

    /**
     * Constructs a new StoreDashboardController.
     *
     * @param \Drupal\Core\Form\FormBuilderInterface $formBuilder
     *   The form builder.
     */
    public function __construct(FormBuilderInterface $formBuilder) {
        $this->formBuilder = $formBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container) {
        return new static(
            $container->get('form_builder')
        );
    }

    /**
     * Render the custom dashboard metrics form.
     *
     * @return array
     *   A Drupal form render array.
     */
    public function dashboardPage() {
      $form = $this->formBuilder->getForm('Drupal\store_dashboard\Form\CustomDashboardMetricsForm');
      return $form;
    }

    public function redirectToUserStore() {
      $store_service = \Drupal::service('commerce_marketplace.current_user_store');
      $store_id = $store_service->getCurrentUserStoreId();

      if ($store_id) {
        // Generate the direct URL to the store page
        $url = Url::fromUri('internal:/store/' . $store_id)->toString();
        return new RedirectResponse($url);
      }
      else {
        // Set a message and redirect to the store creation page
        $this->messenger()->addMessage($this->t('You must create a store first.'), 'error');
        $url = Url::fromUri('internal:/store/add')->toString();
        return new RedirectResponse($url);
      }
    }
  }
