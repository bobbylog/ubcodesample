<?php
  session_start();

   //header('Content-Type: application/json');	
   
   include 'inc/dataconnect.php';
   include 'hashutils.php';
   

            if (!isset($_GET["atk"])){
                $authkey="NA";
            }else{
                $authkey=$_GET["atk"];
            }
            
            if (!$_SESSION["auth"]==$authkey){
                checkLoginInfo($_POST['email'],$_POST['password'],$_POST['profile']);
             }    
             
             



function checkLoginInfo($uname,$passw,$pin) {
          global $first_hashed;   
          global $second_hashed;
          global $dbh;

          $qry="SELECT u.*,p.profile_initial from ctm_user u inner join ctm_profile p on u.profileid=p.profileid where u.username='".$uname."' and u.password='".$passw."' and p.profile_initial='".$pin."' limit 1";
          $stmt=$dbh->query($qry);
          
          
          $profid=$stmt->fetchColumn(1);
          $stkey=$stmt->fetchColumn(4).date("Y-m-d H:i:s");
          $first_hashed1 = hash_hmac('sha512', $stkey, $first_key, TRUE);    
          $second_hashed1 = hash_hmac('sha512', $first_hashed1, $second_key);
          
          
          $qry2="SELECT * from ctm_profile where profileid='".$profid."'";
          $stmt2=$dbh->query($qry2);
          
          
          $profname=$stmt2->fetchColumn(1);
          //$profinit=$stmt2->fetchColumn(14);
          
          
          $qry3="SELECT * from ctm_fyear where profileid='".$profid."'";
          $stmt3=$dbh->query($qry3);
          
          $yrid=$stmt3->fetchColumn(0);
          $yrnm=$stmt3->fetchColumn(3);
          
          
          $qry4=$qry="SELECT count(batchid) from ctm_transact_batch where processed=0";
          $stmt4=$dbh->query($qry4);
          $bbgnum=$stmt4->fetchColumn(0);
          
          $qry5=$qry="SELECT count(budgetid) from ctm_budget where Approved=0";
          $stmt5=$dbh->query($qry5);
          $bbgappr=$stmt5->fetchColumn(0);
          
          $qry6=$qry="SELECT count(budgetid) from ctm_budget where Approved=2";
          $stmt6=$dbh->query($qry6);
          $bdraftn=$stmt6->fetchColumn(0);
          
          /*echo 'h1 '.$first_hashed1;
          echo 'h2 '.$second_hashed1;*/
          
          if($stmt->rowCount()==1){
                $_SESSION["username"] = $uname;
                $_SESSION["password"] = $passw;
                $_SESSION["profileid"] = $profid;
                $_SESSION["profilepin"] = $pin;
                $_SESSION["profilename"] = $profname;
                $_SESSION["yearid"] = $yrid;
                $_SESSION["yearname"] = $yrnm;
                $_SESSION["auth"] = $second_hashed1;
                $_SESSION["bbadge"] = $bbgnum;
                $_SESSION["bapprov"] = $bbgappr;
                $_SESSION["draftn"] = $bdraftn;
                header( 'Location: index.php?atk='.$second_hashed1 ) ;
          }else{
                $_SESSION["username"] =null;
                $_SESSION["password"] =null;
                $_SESSION["auth"] = null;
                $_SESSION["profileid"] = null;
                $_SESSION["profilepin"] = null;
                $_SESSION["profilename"] = null;
                $_SESSION["yearid"] = null;
                $_SESSION["yearname"] = null;
                $_SESSION["bbadge"] =null;
                $_SESSION["bapprov"] = null;
                $_SESSION["draftn"] = null;
                $_SESSION["DBNAME"] = null;
					 $_SESSION["PortalConnect"] = null;
					 $_POST=array();
					 session_destroy();   
                header( 'Location: login.php' ) ;
          }
          
        
         //echo 'coulmen : '.$stmt->rowCount();
          
       
}

         
?>       
