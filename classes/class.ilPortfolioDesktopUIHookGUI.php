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

		/*
		1) Aktive Benutzer
		http://domain.com/ilias.php?cmd=show&cmdClass=ilpersonaldesktopgui&cmdNode=vp&baseClass=ilPersonalDesktopGUI&redirectSource=ilcolumngui&cmdMode=
		2) Block entfernen
		http://domain.com/ilias.php?col_side=right&cmdClass=ilcolumngui&cmdNode=vp:m5&baseClass=ilPersonalDesktopGUI
		3) Block hinzufügen
		http://domain.com/ilias.php?cmd=show&cmdClass=ilpersonaldesktopgui&cmdNode=vp&baseClass=ilPersonalDesktopGUI&redirectSource=ilcolumngui&cmdMode=
		4) Ohne Rechte auf Objekt zugreifen
		http://domain.com/ilias.php?baseClass=ilPersonalDesktopGUI
		*/

		$commands = array(
			'',
			'jumpToMemberships',
			'jumpToSelectedItems',
			'show'
		);

		$cmd_fits = in_array($_GET['cmd'], $commands);

		if ($a_comp == 'Services/PersonalDesktop' AND $a_part == 'center_column' AND ! self::isLoaded('pd') AND $cmd_fits) {
			self::setLoaded('pd');

			if (ilObjPortfolio::getPortfoliosOfUser($ilUser->getId())) {
				$portdeskObjectsGUI = new portdeskBlockGUI();
				$portdeskObjectsGUI->setTitle($this->plugin->txt('block_title'));

				return array(
					'mode' => ilUIHookPluginGUI::PREPEND,
					'html' => $portdeskObjectsGUI->getHTML()
				);
			}
		}

		return array(
			'mode' => ilUIHookPluginGUI::KEEP,
			'html' => ''
		);
	}
}

?>