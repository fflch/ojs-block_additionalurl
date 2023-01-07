<?php
import('lib.pkp.classes.plugins.GenericPlugin');



class AditionalUrlPlugin extends GenericPlugin {
  public function getName() {
    return 'AditionalUrl';
  }

  public function getDisplayName() {
    return 'AditionalUrl';
  }

  public function getDescription() {
    return 'A ojs plugin that creates a additional URL for articles.';
  }

  public function register($category, $path) {
    if (parent::register($category, $path)) {
      // Register the "AditionalUrl" hook
      HookRegistry::register('AditionalUrl', array(&$this, 'AditionalUrl'));
      return true;
    }
    return false;
  }

  public function AditionalUrl($hookName, $args) {
    $request = $args[0];
    $router = $args[1];

    $path = $request->getRequestPath();
    if (preg_match('/article\/view\/(\d+)\/(\d+)/', $path, $matches)) {
      $articleId = $matches[1];
      $galleyId = $matches[2];

      // Replace the route with the new PDF route
      $newPath = "article/view/$articleId/object_pt_BR.pdf";
      $request->setRequestPath($newPath);
      return false;
    }
  }
}
