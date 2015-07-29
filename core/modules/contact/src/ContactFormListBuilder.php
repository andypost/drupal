<?php

/**
 * @file
 * Contains \Drupal\contact\ContactFormListBuilder.
 */

namespace Drupal\contact;

use Drupal\Component\Utility\SafeMarkup;
use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Defines a class to build a listing of contact form entities.
 *
 * @see \Drupal\contact\Entity\ContactForm
 */
class ContactFormListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['form'] = $this->t('Form');
    $header['recipients'] = [
      'data' => $this->t('Recipients'),
      'class' => [RESPONSIVE_PRIORITY_LOW],
    ];
    $header['selected'] = $this->t('Selected');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    // Special case the personal form.
    if ($entity->id() == 'personal') {
      $row['form'] = $this->getLabel($entity);
      $row['recipients'] = $this->t('Selected user');
      $row['selected'] = $this->t('No');
    }
    else {
      $row['form'] = $entity->link(NULL, 'canonical');
      // Filter empty lines.
      $recipients = array_filter($entity->getRecipients());
      if (count($recipients) > 1) {
        $row['recipients'] = [
          'data' => [
            '#theme' => 'item_list',
            '#items' => $recipients,
          ],
        ];
      }
      elseif (count($recipients)) {
        // Only one recipient.
        $row['recipients'] = SafeMarkup::checkPlain($recipients[0]);
      }
      else {
        $row['recipients'] = $this->t('No recipients');
      }
      $default_form = \Drupal::config('contact.settings')->get('default_form');
      $row['selected'] = ($default_form == $entity->id() ? $this->t('Yes') : $this->t('No'));
    }
    return $row + parent::buildRow($entity);
  }

}
