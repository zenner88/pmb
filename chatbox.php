<?php
/* 
-----
Author	: Ali Marjan
Email	: lee_zeddo@yahoo.co.id
Website	: http://www.aleezone.co.nr
-----
*/

// Untuk Inisialisasi Database
   $DBhost = "localhost";   // Database Server
   $DBuser = "root";            // Database User
   $DBpass = "";            // Database Pass
   $DBName = "pmb2012";            // Database Name
   $table = "chatbox";             // Database Table
   $numComments = 10;       // Number of Comments per page
   
   // Connect to mySQL Server
   $DBConn = mysql_connect($DBhost,$DBuser,$DBpass) or die("Error in Chatbox: " . mysql_error());
   // Select mySQL Database
   mysql_select_db($DBName, $DBConn) or die("Error in Chatbox: " . mysql_error());
   

// Untuk Action di Form flash swf
   $action = $_GET['action'];
   
   switch($action) {
      case 'read' :
		 // mengambil semua komen dari database table
		 $sql = 'SELECT * FROM `' . $table . '`';
		 $allComments = mysql_query($sql, $DBConn) or die("Error in Chatbox: " . mysql_error());
		 $numallComments = mysql_num_rows($allComments);
		 // mengambil per-halaman untuk pagging.
		 $sql .= ' ORDER BY `time` DESC LIMIT ' . $_GET['NumLow'] . ', ' . $numComments;
		 $fewComments = mysql_query($sql, $DBConn) or die("Error in Chatbox: " . mysql_error());
		 $numfewComments = mysql_num_rows($fewComments);
		 // Meng-generate data view di flash.
		 print '&totalEntries=' . $numallComments . '&';
		 print "<br>&entries=";	
		 
		 if($numallComments == 0) {
		    print "No entries in the chatbox, as yet..";
		 } else { 
		    while ($array = mysql_fetch_array($fewComments)) {
			   $name = strip_tags(mysql_result($fewComments, $i, 'name'));
			   $email = strip_tags(mysql_result($fewComments, $i, 'email'));
			   $comments = strip_tags(mysql_result($fewComments, $i, 'comments'));
			   $time = mysql_result($fewComments, $i, 'time');
			   
			   echo "<b>Name: </b>$name";
			   echo "<br><b>Comments: </b>$comments"; 
			   echo "<br><i>Date: $time </i><br><br>";
			   
			   $i++;
		    }
		}
		// Ngeprint klo ga ada data.
		if($_GET['NumLow'] > $numallComments) {
		   print 'No More Entries!&';
		}
		break;
		 
	  case 'write' :
	     // menerima variabel dari flash.
		 $name = ereg_replace("&", "%26", $_POST['yourname']);
		 $email = ereg_replace("&", "%26", $_POST['youremail']);
		 $comments = ereg_replace("&", "%26", $_POST['yourcomments']);
		 $ip = $_SERVER['REMOTE_ADDR'];
		 $submit = $_POST['submit'];
		 	 
		 // untuk date: yyyy-mm-dd format
		 $submitted_on = date ("Y-m-d H:i:s",time());
		 		 
		 // Check kondisi pengisian form
		 if($submit == 'Yes'){
		 // Insert kedalam mysql table
		 $sql = 'INSERT INTO ' . $table . 
                ' (`ID`, 
				   `name`, 
				   `email`, 
				   `comments`, 
				   `ip_pengunjung`,
				   `time`
				  ) 
				  VALUES 
				  (\'\','
				   . '\'' . $name . '\',' 
				   . '\'' . $email . '\',' 
				   . '\'' . $comments . '\',' 
				   . '\'' . $ip . '\','
				   . '\'' . $submitted_on . '\'
				   )';
		 $insert = mysql_query($sql, $DBConn) or die("Error in ChatBox: " . mysql_error());
		 
		 // If you want your script to send email to both you and the guest, uncomment the following lines of code
		 // Email Script Begin
		
		 /* <-- Remove this line
		 $MyName = "Mohsin Sumar";
		 $MyEmail = "mohsinsumar@hotmail.com";
		 $Subject = "$name has just signed your guestbook.";
		 $EmailBody = "Hello Mohsin,\n$name has just signed your guestbook available at http://www.mohsinsumar.com. THe following were the details submitted into your guestbook:\n\nName: $name\nEmail: $email\nComment:\n$comments\n";
		 
		 $EmailFooter = "~~~~~~~~~~~~~~~\nThe guestbook was signed by $name and thus this email got activated by $name from $REMOTE_ADDR from http://www.mohsinsumar.com\n~~~~~~~~~~~~~~~\nThanking you,\nMohsin Sumar";
		 
		 $Message = $EmailBody.$EmailFooter;
		 
		 mail($MyName." <".$MyEmail.">",$Subject, $Message, "From: ".$name." <".$email.">");
		 --> Remove this line */
		 
		 // Email Script End
		 
		 print "&chat_status=Terima kasih !!!&done=yes&";
		 return;
		 }
		 print "&_root.write.chat_status=Error!&";
		 break;
   }
?>