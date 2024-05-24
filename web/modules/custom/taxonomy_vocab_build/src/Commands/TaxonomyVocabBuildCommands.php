<?php

namespace Drupal\taxonomy_vocab_build\Commands;

use Drush\Commands\DrushCommands;
use Drupal\taxonomy\Entity\Vocabulary;
use Drupal\taxonomy\Entity\Term;
use Symfony\Component\Yaml\Yaml;

class TaxonomyVocabBuildCommands extends DrushCommands {
  /**
   * Imports taxonomy vocabularies from YAML configuration.
   *
   * @command taxonomy_vocab_build:import
   * @aliases tvb-import
   * @usage taxonomy_vocab_build:import
   *   Imports vocabularies and terms from YAML files.
   */
  public function import() {
    $directory = DRUPAL_ROOT . '/modules/custom/taxonomy_vocab_build/import';
    $files = scandir($directory);
    foreach ($files as $file) {
      if (pathinfo($file, PATHINFO_EXTENSION) === 'yml') {
        $content = Yaml::parse(file_get_contents($directory . '/' . $file));
        $this->importVocabulary($content);
        $this->output()->writeln("Imported vocabulary from {$file}");
      }
    }
  }

  /**
   * Imports or updates a vocabulary and its terms based on provided content.
   *
   * @param array $content
   *   The parsed YAML content.
   */
  protected function importVocabulary(array $content) {
    // Check and create vocabulary
    $vocabulary = Vocabulary::load($content['vocab_name']);
    if (!$vocabulary) {
      $vocabulary = Vocabulary::create([
        'vid' => $content['vocab_name'],
        'description' => $content['description'] ?? '',
        'name' => $content['vocab_name']
      ]);
      $vocabulary->save();
      $this->output()->writeln("Created new vocabulary {$content['vocab_name']}");
    }

    // Process terms
    foreach ($content['terms'] as $term_data) {
      $this->importTerm($term_data, $vocabulary);
    }
  }

  /**
   * Imports or updates a term in a given vocabulary.
   *
   * @param array $term_data
   *   The term data from YAML.
   * @param \Drupal\taxonomy\Entity\Vocabulary $vocabulary
   *   The vocabulary entity.
   */
  protected function importTerm(array $term_data, Vocabulary $vocabulary) {
    $terms = \Drupal::entityTypeManager()
      ->getStorage('taxonomy_term')
      ->loadByProperties(['name' => $term_data['name'], 'vid' => $vocabulary->id()]);
    $term = reset($terms);

    // Create or update term
    if (!$term) {
        $term = Term::create([
            'vid' => $vocabulary->id(),
            'name' => $term_data['name'],
        ]);
    }

    // Check and update custom fields if they exist
    if (!empty($term_data['fields']) && is_array($term_data['fields'])) {
        foreach ($term_data['fields'] as $field_name => $value) {
            $term->set($field_name, $value);
        }
    } else {
        $this->output()->writeln("No custom fields to process for term '{$term_data['name']}'");
    }

    $term->save();
    $this->output()->writeln("Processed term {$term->label()} in {$vocabulary->label()}");
  }
}
