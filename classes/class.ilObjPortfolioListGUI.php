<?php

/* Copyright (c) 1998-2012 ILIAS open source, Extended GPL, see docs/LICENSE */

include_once "Services/Object/classes/class.ilObjectListGUI.php";

/**
 * Class ilObjPortfolioListGUI
 *
 * @author  Fabian Schmid <fs@studer-raimann.ch>
 *
 * @ingroup ModulesCourse
 */
class ilObjPortfolioListGUI extends ilObjectListGUI {

	public function ilObjCourseListGUI() {
		$this->ilObjectListGUI();
	}


	public function init() {
		$this->static_link_enabled = false;
		$this->delete_enabled = false;
		$this->cut_enabled = false;
		$this->copy_enabled = false;
		$this->subscribe_enabled = false;
		$this->link_enabled = false;
		$this->payment_enabled = false;
		$this->info_screen_enabled = false;
		$this->type = "prtf";
		$this->gui_class_name = "ilObjPortfolioGUI";
		$this->substitutions_enabled = false;
		$this->commands = array();
	}


	/**
	 * @return array
	 */
	public function getProperties() {
		$props = array();
		//		global $lng, $ilUser;
		//
		//		$props = parent::getProperties();
		//
		//		// offline
		//		include_once 'Modules/Course/classes/class.ilObjCourseAccess.php';
		//		if (ilObjCourseAccess::_isOffline($this->obj_id)) {
		//			$showRegistrationInfo = false;
		//			$props[] = array(
		//				"alert" => true,
		//				"property" => $lng->txt("status"),
		//				"value" => $lng->txt("offline")
		//			);
		//		}
		//
		//		// blocked
		//		include_once 'Modules/Course/classes/class.ilCourseParticipant.php';
		//		$members = ilCourseParticipant::_getInstanceByObjId($this->obj_id, $ilUser->getId());
		//		if ($members->isBlocked($ilUser->getId()) and $members->isAssigned($ilUser->getId())) {
		//			$props[] = array(
		//				"alert" => true,
		//				"property" => $lng->txt("member_status"),
		//				"value" => $lng->txt("crs_status_blocked")
		//			);
		//		}
		//
		//		// pending subscription
		//		include_once 'Modules/Course/classes/class.ilCourseParticipants.php';
		//		if (ilCourseParticipants::_isSubscriber($this->obj_id, $ilUser->getId())) {
		//			$props[] = array(
		//				"alert" => true,
		//				"property" => $lng->txt("member_status"),
		//				"value" => $lng->txt("crs_status_pending")
		//			);
		//		}
		//
		//		include_once './Modules/Course/classes/class.ilObjCourseAccess.php';
		//		$info = ilObjCourseAccess::lookupRegistrationInfo($this->obj_id);
		//		if ($info['reg_info_list_prop']) {
		//			$props[] = array(
		//				'alert' => false,
		//				'newline' => true,
		//				'property' => $info['reg_info_list_prop']['property'],
		//				'value' => $info['reg_info_list_prop']['value']
		//			);
		//		}
		//		if ($info['reg_info_list_prop_limit']) {
		//
		//			$props[] = array(
		//				'alert' => false,
		//				'newline' => false,
		//				'property' => $info['reg_info_list_prop_limit']['property'],
		//				'propertyNameVisible' => strlen($info['reg_info_list_prop_limit']['property']) ? true : false,
		//				'value' => $info['reg_info_list_prop_limit']['value']
		//			);
		//		}
		//
		//		// waiting list
		//		include_once './Modules/Course/classes/class.ilCourseWaitingList.php';
		//		if (ilCourseWaitingList::_isOnList($ilUser->getId(), $this->obj_id)) {
		//			$props[] = array(
		//				"alert" => true,
		//				"property" => $lng->txt('member_status'),
		//				"value" => $lng->txt('on_waiting_list')
		//			);
		//		}
		//
		//		// check for certificates
		//		include_once "./Modules/Course/classes/class.ilCourseCertificateAdapter.php";
		//		if (ilCourseCertificateAdapter::_hasUserCertificate($ilUser->getId(), $this->obj_id)) {
		//			$lng->loadLanguageModule('certificate');
		//			$cmd_link = "ilias.php?baseClass=ilRepositoryGUI&amp;ref_id=" . $this->ref_id . "&amp;cmd=deliverCertificate";
		//			$props[] = array(
		//				"alert" => false,
		//				"property" => $lng->txt("passed"),
		//				"value" => '<a href="' . $cmd_link . '">' . $lng->txt("download_certificate") . '</a>'
		//			);
		//		}

		return $props;
	}
}

?>
