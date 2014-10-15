<?php
require_once('./Services/Block/classes/class.ilBlockGUI.php');
require_once('class.ilObjPortfolioListGUI.php');
require_once('./Modules/Portfolio/classes/class.ilPortfolioAccessHandler.php');
require_once('./Services/UIComponent/AdvancedSelectionList/classes/class.ilAdvancedSelectionListGUI.php');
require_once('./Services/User/classes/class.ilObjUser.php');

/**
 * Class portdeskBlockGUI
 *
 * @author            Fabian Schmid <fs@studer-raimann.ch>
 * @version           1.0.0
 *
 * @ilCtrl_IsCalledBy portdeskBlockGUI: ilColumnGUI, ilPersonalDesktopGUI
 * @ilCtrl_Calls      portdeskBlockGUI: ilCommonActionDispatcherGUI
 */
class portdeskBlockGUI extends ilBlockGUI {

	/**
	 * @var string
	 */
	protected static $block_type = 'port_desk';


	public function __construct() {
		global $ilCtrl, $tpl;
		/**
		 * @var $ilCtrl ilCtrl
		 * @var $tpl    ilTemplate
		 */
		$this->ctrl = $ilCtrl;
		$this->pl = ilPortfolioDesktopPlugin::getInstance();
		//		$this->pl->updateLanguageFiles();
		$tpl->addCss($this->pl->getDirectory() . '/templates/port_desk.css');
	}


	/**
	 * @return string
	 */
	static function getBlockType() {
		return self::$block_type;
	}


	/**
	 * @return bool
	 */
	static function isRepositoryObject() {
		return false;
	}


	public function fillDataSection() {
		global $ilUser;
		$ilPortfolioAccessHandler = new ilPortfolioAccessHandler();
		$tpl = $this->pl->getTemplate('tpl.list_item.html');
		$prtf_path = array( 'ilPortfolioRepositoryGUI', 'ilobjportfoliogui' );
		foreach (ilObjPortfolio::getPortfoliosOfUser($ilUser->getId()) as $portfolio) {
			$this->ctrl->setParameterByClass('ilobjportfoliogui', 'prt_id', $portfolio['id']);
			$tpl->touchBlock('item');
			$tpl->setVariable('TITLE', $portfolio['title']);
			if ($portfolio['is_default'] == 1) {
				$tpl->setVariable('IMG_SRC', ilObjUser::_getPersonalPicturePath($ilUser->getId()));
			}

			if ($ilPortfolioAccessHandler->hasGlobalPermission($portfolio['id'])
				OR $ilPortfolioAccessHandler->hasRegisteredPermission($portfolio['id'])
			) {
				$tpl->setVariable('IMG_SRC_SHARED', './Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/PortfolioDesktop/templates/img/globe_grey_s.png');
				$tpl->setVariable('TXT_SHARED', $this->pl->txt('alt_shared'));
			}

			$current_selection_list = new ilAdvancedSelectionListGUI();
			$current_selection_list->setListTitle($this->pl->txt('port_actions'));
			$current_selection_list->setId('port_id' . $portfolio['id']);
			$current_selection_list->setUseImages(false);
			$current_selection_list->addItem($this->pl->txt('port_preview'), 'port_preview', $this->ctrl->getLinkTargetByClass($prtf_path, 'preview'));
			$current_selection_list->addItem($this->pl->txt('port_edit'), 'port_edit', $this->ctrl->getLinkTargetByClass($prtf_path, 'view'));

			$tpl->setVariable('ACTIONS', $current_selection_list->getHTML());
		}

		$this->setDataSection($tpl->get());
	}
}

?>