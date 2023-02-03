<?php

import('lib.pkp.classes.plugins.GenericPlugin');

class pdfUrl extends GenericPlugin {
    public function register($category, $path, $mainContextId = NULL) {
        $success = parent::register($category, $path);
            if ($success && $this->getEnabled()) {
               HookRegistry::register('TemplateResource::getFilename', array($this, '_overridePluginTemplates'));
            }
        return $success;
    }

  /**
   * Provide a name for this plugin
   *
   * The name will appear in the plugins list where editors can
   * enable and disable plugins.
   */
	public function getDisplayName() {
		return __('plugins.generic.get.displayName');
	}

	/**
   * Provide a description for this plugin
   *
   * The description will appear in the plugins list where editors can
   * enable and disable plugins.
   */
	public function getDescription() {
		return __('plugins.generic.get.description');
	}
}
