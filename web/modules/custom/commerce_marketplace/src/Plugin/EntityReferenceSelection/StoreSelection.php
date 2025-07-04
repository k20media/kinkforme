<?php

namespace Drupal\commerce_marketplace\Plugin\EntityReferenceSelection;

use Drupal\Core\Database\Query\SelectInterface;
use Drupal\Core\Entity\Plugin\EntityReferenceSelection\DefaultSelection;

/**
 * Provides specific access control for the commerce_store entity type.
 *
 * @EntityReferenceSelection(
 *   id = "default:commerce_store",
 *   label = @Translation("Store selection"),
 *   entity_types = {"commerce_store"},
 *   group = "default",
 *   weight = 1
 * )
 */
class StoreSelection extends DefaultSelection {

  /**
   * {@inheritdoc}
   */
  protected function buildEntityQuery($match = NULL, $match_operator = 'CONTAINS') {
    $query = parent::buildEntityQuery($match, $match_operator);

    // A user who can view any can select any.
    if ($this->currentUser->hasPermission('view any commerce_store')) {
      return $query;
    }
    // Else make sure they can edit their own store (assumes one bundle.)
    elseif ($this->currentUser->hasPermission('view own commerce_store')) {
      $query->condition('uid', $this->currentUser->id());
    }
    // No permissions, no stores.
    else {
      $query->range(0, 0);
    }

    return $query;
  }

}
