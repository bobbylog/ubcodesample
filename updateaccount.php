
<?php	
									       
									       include 'inc/dataconnect.php';
									       
									       
											
										$p_Accountid=$_POST["accountid"];
						                $p_AccountNo=$_POST["paccountno"];
						                //$p_CreationDate=$_POST["pcreatedate"];
						                $p_AccountName=$_POST["paccountname"];
						                
						                $p_InitAmount=floatval(preg_replace('/[^\d\.]/', '',$_POST["pamount"]));
						                /*if (is_null($p_InitAmount)){$p_InitAmount=0;};*/
						                
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
										
									
										
	                             
										$stmt = $dbh->prepare("CALL ctm_updateAccount (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");					
										
									
										$stmt->bindParam(1, $p_AccountNo); 
										$stmt->bindParam(2, $p_AccountName); 
										$stmt->bindParam(3, $p_InitAmount);
										$stmt->bindParam(4, $p_ByPercent); 
										$stmt->bindParam(5, $p_PercentRate); 
	                                    $stmt->bindParam(6, $p_AccCur); 
										$stmt->bindParam(7, $p_AccSource); 
										$stmt->bindParam(8, $p_Location); 
										$stmt->bindParam(9, $p_Status);
										$stmt->bindParam(10, $p_Comments); 
										$stmt->bindParam(11, $p_AType); 
										$stmt->bindParam(12, $p_Order); 
										$stmt->bindParam(13, $p_Accountid); 
										$stmt->bindParam(14, $p_CCenter);
									   $stmt->bindParam(15, $p_user);
					
										$stmt->execute();

                                                                               ?>


  <body>				
</body>
</html>									


									
                                     