<?php

/**
 * @file
 * Definition of Drupal\entity_test\Entity\EntityTest.
 */

namespace Drupal\entity_test\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\Annotation\EntityType;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Field\FieldDefinition;
use Drupal\Core\Entity\EntityStorageControllerInterface;
use Drupal\Core\Language\Language;

/**
 * Defines the test entity class.
 *
 * @EntityType(
 *   id = "entity_test",
 *   label = @Translation("Test entity"),
 *   controllers = {
 *     "storage" = "Drupal\Core\Entity\FieldableDatabaseStorageController",
 *     "list" = "Drupal\entity_test\EntityTestListController",
 *     "view_builder" = "Drupal\entity_test\EntityTestViewBuilder",
 *     "access" = "Drupal\entity_test\EntityTestAccessController",
 *     "form" = {
 *       "default" = "Drupal\entity_test\EntityTestFormController"
 *     },
 *     "translation" = "Drupal\content_translation\ContentTranslationController"
 *   },
 *   base_table = "entity_test",
 *   fieldable = TRUE,
 *   field_cache = FALSE,
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "bundle" = "type",
 *     "label" = "name"
 *   },
 *   links = {
 *     "canonical" = "entity_test.render",
 *     "edit-form" = "entity_test.edit_entity_test",
 *     "admin-form" = "entity_test.admin_entity_test"
 *   }
 * )
 */
class EntityTest extends ContentEntityBase {

  /**
   * The entity ID.
   *
   * @var \Drupal\Core\Field\FieldItemListInterface
   */
  public $id;

  /**
   * The entity UUID.
   *
   * @var \Drupal\Core\Field\FieldItemListInterface
   */
  public $uuid;

  /**
   * The bundle of the test entity.
   *
   * @var \Drupal\Core\Field\FieldItemListInterface
   */
  public $type;

  /**
   * The name of the test entity.
   *
   * @var \Drupal\Core\Field\FieldItemListInterface
   */
  public $name;

  /**
   * The associated user.
   *
   * @var \Drupal\Core\Field\FieldItemListInterface
   */
  public $user_id;

  /**
   * Initialize the object. Invoked upon construction and wake up.
   */
  protected function init() {
    parent::init();
    // We unset all defined properties, so magic getters apply.
    unset($this->id);
    unset($this->uuid);
    unset($this->name);
    unset($this->user_id);
    unset($this->type);
  }

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageControllerInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    if (empty($values['type'])) {
      $values['type'] = $storage_controller->entityType();
    }
  }

  /**
   * Overrides Drupal\entity\Entity::label().
   */
  public function label($langcode = NULL) {
    $info = $this->entityInfo();
    if (!isset($langcode)) {
      $langcode = $this->activeLangcode;
    }
    if (isset($info['entity_keys']['label']) && $info['entity_keys']['label'] == 'name') {
      return $this->getTranslation($langcode)->name->value;
    }
    else {
      return parent::label($langcode);
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions($entity_type) {
    $fields['id'] = FieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the test entity.'))
      ->setReadOnly(TRUE);

    $fields['uuid'] = FieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the test entity.'))
      ->setReadOnly(TRUE);

    $fields['langcode'] = FieldDefinition::create('language')
      ->setLabel(t('Language code'))
      ->setDescription(t('The language code of the test entity.'));

    $fields['name'] = FieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the test entity.'))
      ->setTranslatable(TRUE)
      ->setPropertyConstraints('value', array('Length' => array('max' => 32)));

    // @todo: Add allowed values validation.
    $fields['type'] = FieldDefinition::create('string')
      ->setLabel(t('Type'))
      ->setDescription(t('The bundle of the test entity.'))
      ->setRequired(TRUE);

    $fields['user_id'] = FieldDefinition::create('entity_reference')
      ->setLabel(t('User ID'))
      ->setDescription(t('The ID of the associated user.'))
      ->setSettings(array('target_type' => 'user'))
      ->setTranslatable(TRUE);

    return $fields;
  }

}
