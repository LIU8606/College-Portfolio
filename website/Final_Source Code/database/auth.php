<?php
	if(!isset($_SESSION)){
		session_start();
	}
	include __DIR__ . '/database.php';
	//ini_set("display_errors", "On");
	// extending the class database/Database makes sure your connection of DB.
	class Auth extends Database
	{
		public function login($account, $password) {

			// $query = 'Your-Query';
			// $result = $this->db->query($query);
			//$query = 'select u.password from user u where "$account"=u.account_name ';
			//echo "abc";

			$query = "select password from user u where ID='$account'";
			$result = $this->db->query($query);
			$row=$result->fetch_row();//fetch the first row of result
			$query = "select identity from user u where ID='$account'";
			$result = $this->db->query($query);
			$row2=$result->fetch_row();
			//echo "row: $row[0] <br>";
			$auth=0;
			//Wrong password
			if($row[0] != hash('sha256', $password)) {
				//echo "wrong";
				//redirect to login page

				header('Location: ' . '/login.php');
			}
			else{//Success password
				//redirect to home page
				$auth=1;
				$_SESSION['username']=$account;
				$_SESSION['identity']=$row2[0];
				//echo $_SESSION["identity"];
				//echo $_SESSION["username"];
				header('Location: ' . '/index.php');
			} 
			return $auth;

			// return sometsthing you like
		}
		//Insert data of new user into DB
		public function register($ID, $password,$lastname,$firstname,$email) {

			$query = "insert into user values('$ID', '$password', 0, '$firstname', '$lastname', '$email')";
			$result = $this->db->query($query);

			
			$code=hash('sha256',$email);
			$message = "Your Activation Code is ".$code."";
			$to=$email;
			$subject="Activation Code For NCTUsports";
			$from = 'noreply@liu_wants_a_boy_friend.com';
			

			$body='Your Activation Code is '.$code.' Please Click On This link <a href="localhost:8888/verification.php">Verify.php?code='.$code.'</a>to activate  your account.';

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= "From:".$from;
			mail($to,$subject,$body,$headers);

			

			header('Location: ' . '/index.php');
		}
		//Insert data of new event into DB
		public function newevent($eventname, $eventdate,$teamlimit,$memberlimit) {
			$query = "insert into events values(NULL, '$eventname', '$eventdate','$teamlimit','$memberlimit', 0, 0)";
			$result = $this->db->query($query);
			header('Location: ' . '../eventadmin.php');
			// return something you like
		}
		public function editevent($ID, $eventname, $eventdate,$teamlimit,$memberlimit) {
			$query = "UPDATE events SET eventname='$eventname', eventdate='$eventdate', teamlimit='$teamlimit', memberlimit='$memberlimit' WHERE ID='$ID'";
			$result = $this->db->query($query);
			header('Location: ' . '../eventadmin.php');
			// return something you like
		}
		public function viewevent() {

			$query = "select * from events";
			$result = $this->db->query($query);
			return $result;
		}
		public function findevent($ID) {

			$query = "select * from events where ID = '$ID'";
			$result = $this->db->query($query);
			return $result;
		}
		public function deleteevent($ID) {

			$query = "UPDATE events SET is_delete = 1 WHERE ID = '$ID'";
			$result = $this->db->query($query);
			header('Location: ' . '../eventadmin.php');
		}
		public function tempteamate($ID) {
			$query = "SELECT user_ID FROM temp where team_ID = '$ID'";
			$result = $this->db->query($query);
			return $result;
		}
		public function getname($ID) {
			$query = "SELECT firstname, lastname FROM user where ID = '$ID'";
			$result = $this->db->query($query);
			$row = $result->fetch_row();
			return $row;
		}
		public function delete_teamate($ID, $r, $n) {
			$query = "DELETE FROM temp WHERE team_ID = '$r' and user_ID = '$ID'";
			$result = $this->db->query($query);
			header('Location: ' . "../signup.php?n=$n&r=$r");
		}
		public function add_teamate($user_ID, $team_ID, $n) {
			$yee = "select * from temp where user_ID = '$user_ID' and team_ID = '$team_ID'";
			$yeee = $this->db->query($yee);
			$yeeee = $yeee->fetch_row();
			$q = "select * from user where ID = '$user_ID'";
			$qq = $this->db->query($q);
			$row = $qq->fetch_row();
			if($row[0] != NULL && $yeeee[0] == NULL) {
				$query = "insert into temp values('$team_ID', '$user_ID')";
				$result = $this->db->query($query);
			}
			header('Location: ' . "../signup.php?n=$n&r=$team_ID");
		}
		public function submit($team_ID, $team_name, $event_ID) {
			//echo $team_ID; //temp 
			//echo $team_name; //ok
			//echo $event_ID; //2
			
			$query = "insert into team values(NULL, '$team_name', '$event_ID')";
			$result = $this->db->query($query);
			$query = "select ID from team where name = '$team_name' and event_ID = '$event_ID'";
			$result = $this->db->query($query);
			$realteamID = $result->fetch_row();
			
			$quserid = "select user_ID from temp where team_ID = '$team_ID'";
			$result = $this->db->query($quserid);
			while($userid = mysqli_fetch_array($result)) {
				$query = "insert teamate select team.ID, temp.user_ID from team, temp where team.ID = '$realteamID[0]' and temp.user_ID = '$userid[0]' and temp.team_ID = '$team_ID'";
				$this->db->query($query);
			}
			$query = "update events set signupteams = signupteams+1 where ID = '$event_ID'";
			$this->db->query($query);
			if($_SESSION['identity'] == 1)
				header('Location: ' . "/eventadmin.php");
			else
				header('Location: ' . "/events.php");
		}
		public function team_name($ID) {
			$query = "select ID ,name from team where event_ID = '$ID'";
			$result = $this->db->query($query);
			return $result;		
		}
		public function teamates($team_ID) {
			$query = "select user_ID from teamate where team_ID = '$team_ID'";
			$result = $this->db->query($query);
			return $result;		
		}
		public function user_name($user_ID) {
			$query = "select lastname, firstname from user where ID = '$user_ID'";
			$result = $this->db->query($query);
			return $result;		
		}
		public function is_signed($event_ID, $user_ID) {
			$query = "SELECT ID FROM team WHERE event_ID = '$event_ID' AND ID = (SELECT team_ID FROM teamate WHERE user_ID = '$user_ID')";
			$result1 = $this->db->query($query);
			$row = $result1->fetch_array();

			$query = "SELECT user.ID, user.lastname, user.firstname from user, teamate where teamate.team_ID = '$row[0]' AND user.ID = teamate.user_ID";
			$result = $this->db->query($query);
			return $result;	
		}
		public function delete_signup($event_ID, $user_ID) {
			//報名數量減一
			$query = "update events set signupteams = signupteams-1 where ID = '$event_ID'";
			$this->db->query($query);

			//找team_ID
			$query = "SELECT ID FROM team WHERE event_ID = '$event_ID' AND ID = (SELECT team_ID FROM teamate WHERE user_ID = '$user_ID')";
			$result = $this->db->query($query);
			$row = $result->fetch_row();

			//刪teamate
			$query = "DELETE from teamate where team_ID = '$row[0]'";
			$result = $this->db->query($query);

			//刪team
			$query = "DELETE FROM team WHERE ID = '$row[0]'";
			$this->db->query($query);

			if($_SESSION['identity'] == 1)
				header('Location: ' . "/eventadmin.php");
			else
				header('Location: ' . "/events.php");
		}

		public function Title(){


			$query = "SELECT * FROM Announcement
					  ORDER BY Posted_Time";
			$result = $this->db->query($query);
			
			$title = array();
			while($row = $result->fetch_assoc()){
				array_push($title,$row);
			}
			return $title;

		}

		public function broad($title, $content) {

			// $query = 'Your-Query';
			// $result = $this->db->query($query);

			$query = "INSERT INTO Announcement(Title,Description) VALUES('$title','$content')";


			if ($this->db->query($query) == TRUE) {
   				 echo "New record created successfully";
   				 return 1;
			} else {
 			   echo "Error: " . $sql . "<br>" . $this->db->error;
			}
			

		}

		
		public function delete($ID){


			$query = "DELETE FROM Announcement WHERE ID = '$ID'";


			if ($this->db->query($query) == TRUE) {
   				 echo "Delete successfully";

			} else {
 			   echo "Error: " . $sql . "<br>" . $this->db->error;

			}


		}

		public function delete_muti($check){


 			foreach($check as $value){
 				//echo $value;
 				$query = "DELETE FROM Announcement WHERE ID = '$value'";

				if ($this->db->query($query) == TRUE) {
	   				 echo "Delete successfully";

				} else {
	 			   echo "Error: " . $sql . "<br>" . $this->db->error;

				}
  				//mysql_query($query,$this->db);
 			}
			




		}

		public function anncs($ID){


			$query = "SELECT * FROM Announcement WHERE ID = '$ID'";
			$result = $this->db->query($query);
			
			$row = $result->fetch_row();

			return $row;


		}

		public function edit($title, $content, $ID) {

			// $query = 'Your-Query';
			// $result = $this->db->query($query);

			//$result = delete('$old_title');
			$datetime = date("Y-m-d H:i:s",mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y')));
			echo $datetime;
			$query = "UPDATE Announcement SET Title = '$title', Description = '$content',Posted_Time = '$datetime' WHERE ID = '$ID'";

			if ($this->db->query($query) == TRUE) {
   				 echo "New record created successfully";
   				 return 1;
			} else {
 			   echo "Error: " . $query . "<br>" . $this->db->error;
			}
			

		}




	}

?>