
<?php	
                       //header('Content-Type: application/json');	
 									       
									    include 'inc/dataconnect.php';
						
						//print_r($_POST);
								
            $p_frm=$_POST["formid"];
					$p_firstn=$_POST["q29_fullName"]["first"];
					$p_lastn=$_POST["q29_fullName"]["last"];
					$p_email=$_POST["q43_email"];
					$p_address1=$_POST["q44_address"]["addr_line1"];
					$p_address2=$_POST["q44_address"]["addr_line2"];
					$p_city=$_POST["q44_address"]["city"];
					$p_state=$_POST["q44_address"]["state"];
					$p_postal=$_POST["q44_address"]["postal"];
					$p_country=$_POST["q44_address"]["country"];
					$p_phone=$_POST["q45_phoneNumber"]["area"].$_POST["q45_phoneNumber"]["phone"];
					$p_creduid="";
					//$_POST["q48_credentials"]["first"];
					//$p_credpwd=$_POST["q48_credentials"]["last"];
					$p_profile=$_POST["q49_profile"];
					$p_prof_init=$_POST["q51_profilePin"];
					$p_credpwd=$_POST["q56_adminPassword"];
					$p_occup=$_POST["q55_occupation"];
					$p_industry=$_POST["q53_industry"];
					$p_agegrp=$_POST["q54_ageGroup"];
					$p_wherehear=$_POST["q61_whereDid"];
					
					$p_availplanid=$_POST["q40_availablePlans"]["0"]["id"];
					$p_planfirst=$_POST["q40_availablePlans"]["cc_firstName"];
					$p_planlast=$_POST["q40_availablePlans"]["cc_lastName"];
					
					
					$p_simplespc=$_POST["simple_spc"];
					$p_eventid=$_POST["event_id"];
									    
									    
								
    
    try {
    	$user1='bobbylog_bobbylog';
    	$pass1='Pegaz124x';
		$dbhi = new PDO('mysql:host=localhost;dbname=bobbylog_budget_customerdb', $user1, $pass1);
		
			    } catch (PDOException $ex) {
		    print "Error!: " . $ex->getMessage() . "<br/>";
		    //die();
		}                	
      
                  
	
	
							    
									 
									    $stmt1 = $dbhi->prepare("CALL ctm_proc_create_submission(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
									   
									

										$stmt1->bindParam(1, $p_frm); 
										$stmt1->bindParam(2, $p_firstn); 
										$stmt1->bindParam(3, $p_lastn); 
										$stmt1->bindParam(4, $p_email); 
										$stmt1->bindParam(5, $p_address1); 
										$stmt1->bindParam(6, $p_address2); 
										$stmt1->bindParam(7, $p_city); 
										$stmt1->bindParam(8, $p_state); 
										$stmt1->bindParam(9, $p_postal); 
										$stmt1->bindParam(10, $p_phone); 
										$stmt1->bindParam(11, $p_country); 
										$stmt1->bindParam(12, $p_creduid); 
										$stmt1->bindParam(13, $p_credpwd); 
										$stmt1->bindParam(14, $p_profile); 
										$stmt1->bindParam(15, $p_availplanid); 
										$stmt1->bindParam(16, $p_planfirst); 
										$stmt1->bindParam(17, $p_planlast); 
										$stmt1->bindParam(18, $p_simplespc); 
										$stmt1->bindParam(19, $p_eventid);
										$stmt1->bindParam(20, $p_prof_init);
										$stmt1->bindParam(21, $p_occup);
										$stmt1->bindParam(22, $p_industry);
										$stmt1->bindParam(23, $p_agegrp);
										$stmt1->bindParam(24, $p_wherehear);
										
								
										
										
										
										$stmt1->execute();
										
										$stmt1->closeCursor();
										
										
										$infoaaddrString="";
										/*p_frm."|".$p_firstn."|".$p_lastn"|".$p_email."|".$p_address1."|".$p_address2."|".$p_city."|".$p_state."|".$p_postal."|".$p_phone."|".$p_country;*/
										
										$infoPlanString="";
										/*$p_creduid."|".$p_credpwd."|".$p_profile"|".$p_availplanid."|".$p_planfirst."|".$p_planlast."|".$p_simplespc."|".$p_eventid."|".$p_prof_init;*/
										
										
										$qry="SELECT profile_initial, assigned_dbname from customer_profile where profile_initial='".$p_prof_init."'";
                                        //$stmt2=$dbhi->query($qry);
                                        
                                        foreach($dbhi->query($qry) as $row) {
									              //print_r($row);
									             }
          
          
                                        $bbgappr=$row["profile_initial"];
                                        $bbdbname=$row["assigned_dbname"];
                                        
                                        
                                        //echo print_r($stmt2);
                                        //echo $bbgappr;
                                        //echo $bbdbname;
                                        
                                        
                              if ($bbgappr==$p_prof_init){
                              	$execstring="/home/senghor_etienne/dbfiles/./database_create {$bbdbname} {$p_prof_init} 2>&1";
                              	//echo $execstring;
											exec($execstring, $output);                              
                              }
                              
                              //print_r($output);
                                        
										

										
										
                          		
										//echo json_encode(array('status' => 'ok', 'ident' =>$bbgappr ));                  

                                       ?>


									
                                     
