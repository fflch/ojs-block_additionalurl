<?php
import('lib.pkp.classes.plugins.GenericPlugin');



class PdfUrlPlugin extends GenericPlugin {
  public function getName() {
    return 'UrlPdf';
  }

  public function getDisplayName() {
    return 'UrlPdf';
  }

  public function getDescription() {
    return 'Este plugin muda o final do url, adcionando object_pt_BR.';
  }

  public function register($category, $path) {
    if (parent::register($category, $path)) {
      // Register the "UrlPdf" hook
      HookRegistry::register('UrlPdf', array(&$this, 'UrlPdf'));
      return true;
    }
    return false;
  }

  public function UrlPdf($hookName, $args) {
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
