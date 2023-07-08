<?php
require_once('../config.php');

class Master extends DBConnection {
	private $settings;

	public function __construct() {
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}

	public function __destruct() {
		parent::__destruct();
	}

	function capture_err() {
		if (!$this->conn->error) {
			return false;
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}

	function save_shop_type() {
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				if (!empty($data)) $data .= ",";
				$data .= " `{$k}`=:{$k} ";
			}
		}

		$check = $this->conn->prepare("SELECT * FROM `shop_type_list` where `name` = :name and delete_flag = 0 ".(!empty($id) ? " and id != :id " : "")." ");
		$check->bindParam(':name', $name);
		if (!empty($id)) {
			$check->bindParam(':id', $id);
		}
		$check->execute();

		if ($this->capture_err()) {
			return $this->capture_err();
		}

		if ($check->rowCount() > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "Shop Type already exists.";
		} else {
			if (empty($id)) {
				$sql = "INSERT INTO `shop_type_list` set {$data} ";
			} else {
				$sql = "UPDATE `shop_type_list` set {$data} where id = :id ";
			}

			$stmt = $this->conn->prepare($sql);
			foreach ($_POST as $k => $v) {
				if (!in_array($k, array('id'))) {
					$stmt->bindParam(":{$k}", $v);
				}
			}

			$save = $stmt->execute();

			if ($save) {
				$resp['status'] = 'success';
				if (empty($id)) {
					$resp['msg'] = " New Shop Type successfully saved.";
				} else {
					$resp['msg'] = " Shop Type successfully updated.";
				}
			} else {
				$resp['status'] = 'failed';
				$resp['err'] = $stmt->errorInfo()[2]."[{$sql}]";
			}
		}

		if ($resp['status'] == 'success') {
			$this->settings->set_flashdata('success', $resp['msg']);
		}

		return json_encode($resp);
	}

	// Continue converting the remaining functions in a similar manner
	// ...
}
?>