<?php	
									       
									       include 'inc/dataconnect.php';
									       
									       
											
										$p_Budgetid=$_POST["pbudgetid"];
						                $p_AccountNo=$_POST["paccountno"];
						                $p_CreationDate=$_POST["pcreatedate"];
						                $p_AccountName=$_POST["paccountname"];
						                $p_InitAmount= floatval(preg_replace('/[^\d\.]/', '', $_POST["pamount"]));
						                $p_ByPercent=$_POST["pbypercent"];
						                $p_PercentRate=$_POST["ppercentrate"];
						                $p_AccCur='NA';
						                $p_AccSource=$_POST["psource"];
						                $p_Location=$_POST["plocation"];
						                $p_Status=$_POST["pstatus"];
						                $p_Comments=$_POST["pnote"];
						                $p_AType=$_POST["paccounttype"];
										$p_Order=$_POST["porder"];
										$p_CCenter=$_POST["pccenter"];
										$p_user=$_POST["puid"];
										
	
										
										$stmt = $dbh->prepare("CALL ctm_insertAccount (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");					
										
									$stmt->bindParam(1, $p_Budgetid); 
										$stmt->bindParam(2, $p_AccountNo); 
										$stmt->bindParam(3, $p_CreationDate); 
										$stmt->bindParam(4, $p_AccountName); 
										$stmt->bindParam(5, $p_InitAmount);
										$stmt->bindParam(6, $p_ByPercent); 
										$stmt->bindParam(7, $p_PercentRate); 
	                           $stmt->bindParam(8, $p_AccCur); 
										$stmt->bindParam(9, $p_AccSource); 
										$stmt->bindParam(10, $p_Location); 
										$stmt->bindParam(11, $p_Status);
										$stmt->bindParam(12, $p_Comments); 
										$stmt->bindParam(13, $p_AType); 
										$stmt->bindParam(14, $p_Order); 
										$stmt->bindParam(15, $p_CCenter);
										$stmt->bindParam(16, $p_user);
									
									    
					
										$stmt->execute();

                                                                               ?>


  <body>				
</body>
</html>									


									
                                     