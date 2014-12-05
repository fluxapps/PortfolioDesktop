<?php
require_once('./Services/Object/classes/class.ilObjectListGUI.php');
/**
 * Class portdeskListGUI
 *
 * @author  Fabian Schmid <fs@studer-raimann.ch>
 * @version 1.0.0
 */
class portdeskListGUI extends ilObjectListGUI {

	function getListItemHTML($a_obj_id, $a_title, $a_description, $a_use_asynch = false, $a_get_asynch_commands = false, $a_asynch_url = "", $a_context = self::CONTEXT_REPOSITORY) {
		return parent::getListItemHTML($a_obj_id, $a_obj_id, $a_title, $a_description, false, false, '', self::CONTEXT_PERSONAL_DESKTOP);
	}
}

?>
