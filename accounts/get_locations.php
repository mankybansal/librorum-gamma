
				<?php
				ERROR_REPORTING(0);
					include '../includes/ServerConnect.php';
					
					
					$QUERY = "SELECT * FROM groups WHERE CITY='".$_POST['CITY']."'";
					$RESULT = mysql_query($QUERY);
					
					$INDEX = 0;
					$ARRAY = array();
					
					while($row = mysql_fetch_array($RESULT))
					{
						$GROUP = $row['GROUP_NAME'];
						$GROUP = strtolower($GROUP);
						$GROUP = ucwords($GROUP);
						
						$ARRAY[$INDEX] = "$GROUP";
						$INDEX++;
						
					}
					
					
					echo json_encode($ARRAY);
					
				?>