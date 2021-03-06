<?php

require_once 'windowsill.civix.php';
require_once 'php/hooks.php';

/**
 * Implementation of hook_civicrm_config
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function windowsill_civicrm_config(&$config) {
  _windowsill_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function windowsill_civicrm_xmlMenu(&$files) {
  _windowsill_civix_civicrm_xmlMenu($files);
}

/**
 * Implementation of hook_civicrm_install
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function windowsill_civicrm_install() {
  _windowsill_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function windowsill_civicrm_uninstall() {
  _windowsill_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function windowsill_civicrm_enable() {
  // log
  watchdog('be.ctrl.windowsill', 'enabled windowsill');
  $settings = array();
  $settings[] = array(
    'id' => 1,
    'name' => '',
    'view' => '',
    'tab' => TRUE,
    'token' => TRUE
  );
  $encode = json_encode($settings);
  // assign
  CRM_Core_BAO_Setting::setItem($encode, 'windowsill', 'settings');
  // continue
  _windowsill_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_disable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function windowsill_civicrm_disable() {
  // log
  watchdog('be.ctrl.windowsill', 'disabled windowsill');
  // assign
  CRM_Core_BAO_Setting::setItem('', 'windowsill', 'settings');
  // continue
  _windowsill_civix_civicrm_disable();
}

/**
 * Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function windowsill_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _windowsill_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implementation of hook_civicrm_managed
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function windowsill_civicrm_managed(&$entities) {
  _windowsill_civix_civicrm_managed($entities);
}

/**
 * Implementation of hook_civicrm_caseTypes
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function windowsill_civicrm_caseTypes(&$caseTypes) {
  _windowsill_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implementation of hook_civicrm_alterSettingsFolders
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function windowsill_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _windowsill_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * function(s)
 */

/**
 * buildform
 */
function windowsill_civicrm_buildForm($formName, &$form) {
  // buildForm
}

/**
 * pagerun
 */
function windowsill_civicrm_pageRun(&$page) {
  // pageRun
  if (get_class($page) == 'CRM_windowsill_Page_windowsill') {
    // include css
    // CRM_Core_Resources::singleton()->addStyleUrl('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');
    CRM_Core_Resources::singleton()
      ->addStyleFile('be.ctrl.windowsill', 'css/style.css');
    // include script
    CRM_Core_Resources::singleton()
      ->addScriptUrl('https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js', 10, 'page-header');
    CRM_Core_Resources::singleton()
      ->addScriptFile('be.ctrl.windowsill', 'js/script.js', 10, 'page-footer');
  }
}


 
