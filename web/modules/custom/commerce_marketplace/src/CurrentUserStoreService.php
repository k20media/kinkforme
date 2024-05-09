<?php

namespace Drupal\commerce_marketplace;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Session\AccountProxyInterface;

class CurrentUserStoreService {

  protected $entityTypeManager;
  protected $currentUser;

  public function __construct(EntityTypeManagerInterface $entityTypeManager, AccountProxyInterface $currentUser) {
    $this->entityTypeManager = $entityTypeManager;
    $this->currentUser = $currentUser;
  }

  public function getCurrentUserStoreId() {
    $user_id = $this->currentUser->id();
    $stores = $this->entityTypeManager->getStorage('commerce_store')->loadByProperties(['uid' => $user_id]);
    $store = reset($stores); // Assuming each user has only one store.
    return $store ? $store->id() : NULL;
  }
}
