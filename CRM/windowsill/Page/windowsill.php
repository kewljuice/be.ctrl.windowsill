<?php

require_once 'CRM/Core/Page.php';

class CRM_windowsill_Page_windowsill extends CRM_Core_Page {
  function run() {

    // title
    CRM_Utils_System::setTitle(ts('WindowSill'));

    // config
    // https://github.com/kreynen/civicrm-min/blob/master/CRM/Core/Extensions.php
    $config = CRM_Core_Config::singleton();
    if ($config->userFramework != 'Drupal') {
      $error = "<div class='messages status no-popup'><div class='icon inform-icon'></div>Not a Drupal installation</div>";
    }
    else {
      $error = "<div class='messages status no-popup'><div class='icon inform-icon'></div>Drupal installation</div>";
    }

    // error
    $this->assign('error', $error);

    // on form action update settings
    if (isset($_REQUEST['settings'])) {
      // set
      CRM_Core_BAO_Setting::setItem($_REQUEST['settings'], 'windowsill', 'settings');
      // notice
      CRM_Core_Session::setStatus(ts('Windowsill settings changed'), ts('Saved'), 'success');
    }

    // url
    $url = CRM_Utils_System::url() . "civicrm/ctrl/windowsill";
    $this->assign('url', $url);

    // render
    parent::run();
  }
}
