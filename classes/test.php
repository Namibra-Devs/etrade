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


public function save_vendor()
     {
		if (!empty($_POST['password']))
			$_POST['password'] = md5($_POST['password']);
		else
			unset($_POST['password']);
		if (empty($_POST['id'])) {
			$prefix = date('Ym-');
			$code = sprintf("%'.05d", 1);
			while (true) {
				$check = $this->conn->query("SELECT * FROM `vendor_list` where code = '{$prefix}{$code}'")->num_rows;
				if ($check > 0) {
					$code = sprintf("%'.05d", ceil($code) + 1);
				} else {
					break;
				}
			}
			$_POST['code'] = $prefix . $code;
		}
		extract($_POST);
		if (isset($oldpassword) && !empty($id)) {
			$current_pass = $this->conn->query("SELECT * FROM `vendor_list` where id = '{$id}'")->fetch_array()['password'];
			if (md5($oldpassword) != $current_pass) {
				$resp['status'] = 'failed';
				$resp['msg'] = ' Incorrect Current Password';
				return json_encode($resp);
				exit;
			}
		}
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, ['id', 'cpassword', 'oldpassword']) && !is_array($_POST[$k])) {
				$v = $this->conn->real_escape_string($v);
				if (!empty($data)) $data .= ", ";
				$data .= "`{$k}`='{$v}'";
			}
		}
		$check  = $this->conn->query("SELECT * FROM `vendor_list` where username = '{$username}' and delete_flag = 0 " . (!empty($id) ? " and id !='{$id}'" : ''))->num_rows;
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = " Username already exists";
		} else {
			if (empty($id)) {
				$sql = "INSERT INTO `vendor_list` set {$data}";
			} else {
				$sql = "UPDATE `vendor_list` set {$data} where id = '{$id}'";
			}
			$save = $this->conn->query($sql);
			if ($save) {
				$resp['status'] = "success";
				$vid = empty($id) ? $this->conn->insert_id : $id;
				// $select_query = "SELECT name FROM vendor_list WHERE id = $vid";
				// $vendor_name_result = mysqli_query($this->conn, $select_query);

				// if ($vendor_name_result && mysqli_num_rows($vendor_name_result) > 0) {
				// 	$row = mysqli_fetch_assoc($vendor_name_result);
				// 	$vendor_name = $row['shop_owner'];
				// 	$vendor_email = $row['email'];

				// 	if (empty($id)) {
				// 		$mailer->send_vendor($vendor_name, $vendor_email);
				// 	}
				// }

				if (empty($id)) {
					if (strpos($_SERVER['HTTP_REFERER'], 'vendor/register.php') > -1) {
						$resp['msg'] = " Your account has been registered successfully.";
					} else {
						$resp['msg'] = " Vendor's Account has been registered successfully.";
					}
				} else {
					if ($this->settings->userdata('login_type') == 2) {
						$resp['msg'] = " Your account details has been updated successfully.";
					} else {
						$resp['msg'] = " Vendor's Account Details has been updated successfully.";
					}
				}

				if (isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
					if (!is_dir(base_app . "uploads/vendors"))
						mkdir(base_app . "uploads/vendors");
					$fname = 'uploads/vendors/' . ($vid) . '.png';
					$dir_path = base_app . $fname;
					$upload = $_FILES['img']['tmp_name'];
					$type = mime_content_type($upload);
					$allowed = array('image/png', 'image/jpeg');
					if (!in_array($type, $allowed)) {
						$resp['msg'] .= " But Image failed to upload due to invalid file type.";
					} else {
						$new_height = 200;
						$new_width = 200;

						list($width, $height) = getimagesize($upload);
						$t_image = imagecreatetruecolor($new_width, $new_height);
						imagealphablending($t_image, false);
						imagesavealpha($t_image, true);
						$gdImg = ($type == 'image/png') ? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
						imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
						if ($gdImg) {
							if (is_file($dir_path))
								unlink($dir_path);
							$uploaded_img = imagepng($t_image, $dir_path);
							imagedestroy($gdImg);
							imagedestroy($t_image);
							if ($uploaded_img) {
								$qry = $this->conn->query("UPDATE `vendor_list` set avatar = concat('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '$vid' ");
								if ($this->settings->userdata('id') == $id && $this->settings->userdata('login_type') == 2)
									$this->settings->set_userdata('avatar', $fname . "?v=" . (time()));
							}
						} else {
							$resp['msg'] .= " But Image failed to upload due to unkown reason.";
						}
					}
				}
			} else {
				$resp['status'] = 'failed';
				$resp['msg'] = " An error occure while saving the account details.";
				$resp['error'] = $this->conn->error;
			}
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['msg']);

		return json_encode($resp);
	}





	<?php
require_once('../config.php');
require_once('../helpers/mailer.php');
class Users extends DBConnection
{
	private $settings;
	public function __construct()
	{
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct()
	{
		parent::__destruct();
	}
	public function save_users()
	{
		extract($_POST);
		$data = '';
		$chk = $this->conn->query("SELECT * FROM `users` where username ='{$username}' " . ($id > 0 ? " and id!= '{$id}' " : ""))->num_rows;
		if ($chk > 0) {
			return 3;
			exit;
		}
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'password'))) {
				if (!empty($data)) $data .= " , ";
				$data .= " {$k} = '{$v}' ";
			}
		}
		if (!empty($password)) {
			$password = md5($password);
			if (!empty($data)) $data .= " , ";
			$data .= " `password` = '{$password}' ";
		}

		if (empty($id)) {
			$qry = $this->conn->query("INSERT INTO users set {$data}");
			if ($qry) {
				$id = $this->conn->insert_id;
				$this->settings->set_flashdata('success', 'User Details successfully saved.');
				if (isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
					$fname = 'uploads/avatar-' . ($id) . '.png';
					$dir_path = base_app . $fname;
					$upload = $_FILES['img']['tmp_name'];
					$type = mime_content_type($upload);
					$allowed = array('image/png', 'image/jpeg');
					if (!in_array($type, $allowed)) {
						$resp['msg'] = " But Image failed to upload due to invalid file type.";
					} else {
						$new_height = 200;
						$new_width = 200;

						list($width, $height) = getimagesize($upload);
						$t_image = imagecreatetruecolor($new_width, $new_height);
						imagealphablending($t_image, false);
						imagesavealpha($t_image, true);
						$gdImg = ($type == 'image/png') ? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
						imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
						if ($gdImg) {
							if (is_file($dir_path))
								unlink($dir_path);
							$uploaded_img = imagepng($t_image, $dir_path);
							imagedestroy($gdImg);
							imagedestroy($t_image);
							if (isset($uploaded_img) && $uploaded_img == true) {
								$qry = $this->conn->query("UPDATE users set avatar = concat('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '$id' ");
							}
						} else {
							$resp['msg'] = " But Image failed to upload due to unkown reason.";
						}
					}
				}
				return 1;
			} else {
				return 2;
			}
		} else {
			$qry = $this->conn->query("UPDATE users set $data where id = {$id}");
			if ($qry) {
				$this->settings->set_flashdata('success', 'User Details successfully updated.');
				foreach ($_POST as $k => $v) {
					if ($k != 'id') {
						if (!empty($data)) $data .= " , ";
						$this->settings->set_userdata($k, $v);
					}
				}
				if (isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
					$fname = 'uploads/avatar-' . ($id) . '.png';
					$dir_path = base_app . $fname;
					$upload = $_FILES['img']['tmp_name'];
					$type = mime_content_type($upload);
					$allowed = array('image/png', 'image/jpeg');
					if (!in_array($type, $allowed)) {
						$resp['msg'] = " But Image failed to upload due to invalid file type.";
					} else {
						$new_height = 200;
						$new_width = 200;

						list($width, $height) = getimagesize($upload);
						$t_image = imagecreatetruecolor($new_width, $new_height);
						imagealphablending($t_image, false);
						imagesavealpha($t_image, true);
						$gdImg = ($type == 'image/png') ? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
						imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
						if ($gdImg) {
							if (is_file($dir_path))
								unlink($dir_path);
							$uploaded_img = imagepng($t_image, $dir_path);
							imagedestroy($gdImg);
							imagedestroy($t_image);
							if (isset($uploaded_img) && $uploaded_img == true) {
								$qry = $this->conn->query("UPDATE users set avatar = concat('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '$id' ");
								if ($this->settings->userdata('id') == $id && $this->settings->userdata('login_type') == 1)
									$this->settings->set_userdata('avatar', $fname . "?v=" . (time()));
							}
						} else {
							$resp['msg'] = " But Image failed to upload due to unkown reason.";
						}
					}
				}

				return 1;
			} else {
				return "UPDATE users set $data where id = {$id}";
			}
		}
	}
	public function delete_users()
	{
		extract($_POST);
		$avatar = $this->conn->query("SELECT avatar FROM users where id = '{$id}'")->fetch_array()['avatar'];
		$qry = $this->conn->query("DELETE FROM users where id = $id");
		if ($qry) {
			$this->settings->set_flashdata('success', 'User Details successfully deleted.');
			if (is_file(base_app . $avatar))
				unlink(base_app . $avatar);
			$resp['status'] = 'success';
		} else {
			$resp['status'] = 'failed';
		}
		return json_encode($resp);
	}
	public function save_vendor(){
		if(!empty($_POST['password']))
		$_POST['password'] = md5($_POST['password']);
		else
		unset($_POST['password']);
		if(empty($_POST['id'])){
			$prefix = date('Ym-');
			$code = sprintf("%'.05d",1);
			while(true){
				$check = $this->conn->query("SELECT * FROM `vendor_list` where code = '{$prefix}{$code}'")->num_rows;
				if($check > 0){
					$code = sprintf("%'.05d",ceil($code) + 1);
				}else{
					break;
				}
			}
			$_POST['code'] = $prefix.$code;
		}
		extract($_POST);
		if(isset($oldpassword) && !empty($id)){
			$current_pass = $this->conn->query("SELECT * FROM `vendor_list` where id = '{$id}'")->fetch_array()['password'];
			if(md5($oldpassword) != $current_pass){
				$resp['status'] = 'failed';
				$resp['msg'] = ' Incorrect Current Password';
				return json_encode($resp);
				exit;
			}
		}
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k,['id','cpassword','oldpassword']) && !is_array($_POST[$k])){
				$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=", ";
				$data.="`{$k}`='{$v}'";
			}
		}
		$check  = $this->conn->query("SELECT * FROM `vendor_list` where username = '{$username}' and delete_flag = 0 ".(!empty($id) ? " and id !='{$id}'" : ''))->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = " Username already exists";
		}else{
			if(empty($id)){
				$sql = "INSERT INTO `vendor_list` set {$data}";
			}else{
				$sql = "UPDATE `vendor_list` set {$data} where id = '{$id}'";
			}
			$save = $this->conn->query($sql);
			if($save){
				$resp['status'] = "success";
				$vid = empty($id) ? $this->conn->insert_id : $id;
				if(empty($id)){
					if(strpos($_SERVER['HTTP_REFERER'], 'vendor/register.php') > -1){
						$resp['msg'] = " Your account has been registered successfully.";
					}else{
						$resp['msg'] = " Vendor's Account has been registered successfully.";
					}
				}else{
					if($this->settings->userdata('login_type') == 2){
						$resp['msg'] = " Your account details has been updated successfully.";
					}else{
						$resp['msg'] = " Vendor's Account Details has been updated successfully.";
					}	
				}

				if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
					if(!is_dir(base_app."uploads/vendors"))
					mkdir(base_app."uploads/vendors");
					$fname = 'uploads/vendors/'.($vid).'.png';
					$dir_path =base_app. $fname;
					$upload = $_FILES['img']['tmp_name'];
					$type = mime_content_type($upload);
					$allowed = array('image/png','image/jpeg');
					if(!in_array($type,$allowed)){
						$resp['msg'].=" But Image failed to upload due to invalid file type.";
					}else{
						$new_height = 200; 
						$new_width = 200; 
				
						list($width, $height) = getimagesize($upload);
						$t_image = imagecreatetruecolor($new_width, $new_height);
						imagealphablending( $t_image, false );
						imagesavealpha( $t_image, true );
						$gdImg = ($type == 'image/png')? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
						imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
						if($gdImg){
								if(is_file($dir_path))
								unlink($dir_path);
								$uploaded_img = imagepng($t_image,$dir_path);
								imagedestroy($gdImg);
								imagedestroy($t_image);
								if($uploaded_img){
									$qry = $this->conn->query("UPDATE `vendor_list` set avatar = concat('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '$vid' ");
									if($this->settings->userdata('id') == $id && $this->settings->userdata('login_type') == 2)
										$this->settings->set_userdata('avatar',$fname."?v=".(time()));
								}
						}else{
						$resp['msg'].=" But Image failed to upload due to unkown reason.";
						}
					}
					
				}
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = " An error occure while saving the account details.";
				$resp['error'] = $this->conn->error;
			}
		}
		if($resp['status'] == 'success')
		$this->settings->set_flashdata('success',$resp['msg']);

		return json_encode($resp);
	}
	public function delete_vendor()
	{
		extract($_POST);
		$qry = $this->conn->query("UPDATE vendor_list set delete_flag = 1 where id = $id");
		if ($qry) {
			$this->settings->set_flashdata('success', ' Vendor Details successfully deleted.');
			$resp['status'] = 'success';
		} else {
			$resp['status'] = 'failed';
			$resp['msg'] = 'An error occured while deleting the data.';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	public function save_client()
	{
		if (!empty($_POST['password']))
			$_POST['password'] = md5($_POST['password']);
		else
			unset($_POST['password']);
		if (empty($_POST['id'])) {
			$prefix = date('Ym-');
			$code = sprintf("%'.05d", 1);
			while (true) {
				$check = $this->conn->query("SELECT * FROM `client_list` where code = '{$prefix}{$code}'")->num_rows;
				if ($check > 0) {
					$code = sprintf("%'.05d", ceil($code) + 1);
				} else {
					break;
				}
			}
			$_POST['code'] = $prefix . $code;
		}
		extract($_POST);
		if (isset($oldpassword) && !empty($id)) {
			$current_pass = $this->conn->query("SELECT * FROM `client_list` where id = '{$id}'")->fetch_array()['password'];
			if (md5($oldpassword) != $current_pass) {
				$resp['status'] = 'failed';
				$resp['msg'] = ' Incorrect Current Password';
				return json_encode($resp);
				exit;
			}
		}
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, ['id', 'cpassword', 'oldpassword']) && !is_array($_POST[$k])) {
				$v = $this->conn->real_escape_string($v);
				if (!empty($data)) $data .= ", ";
				$data .= "`{$k}`='{$v}'";
			}
		}
		$check  = $this->conn->query("SELECT * FROM `client_list` where email = '{$email}' and delete_flag = 0 " . (!empty($id) ? " and id !='{$id}'" : ''))->num_rows;
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = " Email already exists";
		} else {
			if (empty($id)) {
				$sql = "INSERT INTO `client_list` set {$data}";
			} else {
				$sql = "UPDATE `client_list` set {$data} where id = '{$id}'";
			}
			$save = $this->conn->query($sql);

			if ($save) {
				$resp['status'] = "success";
				$vid = empty($id) ? $this->conn->insert_id : $id;

				$select_query = "SELECT name FROM client_list WHERE id = $vid";
				$client_name_result = mysqli_query($this->conn, $select_query);

				if ($client_name_result && mysqli_num_rows($client_name_result) > 0) {
					$row = mysqli_fetch_assoc($client_name_result);
					$client_name = $row['firstname'] . " " . $row['lastname'];
					$client_email = $row['email'];

					if (empty($id)) {
						$mailer->send_client($client_name, $client_email);
					}
				}

				if (empty($id)) {
					if (strpos($_SERVER['HTTP_REFERER'], 'client/register.php') > -1) {
						$resp['msg'] = " Your account has been registered successfully.";
					} else {
						$resp['msg'] = " Client's Account has been registered successfully.";
					}
				} else {
					if ($this->settings->userdata('login_type') == 3) {
						$resp['msg'] = " Your account details has been updated successfully.";
					} else {
						$resp['msg'] = " Client's Account Details has been updated successfully.";
					}
				}

				if (isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
					if (!is_dir(base_app . "uploads/clients"))
						mkdir(base_app . "uploads/clients");
					$fname = 'uploads/clients/' . ($vid) . '.png';
					$dir_path = base_app . $fname;
					$upload = $_FILES['img']['tmp_name'];
					$type = mime_content_type($upload);
					$allowed = array('image/png', 'image/jpeg');
					if (!in_array($type, $allowed)) {
						$resp['msg'] .= " But Image failed to upload due to invalid file type.";
					} else {
						$new_height = 200;
						$new_width = 200;

						list($width, $height) = getimagesize($upload);
						$t_image = imagecreatetruecolor($new_width, $new_height);
						imagealphablending($t_image, false);
						imagesavealpha($t_image, true);
						$gdImg = ($type == 'image/png') ? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
						imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
						if ($gdImg) {
							if (is_file($dir_path))
								unlink($dir_path);
							$uploaded_img = imagepng($t_image, $dir_path);
							imagedestroy($gdImg);
							imagedestroy($t_image);
							if ($uploaded_img) {
								$qry = $this->conn->query("UPDATE `client_list` set avatar = concat('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '$vid' ");
								if ($this->settings->userdata('id') == $id && $this->settings->userdata('login_type') == 2)
									$this->settings->set_userdata('avatar', $fname . "?v=" . (time()));
							}
						} else {
							$resp['msg'] .= " But Image failed to upload due to unkown reason.";
						}
					}
				}
			} else {
				$resp['status'] = 'failed';
				$resp['msg'] = " An error occure while saving the account details.";
				$resp['error'] = $this->conn->error;
			}
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['msg']);

		return json_encode($resp);
	}
	public function delete_client()
	{
		extract($_POST);
		$qry = $this->conn->query("UPDATE client_list set delete_flag = 1 where id = $id");
		if ($qry) {
			$this->settings->set_flashdata('success', ' Client Details successfully deleted.');
			$resp['status'] = 'success';
		} else {
			$resp['status'] = 'failed';
			$resp['msg'] = 'An error occured while deleting the data.';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	public function forgot_password()
	{
		extract($_POST);


		$token = bin2hex(random_bytes(32));

		// Set the token expiration timestamp (e.g., 1 hour from now)
		$expirationTimestamp = time() + 3600;

		// Store the token, email, and expiration timestamp in the database
		$stmt = $this->conn->prepare("INSERT INTO password_reset (email, token, expiration_timestamp) VALUES (?, ?, ?)");
		$stmt->bind_param("ssi", $email, $token, $expirationTimestamp);
		$stmt->execute();

		// Send the password reset email to the user
		$reset_link = "http://localhost/etrade/etrade/reset-password.php?token=" . $token;




		// $query  = $this->conn->query("SELECT * FROM `client_list` where email = '{$email}' and delete_flag = 0 ");
		$query = $this->conn->query("
    SELECT * FROM `client_list` WHERE email = '{$email}' AND delete_flag = 0
    UNION
    SELECT * FROM `vendor_list` WHERE email = '{$email}' AND delete_flag = 0
    LIMIT 1
");



		if ($query->num_rows > 0) {
			$row = $query->fetch_assoc();
			$name = $row['firstname'] ? $row['firstname'] . " " . $row['lastname'] : $row['shop_owner'];
			$email = $row['email'];

			// Send password reset Instruction

			$mailer->send_forgot_password($client_name, $client_email, $reset_link);
			$resp['status'] = 'success';
			$resp['msg'] = "Password Successfully Sent to Email";
			// $resp['msg'] = $resetLink;
		} else {
			$resp['status'] = 'failed';
			$resp['msg'] = " User does not exist";
		}

		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['msg']);

		return json_encode($resp);
	}

	public function reset_password()
	{
		extract($_POST);

		$stmt = $this->conn->prepare("SELECT email, expiration_timestamp FROM password_reset WHERE token = ?");
		$stmt->bind_param("s", $token);
		$stmt->execute();
		$result = $stmt->get_result();
		$resetData = $result->fetch_assoc();

		if ($resetData) {
			$email = $resetData['email'];
			$expirationTimestamp = $resetData['expiration_timestamp'];

			// Verify if the token is still valid (not expired)
			if (time() <= $expirationTimestamp) {
				// Token is valid, update the user's password in the database
				$hashedPassword = md5($new_password);

				$stmt = $this->conn->prepare("UPDATE client_list SET password = ? WHERE email = ?");
				$stmt->bind_param("ss", $hashedPassword, $email);
				$stmt->execute();

				// Delete the password reset entry from the database
				$stmt = $this->conn->prepare("DELETE FROM password_reset WHERE token = ?");
				$stmt->bind_param("s", $token);
				$stmt->execute();

				$resp['status'] = 'success';
				$resp['msg'] = "Password reset successfully";
			} else {
				// Token has expired
				$resp['status'] = 'failed';
				$resp['msg'] = "The password reset link has expired. Please request a new one";
			}
		} else {
			// Token is not valid
			$resp['status'] = 'failed';
			$resp['msg'] = "Invalid password reset link.";
		}

		if ($resp['status'] === 'success') {
			$this->settings->set_flashdata('success', $resp['msg']);
		}

		return json_encode($resp);
	}
}


$users = new users();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
switch ($action) {
	case 'save':
		echo $users->save_users();
		break;
	case 'delete':
		echo $users->delete_users();
		break;
	case 'save_vendor':
		echo $users->save_vendor();
		break;
	case 'delete_vendor':
		echo $users->delete_vendor();
		break;
	case 'save_client':
		echo $users->save_client();
	case 'forgot_password':
		echo $users->forgot_password();
		break;
	case 'reset_password':
		echo $users->reset_password();
		break;
	case 'delete_client':
		echo $users->delete_client();
	default:
		// echo $sysset->index();
		break;
}




//Mailer


<?php
echo "Good";
exit;

require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require './PHPMailer/src/Exception.php';

class Mailer {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.itpapp.site';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'support@itpapp.site';
        $this->mail->Password = 'aminmohammed98';
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port = 465;
        $this->mail->setFrom('support@itpapp.site', 'International Trade Properties');
        $this->mail->isHTML(true);
    }

    public function send_mail($recipient, $subject, $body) {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($recipient);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            
            $this->mail->send();
            return true;
        } catch (Exception $e) {
            return 'Email could not be sent. Error: ' . $this->mail->ErrorInfo;
        }
    }

    public function send_client($client_name, $client_email){
        $body = '<html>
        <head>
            <title>Account Registration</title>
            <style>
                body {
                    background-color: #f6f6f6;
                    font-family: Arial, sans-serif;
                }
                .container {
                    background-color: #ffffff;
                    border-radius: 10px;
                    padding: 20px;
                    margin: 20px auto;
                    max-width: 400px;
                    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                }
                h2 {
                    color: #333333;
                    text-align: center;
                    margin-top: 0;
                    padding-top: 10px;
                    border-top: 2px solid #007bff;
                }
                p {
                    color: #555555;
                    line-height: 1.5;
                    margin-bottom: 20px;
                }
                .button {
                    display: inline-block;
                    padding: 10px 20px;
                    background-color: #007bff;
                    color: #ffffff;
                    text-decoration: none;
                    border-radius: 5px;
                }
                .button:hover {
                    background-color: #0056b3;
                }
                .footer {
                    text-align: center;
                    color: #777777;
                    font-size: 12px;
                    margin-top: 20px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Account Registration</h2>
                <p>Dear '.$client_name.',</p>
                <p>Congratulations! Your account has been successfully registered.</p>
                <p>You can now start using our services and enjoy the benefits we offer.</p>
                <p>Should you have any questions or need any assistance, please feel free to reach out to our support team.</p>
                <p>
                    Thank you for choosing our platform. We look forward to serving you!
                </p>
                <p>
                    Best Regards,<br>
                    International Trade Properties (ITP)
                </p>
                <div class="footer">
                    This email is automatically generated. Please do not reply.
                </div>
            </div>
        </body>
        </html>
        ';
    }
    public function send_vendor($vendor_name, $vendor_email){
        $body = '<html>
        <head>
            <title>Vendor Account Registration</title>
            <style>
                body {
                    background-color: #f6f6f6;
                    font-family: Arial, sans-serif;
                }
                .container {
                    background-color: #ffffff;
                    border-radius: 10px;
                    padding: 20px;
                    margin: 20px auto;
                    max-width: 400px;
                    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                }
                h2 {
                    color: #333333;
                    text-align: center;
                    margin-top: 0;
                    padding-top: 10px;
                    border-top: 2px solid #007bff;
                }
                p {
                    color: #555555;
                    line-height: 1.5;
                    margin-bottom: 20px;
                }
                .button {
                    display: inline-block;
                    padding: 10px 20px;
                    background-color: #007bff;
                    color: #ffffff;
                    text-decoration: none;
                    border-radius: 5px;
                }
                .button:hover {
                    background-color: #0056b3;
                }
                .footer {
                    text-align: center;
                    color: #777777;
                    font-size: 12px;
                    margin-top: 20px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Vendor Account Registration</h2>
                <p>Dear '.$vendor_name.',</p>
                <p>Congratulations! Your vendor account has been successfully created.</p>
                <p>You are now part of our e-commerce platform, where you can showcase and sell your products to a wide audience.</p>
                <p>Start exploring the vendor dashboard and take advantage of the various features we provide to manage your products, orders, and more.</p>
                <p>If you have any questions or need assistance, please feel free to reach out to our dedicated vendor support team.</p>
                <p>
                    We wish you success and look forward to a fruitful partnership!
                </p>
                <p>
                    Best Regards,<br>
                    International Trade Properties (ITP)
                </p>
                <div class="footer">
                    This email is automatically generated. Please do not reply.
                </div>
            </div>
        </body>
        </html>
        ';

    }

    public function send_forgot_password($client_name, $client_email){
        $body = '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Password Reset</title>
            <style>
                /* Add some styles to make the email visually appealing */
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f6f6f6;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #fff;
                    border-radius: 4px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }
                h1 {
                    font-size: 24px;
                    margin-bottom: 20px;
                    text-align: center;
                }
                p {
                    margin-bottom: 20px;
                }
                .button {
                    display: inline-block;
                    background-color: #4CAF50;
                    color: #ffffff;
                    text-decoration: none;
                    padding: 10px 20px;
                    border-radius: 4px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>Password Reset</h1>
                <p>Dear [User],</p>
                <p>We received a request to reset your password. To reset your password, please click the button below:</p>
                <p>
                    <a class="button" href="[ResetLink]">Reset Password</a>
                </p>
                <p>If you did not request a password reset, please ignore this email.</p>
                <p>Best regards,<br>International Trade Properties (ITP)</p>
            </div>
        </body>
        </html>
        ';
         
    }
}

// Create Mailer Instance
$mailer = new Mailer();
$recipient = 'abdulsamadbalogun25@gmail.com';
$subject = 'Test HTML Email';

$body = '
    <html>
    <head>
        <title>Test HTML Email</title>
        <style>
            body {
                background-color: #f6f6f6;
                font-family: Arial, sans-serif;
            }
            .container {
                background-color: #ffffff;
                border-radius: 10px;
                padding: 20px;
                margin: 20px auto;
                max-width: 400px;
            }
            h2 {
                color: #333333;
                text-align: center;
            }
            p {
                color: #555555;
                line-height: 1.5;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Test HTML Email</h2>
            <p>This is a test email with HTML content and CSS styling.</p>
            <p>You can customize the email template further to meet your requirements.</p>
        </div>
    </body>
    </html>
';

$result = $mailer->send_mail($recipient, $subject, $body);
if ($result === true) {
    echo 'Email sent successfully!';
} else {
    echo $result;
}


// <!DOCTYPE html>
// <html>
// <head>
//     <meta charset="UTF-8">
//     <title>Password Reset</title>
//     <style>
//         /* Add some styles to make the email visually appealing */
//         body {
//             font-family: Arial, sans-serif;
//             background-color: #f6f6f6;
//         }
//         .container {
//             max-width: 600px;
//             margin: 0 auto;
//             padding: 20px;
//             background-color: #fff;
//             border-radius: 4px;
//             box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
//         }
//         h1 {
//             font-size: 24px;
//             margin-bottom: 20px;
//             text-align: center;
//         }
//         p {
//             margin-bottom: 20px;
//         }
//         .button {
//             display: inline-block;
//             background-color: #4CAF50;
//             color: #ffffff;
//             text-decoration: none;
//             padding: 10px 20px;
//             border-radius: 4px;
//         }
//     </style>
// </head>
// <body>
//     <div class="container">
//         <h1>Password Reset</h1>
//         <p>Dear [User],</p>
//         <p>We received a request to reset your password. To reset your password, please click the button below:</p>
//         <p>
//             <a class="button" href="[ResetLink]">Reset Password</a>
//         </p>
//         <p>If you did not request a password reset, please ignore this email.</p>
//         <p>Best regards,<br>Your Company Name</p>
//     </div>
// </body>
// </html>

