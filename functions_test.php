<?php
	require_once('functions.php');

	//Save progress for current user (by user_id)
	function save(){
		$save_sqli = new mysqli("localhost", "root", "", "test");
		if ($save_sqli){
			$stmt_save = $save_sqli->prepare("UPDATE save SET one = ?, two = ?, three = ?, four = ?, five = ? WHERE id = ?");
			$stmt_save->bind_param("iiiiii", $save_one, $save_two, $save_three, $save_four, $save_five, $_SESSION['user_id']);
			
			if ($stmt_save){
				//Ternary Operations: take answer value from question via $_POST if isset(), otherwise set to 0
				$save_one = isset($_POST['one']) ? $_POST['one'] : 0;
				$save_two = isset($_POST['two']) ? $_POST['two'] : 0;
				$save_three = isset($_POST['three']) ? $_POST['three'] : 0;
				$save_four = isset($_POST['four']) ? $_POST['four'] : 0;
				$save_five = isset($_POST['five']) ? $_POST['five'] : 0;

				$stmt_save->execute();
				$stmt_save->close();
			}
		}
	}

	//Get answer value from save data to a specific question
	function get_save_int($question){
		$save_sqli = new mysqli("localhost", "root", "", "test");
		if($save_sqli){
			$stmt_checksave = $save_sqli->prepare("SELECT ".$question." FROM save WHERE id = ?");
			if ($stmt_checksave){
				$stmt_checksave->bind_param("i", $_SESSION['user_id']);
				$stmt_checksave->execute();
				$row_result = $stmt_checksave->get_result();
				$value = $row_result->fetch_object();
				$save_result = 0;
				switch ($question){
					case "one":
						$save_result = $value->one; break;
					case "two":
						$save_result = $value->two; break;			
					case "three":
						$save_result = $value->three; break;
					case "four":
						$save_result = $value->four; break;
					case "five":
						$save_result = $value->five; break;
				}

				$stmt_checksave->close();
				return (int)$save_result;
			}
			return 0;
		}
	}

	function reset_save(){
		$reset_sqli = new mysqli("localhost", "root", "", "test");
			if ($reset_sqli){
				$stmt_reset = $reset_sqli->prepare("UPDATE save SET one = ?, two = ?, three = ?, four = ?, five = ? WHERE id = ?");
				$stmt_reset->bind_param("iiiiii", $reset_value, $reset_value, $reset_value, $reset_value, $reset_value, $_SESSION['user_id']);
				$reset_value = 0;
				$stmt_reset->execute();
				$stmt_reset->close();
			}
	}

	function submit_test() {
		save();
		calculate_result();
		Header('Location: /result.php');
	}

	function calculate_result() {
		$result_sqli = new mysqli("localhost", "root", "", "test");
		if($result_sqli){
			$array_save = get_row_array($result_sqli, "save");
			$array_solution = get_row_array($result_sqli, "solution");

			$result = 0;
			$num_questions = 5;
			for ($i = 1; $i < 1+$num_questions; $i++){
				if($array_save[$i] == $array_solution[$i])
					$result++;
			}
			$_SESSION['result'] = $result;
			set_result($result);
		}
	}

	function set_result($result) {
		$setresult_sqli = new mysqli("localhost", "root", "", "test");
		if($setresult_sqli){
			$stmt_setresult = $setresult_sqli->prepare("UPDATE save SET result = ? WHERE id = ?");
			if ($stmt_setresult){
				$stmt_setresult->bind_param("ii", $final_result, $_SESSION['user_id']);
				$final_result = $_SESSION['result'];
				$stmt_setresult->execute();
				$stmt_setresult->close();
			}
		}
	}
?>