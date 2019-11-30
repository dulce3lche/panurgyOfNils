<?php 

function GET($fieldname, &$flag) {
  global $db ;
  $v = $_GET [$fieldname];
  $v = trim ( $v );
  if ($v == "")
    { $flag = true; echo "<br><br>$fieldname is empty." ; return ;} ;
  $v = mysqli_real_escape_string ($db, $v) ;
  echo "<br><br>$fieldname is $v." ;
  return $v;
}

function deposit($UCID, $type, $amount, $mail) {
  global $db;
  $s = "insert into Transactions values ('$UCID', '$type','$amount', NOW(), '$mail')" ;
  print "<br>SQL insert statement is: $s<br>";
  ($t = mysqli_query ($db, $s)) or die(mysqli_error($db) );
  echo "<br>Deposit successful."; 
  
  $s = " update Accounts set current = '$amount' + current, recent = NOW() where UCID = '$UCID' " ;
  print "<br>SQL insert statement is: $s<br>";
  ($t = mysqli_query( $db,  $s ) ) or die( "<br>SQL error: " . mysqli_error($db) );
  print "<br>SQL statement was updated in Accounts.<br>";     
}

function insert($UCID, $pass, $name, $mail, $initial, $pass2)
{  global $db;
  $s = "insert into Accounts values ('$UCID', '$pass', '$name', '$mail', '$initial', '$initial', NOW(), '$pass2')";
  print "<br>SQL insert statement is: $s<br>";
  ($t = mysqli_query ($db, $s)) or die(mysqli_error($db) );
  echo "<br>Account Created."; 
}
function addAccount($UCID, $pass, $initial)
{ global $db;
  $s = "insert into Transactions values ('$UCID', 'D','$initial', NOW(), 'N')" ;
  print "<br>SQL insert statement is: $s<br>";
  ($t = mysqli_query ($db, $s)) or die(mysqli_error($db) );
  echo "<br>Initial Amount Recorded."; 
  
  
}
function withdraw($UCID, $type, $amount, $mail) {
 global $db;
 $s = "insert into Transactions values ('$UCID', '$type', '$amount', NOW(), '$mail')" ;
 print "<br>SQL insert statement is: $s<br>"; 
 ($t = mysqli_query ($db, $s)) or die(mysqli_error($db) );
  echo "<br>Withdrawal successful."; 
  
  $s = " update Accounts set current = current - '$amount', recent = NOW() where UCID = '$UCID' " ;
  ($t = mysqli_query( $db,  $s ) ) or die( "<br>SQL error: " . mysqli_error($db) );
  print "<br>SQL statement was updated Accounts.<br>"; 
  
}

function enough ( $UCID, $amount, $db ) { 

  $s ="select * from Accounts where UCID='$UCID' and current  >='$amount' " ;
  echo "<br>$s<br>";
  ($t =mysqli_query($db, $s) ) or die ( mysqli_error($db)  );
 
   $num =  mysqli_num_rows ($t ) ;
   if  ( $num > 0) {return true ; } else { return false ; } ; 
  
}

function authenticate($UCID,$pass,$db)
{
	global $t;
	$s = "select * from Accounts where UCID = '$UCID'"; 
	print "<br>SQL select is: $s <br>";
 ($t = mysqli_query ($db, $s ) ) or die ( mysqli_error ($db) );
 $num = mysqli_num_rows ($t);
	echo"<br>The number of rows retieved for $UCID is: $num<br>";
	$r = mysqli_fetch_array ($t, MYSQLI_ASSOC);
	$hash=$r["pass"];
  echo "<br>The hash: $hash<br>";
	
  if(password_verify($pass,$hash)) {
		return true; 
	}
	else {
		return false;
	}	
}

function displayT ( $UCID, $account, &$out, $db )
{   global $t;

    $out = "";
    $s = " select * from Transactions where ucid = '$UCID' and account = '$account' " ; 
    $out .= "<br>SQL select is: $s <br>"; 
    ($t = mysqli_query ( $db, $s) ) or die (mysqli_error($db) );
    $num = mysqli_num_rows($t); 
    
    
    echo "<table border = 3 width = 50%>"; 
    echo "<th>UCID</th>";
   // echo "<th>Account<th>";
    echo "<th>type</th>";
    echo "<th>amount</th>";
    echo "<th>date</th>";
    echo "<th>mail</th>";
      
      while ( $r = mysqli_fetch_array ( $t, MYSQLI_ASSOC) ){    
         echo "<tr>";
         $UCID = $r[ "UCID" ] ;
         $type = $r[ "type" ] ;
         $amount = $r[ "amount" ] ;
         $date = $r[ "date" ] ;
         $mail = $r[ "mail" ] ;
         
         echo "<td>$UCID</td>" ;
         echo "<td>$type</td>" ;
         echo "<td>$amount</td>" ;
         echo "<td>$date</td>" ;
         echo "<td>$mail</td>" ;
         
         echo "</tr>";
         };
    echo "</table"; 
}


function displayA ( $UCID, $account, &$out, $db )
{   global $t;

    $out = "";
    $s = " select * from Accounts where ucid = '$UCID' and account = '$account' " ; 
    $out .= "<br>SQL select is: $s <br>"; 
    ($t = mysqli_query ( $db, $s) ) or die (mysqli_error($db) );
     $num = mysqli_num_rows($t); 
     
    
    echo "<table border = 3 width = 50%>"; 
    echo "<th>UCID</th>";
    echo "<th>Account</th>";
    echo "<th>pass</th>";
    echo "<th>name</th>";
    echo "<th>mail</th>";
    echo "<th>initial</th>";
    echo "<th>current</th>";
    echo "<th>recent</th>";
    echo "<th>plaintext</th>";
   
    
      
      while ( $r = mysqli_fetch_array ( $t, MYSQLI_ASSOC) ){    
         echo "<tr>";
         $UCID = $r[ "UCID" ] ;
         $account = $r[ "Account" ];
         $pass = $r[ "pass" ];
         $name = $r[ "name" ];
         $mail = $r[ "mail" ];
         $initial = $r[ "initial" ];
         $current = $r[ "current" ];
         $recent = $r[ "recent" ];
         $plaintext = $r[ "plaintext"];
         
         
         
         
         echo "<td>$UCID</td>" ;
         echo "<td>$account</td>" ;
         echo "<td>$pass</td>" ;
         echo "<td>$name</td>" ;
         echo "<td>$mail</td>" ;
         echo "<td>$initial</td>" ;
         echo "<td>$current</td>";
         echo "<td>$recent</td>" ;
         echo "<td>$plaintext</td>" ;
        ;
         
         
         
         echo "</tr>";
         };
    echo "</table"; 
    }
    
    

?>