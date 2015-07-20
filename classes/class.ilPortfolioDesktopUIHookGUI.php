<?php

/* Copyright (c) 1998-2010 ILIAS open source, Extended GPL, see docs/LICENSE */

require_once('./Services/UIComponent/classes/class.ilUIHookPluginGUI.php');
require_once('class.portdeskBlockGUI.php');
require_once('./Modules/Portfolio/classes/class.ilObjPortfolio.php');

/**
 * Class ilPortfolioDesktopUIHookGUI
 *
 * @author  Fabian Schmid <fs@studer-raimann.ch>
 * @version 0.0.1
 *
 * @ingroup ServicesUIComponent
 */
class ilPortfolioDesktopUIHookGUI extends ilUIHookPluginGUI {

	/**
	 * @var array
	 */
	protected static $loaded = array();


	/**
	 * @param $key
	 *
	 * @return bool
	 */
	protected static function isLoaded($key) {
		return self::$loaded[$key] == 1;
	}


	/**
	 * @param $key
	 */
	protected static function setLoaded($key) {
		self::$loaded[$key] = 1;
	}


	public function __construct() {
		$this->plugin = ilPortfolioDesktopPlugin::getInstance();
		//		$this->plugin->updateLanguageFiles();
	}


	/**
	 * @param       $a_comp
	 * @param       $a_part
	 * @param array $a_par
	 *
	 * @return array
	 */
	public function getHTML($a_comp, $a_part, $a_par = array()) {
		/**
		 * @var $ilCtrl       ilCtrl
		 * @var $tpl          ilTemplate
		 * @var $ilToolbar    ilToolbarGUI
		 */
		global $ilUser;

		$cmd_fits = ($_GET['cmd'] == 'jumpToMemberships' OR $_GET['cmd'] == 'jumpToSelectedItems' OR $_GET['cmd'] === '');
		if ($a_comp == 'Services/PersonalDesktop' AND $a_part == 'center_column' AND ! self::isLoaded('pd') AND $cmd_fits) {
			self::setLoaded('pd');

			if (ilObjPortfolio::getPortfoliosOfUser($ilUser->getId())) {
				$portdeskObjectsGUI = new portdeskBlockGUI();
				$portdeskObjectsGUI->setTitle($this->plugin->txt('block_title'));

				return array( 'mode' => ilUIHookPluginGUI::PREPEND, 'html' => $portdeskObjectsGUI->getHTML() );
			}
		}

		return array( 'mode' => ilUIHookPluginGUI::KEEP, 'html' => '' );
	}
}

?>