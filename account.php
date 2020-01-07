<?php
    session_start();
            include 'inc/dataconnect.php';
            include 'security.php';
            setlocale(LC_MONETARY, 'en_US.UTF-8');
 //echo $_SESSION["username"];
  ?>
  

<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="root" >
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Budgeto Money Management</title>
    <!-- Bootstrap Core CSS -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Footable CSS -->
    <link href="../assets/plugins/footable/css/footable.core.css" rel="stylesheet">
    <link href="../assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    
    <!--alerts CSS -->
    <link href="../assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- page css -->
    <link href="css/pages/footable-page.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/default-dark.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->


<style>
    
   /* #myModal {
    top:15%;
    outline: none;
}

   #myModalEdit {
    top:15%;
    outline: none;
}
*/


.buttonload {
    background-color: #4CAF50; /* Green background */
    border: none; /* Remove borders */
    color: white; /* White text */
    padding: 12px 24px; /* Some padding */
    font-size: 16px; /* Set a font-size */
}

/* Add a right margin to each icon */

    
</style>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  




<script>

function SaveAccount(x){
    
    var budgfrm=document.getElementById("idaccount");
    
       x.addclass='buttonload';
    x.innerHTML=' <i class="fa fa-refresh fa-spin"></i> Creating Account ...';

  $.ajax({
        url: 'sendaccount.php',
        type: 'post',
        data: $(budgfrm).serialize(),
        success: function(data) {
                $('#myAccount').modal('toggle');
              
                    location.reload();
                   // alert("Successfully Created!");    
                //});
                
                 }
    });
    
    
}

function updateAccount(x){
    
    var budgfrm=document.getElementById("idaccountedit");
    
    //alert('ok');
    
       x.addclass='buttonload';
    x.innerHTML=' <i class="fa fa-refresh fa-spin"></i> Saving ...';
    
    $.ajax({
       url: 'updateaccount.php',
       type: 'post',
       data: $(budgfrm).serialize(),
       success: function(data) {
               $('#myAccountEdit').modal('toggle');
              

                 location.reload();
                 //  alert("Saved!");

               //});


                }
   });

   
  
   
    
}

function RemoveAccount(did,trdid){
    
    var tab1=document.getElementById("demo-foo-addrow2");
    
 elled", "Your Data is safe :)", "error"); 
    
            swal({   
            title: "Are you sure you want to retire this account?",   
            text: "You will not be able to recover it!",   
            type: "warning",   showCancelButton: true,  
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, retire it!",  
            cancelButtonText: "No, cancel!",   
            closeOnConfirm: false,   closeOnCancel: true 
            }, 
            function(isConfirm){   
            
            if (isConfirm) {    
              
             $.ajax({
                url: 'removeaccount.php',
                type: 'post',
                data:{paccountid:did},
                success: function(data, response) {
                     tab1.deleteRow(trdid.rowIndex);
                        swal("Retired!", "Account is successfully retired.", "success");  
            
                         }
            });
            
           
           
            
              } 
              else {   
                 // swal("Cancelled", "Your Data is safe :)", "error");   
                  
              } 
                
            });
           
 

}


function SaveIncome(){
    
    var budgfrm=document.getElementById("idincome");
    
    //alert('ok');
    budgfrm.method='post';
    budgfrm.action='sendincome.php';
    budgfrm.submit();
    
}

function SaveExpense(){
    
    var budgfrm=document.getElementById("idexpense");
    var bnumber= document.getElementById("bnum");
    var nbrrows;
    
     
 $.ajax({
                url: 'sendexpense.php',
                type: 'post',
                datatype:'json',
                data:$(budgfrm).serialize(),
                success: function (data, response){
                     $('#myExpense').modal('toggle');
                    
                    $('#bnum').addClass('label-danger');
                    bnumber.innerText=data.numrows;
                    
                    nbrrows=data.numrows;
                     
                     
                   }
  }).done(function(data) {
      
      var nbrrows1=data.numrows;
      $.ajax({
                url: 'setbadgenum.php',
                type: 'post',
                datatype:'json',
                data:{nv:nbrrows1},
                success: function (data, response){
                    //alert('nr '+ data.nr);
                }
     });
  
  });

 
  
}

function SaveTransfer(){
    
    var budgfrm=document.getElementById("idtransfer");
    
    //alert('ok');
    //budgfrm.method='post';
    //budgfrm.action='sendtransfer.php';
    //budgfrm.submit();

    var bnumber= document.getElementById("bnum");
    var nbrrows;
    
   

  $.ajax({
                url: 'sendtransfer.php',
                type: 'post',
                datatype:'json',
                data:$(budgfrm).serialize(),
                success: function (data, response){
                     $('#myTransfer').modal('toggle');
                    
                    $('#bnum').addClass('label-danger');
                    bnumber.innerText=data.numrows;
                    
                    nbrrows=data.numrows;
                     
                     
                   }
  }).done(function(data) {
      
      var nbrrows1=data.numrows;
      
      $.ajax({
                url: 'setbadgenum.php',
                type: 'post',
                datatype:'json',
                data:{nv:nbrrows1},
                success: function (data, response){
                    //alert('nr '+ data.nr);
                }
     });
  
  });
  
    
    
}

function SaveAlloc(){
    
    var budgfrm=document.getElementById("idalloc");
    
    //alert('ok');
    //budgfrm.method='post';
    //budgfrm.action='sendalloc.php';
    //budgfrm.submit();
    
    
    
    var bnumber= document.getElementById("bnum");
    var nbrrows;
    
   

  $.ajax({
                url: 'sendalloc.php',
                type: 'post',
                datatype:'json',
                data:$(budgfrm).serialize(),
                success: function (data, response){
                     $('#myAlloc').modal('toggle');
                    
                    $('#bnum').addClass('label-danger');
                    bnumber.innerText=data.numrows;
                    
                    nbrrows=data.numrows;
                     
                     
                   }
  }).done(function(data) {
      
      $.ajax({
                url: 'setbadgenum.php',
                type: 'post',
                datatype:'json',
                data:{nv:nbrrows},
                success: function (data, response){
                    //alert('nr '+ data.nr);
                }
     });
  
  });
  
    
}


/*function toggle(x) {
 if( document.getElementById(x.id).style.display=='none' ){
   document.getElementById(x.id).style.display = 'table-row'; // set to table-row instead of an empty string
 }else{
   document.getElementById(x.id).style.display = 'none';
 }
}*/

function toggle(x) {
    
    var nid=x.id;
    var nido=nid.replace("tr","tsign");
    
    //alert(nido);
    var ts=document.getElementById(nido);
    
 if( document.getElementById(x.id).style.display=='none' ){
   document.getElementById(x.id).style.display = 'table-row'; // set to table-row instead of an empty string
   ts.className="fa fa-minus";
   
 }else{
   document.getElementById(x.id).style.display = 'none';
   ts.className="fa fa-plus";
 }
}

function toggleAmount(x){
    
    var iamt=document.getElementById("aamounta");
    
    if (x.value=='Yes'){
        iamt.value=0;
        iamt.disabled=true;
    }    
    else{
        iamt.disabled=false;
        
    }
    
    
}

function toggleAmountEdit(x){
    
    var iamt=document.getElementById("aamount");
    
    if (x.value=='Yes'){
        iamt.value=0;
        iamt.disabled=true;
    }    
    else{
        iamt.disabled=false;
        
    }
    
    
}

function LoadAccount(did){
    
   
    
    //alert (did);
    
    var ids1=did+'_1';
    var ids2=did+'_2';
    var ids3=did+'_3';
    var ids4=did+'_4';
    var ids5=did+'_5';
    var ids6=did+'_6';
    var ids7=did+'_7';
    var ids8=did+'_8';
    var ids9=did+'_9';
    var ids10=did+'_10';
    var ids11=did+'_11';
    var ids12=did+'_12';
    var ids13=did+'_13';
    var ids14=did+'_14';
    var ids15=did+'_15';
    var ids16=did+'_16';
     
    //alert(document.getElementById(ids8).innerText);
   
    //var budg=document.getElementById("bgid");
    
    var accid=document.getElementById("paccountid");
    
    
    var acctype=document.getElementById("atype");
    var accscr=document.getElementById("asource");
    
    var abyperc=document.getElementById("abypercent");
    var abypercrt=document.getElementById("abypercrate");
    var aloc=document.getElementById("alocation");
    
    var iamt=document.getElementById("aamount");
    var astat=document.getElementById("astatus");
    
    var actname=document.getElementById("acname");
    var actno=document.getElementById("aano");
    var actorder=document.getElementById("aord");
    var actccenter=document.getElementById("bccenter");
    
    var actnote=document.getElementById("bnote");
    
    //var actstdate=document.getElementById("bstartdt");
     
   accid.value=did;
   
    
    actname.value=document.getElementById(ids1).innerText.trim();
    
    accscr.value=document.getElementById(ids4).innerText.trim();
    
    acctype.value=document.getElementById(ids5).innerText.trim();
    abyperc.value=document.getElementById(ids6).innerText.trim();
    abypercrt.value=document.getElementById(ids7).innerText.trim();
    
    aloc.value=document.getElementById(ids8).innerText.trim();
    
    if (abyperc.value=='Yes'){
    iamt.value=0;
    iamt.disabled=true;
    }else{
        iamt.value=document.getElementById(ids9).innerText;
        iamt.disabled=false;
    }
    
    
    astat.value=document.getElementById(ids10).innerText.trim();
    
    actno.value=document.getElementById(ids11).innerText.trim();
    
    actorder.value=document.getElementById(ids12).innerText.trim();
    
    actccenter.value=document.getElementById(ids14).innerText.trim();
    
    actnote.value=document.getElementById(ids16).innerText.trim();
    //actstdate.value=document.getElementById(ids15).innerText.trim();
  
    
    //budgfrm.method='post';
    //budgfrm.action='sendbudget.php';
    //budgfrm.submit();
    
}

function ReloadAccount(){
    
    
  
  $.ajax({
        url: 'reloadaccount.php',
        type: 'post',
        success: function(data) {
              
                location.reload();
           
                
                 }
    });
   
    
    //window.location.reload();
    
}


</script>



</head>

<body class="fix-header card-no-border fix-sidebar">
    
             <?php  
                                                
                                             /*   $_SESSION["username"]="budgetadmin";
                                                 
                                                  $qry="SELECT * from tmp_Budget_Info_Result order by Budgetid asc";
                                               
                                               */
                                               
                                          $stmt=$dbh->query($qry);
                 
                                                // echo$stmt->fetchColumn(0) ;
                                                  
                                                 
                                   ?>
    
    
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Loading...</p>
        </div>
    </div>
    
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
          
          <?php
            include 'header.php';
           
           ?>
           
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
       
       
            <?php
              include 'sidebar.php';
            ?>
       
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><?php echo $_SESSION["profilename"];?></h3>
                </div>
            
           
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item">pages</li>
                        <li class="breadcrumb-item active">Accounts</li>
                    </ol>
                </div>
                <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
             
                        <!-- Column -->
                        
                        
                			<?php    
                				$qry0="SELECT getBudgetTitleFromBudgetId({$_GET['budid']}) as title, getBudgetBalance({$_GET['budid']}) as balance";
          		 				$stmt0=$dbh->query($qry0);
          		 				foreach($stmt0 as $rowl){
          		 				$bname=$rowl["title"];
                				$bbalance=$rowl["balance"];
          		 				}
                				
                				$bbalanced=money_format('%.2n',$bbalance);
 
            				?>
            
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> <a Onclick="window.location='index.php?atk=<?php echo $_SESSION["auth"];?>';" class="btn btn-primary btn-xs" >
                                                   <i class="fa-angle-double-left"></i>
                                                </a> &nbsp;  Accounts [<span class="text-primary"> Budget: <?php echo "{$bname}"." - "."{$bbalanced}"; ?></span>] </h4>
                                <h6 class="card-subtitle"></h6>
                                
                                
                                <table id="demo-foo-addrow2" class="table table-hover toggle-circle" data-page-size="7">
                                    <thead>
                                        <tr>
                                            <th data-sort-initial="true" data-toggle="true">Name</th>
                                            <th>Balance</th>
                                            <th data-hide="all"> ID </th>
                                            <th data-hide="all"> Acccount No: </th>
                                            <th data-hide="all"> Cost Center </th>
                                            <th data-hide="all"> Started On </th>
                                            <th data-hide="all"> Source </th>
                                            <th data-hide="all"> Type </th>
                                            <th data-hide="all"> By Percent </th>
                                             <th data-hide="all">Percent Rate </th>
                                            <th data-hide="all"> Location </th>
                                            <th data-hide="all"> Initial Amount </th>
                                            <th data-hide="all"> Order </th>
                                            <th data-hide="all"> Status </th>
                                            <th data-hide="all"> Income</th>
                                            <th data-hide="all"> Expenses </th>
                                            <th data-hide="all"> Transfers </th>
                                            <th data-hide="all"> Allocations </th>
                                            <th data-hide="all"> Pending </th>
                                            <th data-hide="all">Balance</th>
                                            <th data-hide="all">Notes</th>
                                            <th data-hide="phone, tablet"></th>
                                            <th></th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <div class="m-t-40">
                                        <div class="row">
                                            
                                            <div style="margin-left:10px;" class="mr-auto row btn-toolbar" role="group" aria-label="First group" >
                                               
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="icon wb-plus" aria-hidden="true"></i>New Account
                                                    </button>
                                                     &nbsp;
                                                       <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myExpense"><i class="icon wb-plus" aria-hidden="true"></i>New Expense
                                                    </button>
                                                        &nbsp;
                                                  <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myTransfer"><i class="icon wb-plus" aria-hidden="true"></i>New Transfer
                                                    </button>
                                                 
                                                   &nbsp;
                                                  <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myAlloc"><i class="icon wb-plus" aria-hidden="true"></i>New Allocation
                                                    </button> 
                                                     &nbsp;
                                                  <!-- button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myIncome"><i class="icon wb-plus" aria-hidden="true"></i>New Income
                                                    </button -->  
                                                    
                                                        &nbsp;
                                                  <button class="btn btn-primary btn-sm" Onclick="javascript:ReloadAccount();return false;"><i class="icon wb-plus" aria-hidden="true"></i>Reload
                                                    </button>
                                            </div>
                                            
                                            <div class="ml-auto">
                                                <div class="form-group">
                                                    <input id="demo-input-search2" type="text" placeholder="Search" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <tbody>
                                    
                                       <?php         
                                          $id=$_GET["budid"];
                                          $qry="CALL `ctm_proc_profile_tmp_Account_Info_Result`({$id})";
                                          
                                          //echo $qry;
         //echo($id);
          foreach($dbh->query($qry) as $row) {
            //print_r($row);
           //echo "show here ".$row["costcenter"]."<br/>";
           ?> 
                                    
                                        <tr id="tr_<?php echo $row["Accountid"];?>">
                                          
                                            <td><span  id="<?php echo($row["Accountid"]);?>_1"> <?php echo $row["AccountName"];?> </span> </td>
                                            
                                            <td><?php echo(money_format('%.2n',$row["Balance"])); ?></td>
                                              
                                            <td> <?php echo($row["Accountid"]); ?> </td>
                                            <td><span  id="<?php echo($row["Accountid"]);?>_11"> <?php echo($row["AccountNo"]); ?> </span></td>
                                            
                                            <td><span  id="<?php echo($row["Accountid"]);?>_14"> <?php echo($row["CostCenter"]); ?> </span></td>
                                            
                                             <td><span  id="<?php echo($row["Accountid"]);?>_15"> <?php echo($row["CreationDate"]); ?> </span> </td>
                                             
                                              
                                             
                                             
                                            <td><span  id="<?php echo($row["Accountid"]);?>_4"> <?php echo($row["SourceAccount"]); ?> </span> </td>
                                            <td> <span  id="<?php echo($row["Accountid"]);?>_5"> <?php echo($row["AccountType"]); ?> </span></td>
                                            <td> <span  id="<?php echo($row["Accountid"]);?>_6"> <?php echo($row["ByPercent"]); ?> </span> </td>
                                            
                                            <td> <span  id="<?php echo($row["Accountid"]);?>_7"> <?php echo($row["PercentRate"]); ?> </span> </td>
                                            
                                            <td> <span  id="<?php echo($row["Accountid"]);?>_8"> <?php echo($row["Location"]); ?> </span> </td>
                                            
                                            <td> <span  id="<?php echo($row["Accountid"]);?>_9"> <?php echo(money_format('%.2n',$row["InitialAmount"])); ?> </span> </td>
                                            <td> <span  id="<?php echo($row["Accountid"]);?>_12"> <?php echo($row["aOrder"]); ?> </span> </td>
                                            
                                            <td > <span  id="<?php echo($row["Accountid"]);?>_10"> <i class="text-success"> <?php echo($row["accStatus"]); ?></i> </span></td>
                                            
                                            <td> <i class="text-danger"><?php echo(money_format('%.2n',$row["Income"])); ?></i></td>
                                            
                                            <td> <i class="text-danger"><?php echo(money_format('%.2n',$row["Expense"])); ?></i></td>
                                            
                                            <td> <i class="text-danger"><?php echo(money_format('%.2n',$row["Transfer"])); ?></i></td>
                                            
                                            <td> <i class="text-warning"><?php echo(money_format('%.2n',$row["Alloc"])); ?></i></td>
                                            <td> (<i class="text-danger"><?php echo(money_format('%.2n',$row["Pending"])); ?> </i>)</td>
                                            <td><i class="text-success"> <?php echo(money_format('%.2n',$row["Balance"])); ?></i> </td>
                                            <td> <span  id="<?php echo($row["Accountid"]);?>_16"> <?php echo($row["Comments"]); ?> </span> </td>
                                            
                                                <td><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info" onclick="window.location= 'activity.php?atk=<?php echo $_SESSION["auth"];?>&accid=<?php echo($row["Accountid"]); ?>&budid=<?php echo($row["Budgetid"]); ?>'" >See Activities</button>
                                                </td>
                                                
                                                <td>
                                                 <button type="button" onClick="javascript:LoadAccount(this.getAttribute('data-idc'));" class="btn btn-sm btn-icon btn-pure btn-outline" data-idc="<?php echo($row["Accountid"]);?>" data-toggle="modal" data-target="#myAccountEdit" data-original-title="Edit"><i class="fa fa-pencil text-inverse m-r-10" aria-hidden="true"></i></button> 
                                                 <button onClick="javascript:RemoveAccount(this.getAttribute('data-idc'), tr_<?php echo $row["Accountid"];?>);" type="button" class="btn btn-sm btn-icon btn-pure btn-outline" data-toggle="tooltip" data-idc="<?php echo($row["Accountid"]);?>" data-original-title="Retire Account"><i class="fa fa-close text-danger" aria-hidden="true"></i></button>
                                            </td>
                                            
                                            
                                            
                                            
                                        </tr>
                                      
                      
		   
		                                                               <?php
          }
           
        ?>     
		                             
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6">
                                                <div class="text-right">
                                                    <ul class="pagination">
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                
                  <?php
              include 'rightsidebar.php';
            ?>
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer"> © 2017 Admin Pro by wrappixel.com </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    
    
    
     <!-- Modal -->
                             <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel1">Add Account</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                        <div class="modal-body">

                                          
                                    <form role="form" id="idaccount" name="accountfrm">
                                  
                                        <input name="pbudgetid" value="<?php echo $id;?>" hidden>
                                        <input name="puid" value="<?php echo $_SESSION["username"];?>" hidden>
                                                
                                        
                            
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs customtab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home2" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">General</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile2" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Details</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages2" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Other Settings</span></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home2" role="tabpanel">
                                
                                 <div class="p-20"> 
                                    
                                    
                                    
                                     <div class="form-group">
                                            <label>Account No</label>
                                            <input name="paccountno" class="form-control" placeholder="Enter text">
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Cost Center</label>
                                            <input name="pccenter" class="form-control" placeholder="Enter text">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Account Name</label>
                                            <input name="paccountname" class="form-control" placeholder="Enter text">
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Account Type</label>
                                            <select name="paccounttype" class="form-control">
                                                <option value="Bank">Bank</option>
                                                <option value="Budget">Budget</option>
                                                <option value="Funder">Funder</option>
                                                <option value="Allocation">Allocation</option>
                                            </select>
                                        </div>
                                        
                                          <div class="form-group">
                                            <label>Source</label>
                                            <select name="psource" class="form-control">
                                                <option value=""></option>
                            <?php                        
         
          foreach($dbh->query('SELECT * from ctm_budget_funder_set order by Accountno asc') as $row) {
            //print_r($row);
           
           ?> 
                                                <option value="<?php echo($row["AccountNo"]); ?>"><?php echo($row["AccountNo"]); ?></option>
                                        
                                                <?php
                                                 }
           
        ?>
                                            </select>
                                        </div>
                                   
                                        
                                      
                                        
                                     </div>  
                                        

                                </div>
                                
                                
                                <div class="tab-pane  p-20" id="profile2" role="tabpanel">
                                        
                                          <div class="form-group">
                                            <label>By Percent</label>
                                            <select onclick="toggleAmount(this);" id="aperca" name="pbypercent" class="form-control">
                                                <option value="No">No</option>
                                                <option value="Yes">Yes</option>
                                            </select>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label>Percent Rate</label>
                                            <input name="ppercentrate" class="form-control" placeholder="Enter text">
                                        </div>


                                        <div class="form-group">
                                            <label>Initial Amount</label>
                                            <input id="aamounta" name="pamount" class="form-control" placeholder="Enter text">
                                        </div>
                                   
                                   
                                </div>
                                
                                
                                 <div class="tab-pane p-20" id="messages2" role="tabpanel">
                                
                                
                                   <div class="form-group">
                                            <label>Order</label>
                                            <input name="porder" class="form-control" placeholder="Enter text">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="pstatus" class="form-control">
                                                <option value="Active">Active</option>
                                                <option value="Closed">Closed</option>
                                            </select>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label>Note</label>
                                            <input name="pnote" class="form-control" placeholder="Enter text">
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label>Location</label>
                                            <select name="plocation" class="form-control">
                                                <option>Keybank</option>
                                                <option>MandT</option>
                                                <option>Sefcu</option>
                                            </select>
                                        </div>
                                
                                  
                                </div>
                                
                                
                            </div>            
                                        <!-- button type="submit" class="btn btn-default">Submit Button</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button -->
                                        
                                    </form>
                                
                                            
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" Onclick="javascript:SaveAccount(this);return false;">Add</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal --> 
                            
                            
    <!-- Modal income -->
                             <div class="modal fade" id="myIncome" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel1">Add Income</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                        <div class="modal-body">
                                          
                                    <form role="form" id="idincome" name="incomefrm">
                                        
                                         <input name="pbudgetid" value="<?php echo $id;?>" hidden>
                                         
                                          <input name="pyear" value="<?php echo $_SESSION["yearid"];?>" hidden>
                                         
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input name="ptransdate" class="form-control" placeholder="Enter text">
                                        </div>

                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input name="pamount" class="form-control" placeholder="Enter text">
                                        </div>
                                       
                                            <div class="form-group">
                                            <label>Account</label>
                                            <select name="paccountno" class="form-control">
                                                <option value=""></option>
                            <?php                        
                            
                            $qry='SELECT * from ctm_budget_funder_set order by Accountno asc';
         
          foreach($dbh->query($qry) as $row) {
            //print_r($row);
           
           ?> 
                                                <option value="<?php echo($row["Accountid"]); ?>"><?php echo($row["AccountName"]); ?></option>
                                        
                                                <?php
                                                 }
           
        ?>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Note</label>
                                            <input name="pnote" class="form-control" placeholder="Enter text">
                                        </div>
                                        
                             <!-- button type="submit" class="btn btn-default">Submit Button</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button -->
                                        
                                    </form>
                                
                                            
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" Onclick="javascript:SaveIncome();return false;">Add</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal income --> 
   
   
    
      <!-- Modal expenses -->
      
       <div class="modal fade" id="myExpense" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel1">Add Expense</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                        <div class="modal-body">
      
                                          
                                    <form role="form" id="idexpense" name="expensefrm">
                                        
                                         <input name="pbudgetid" value="<?php echo $id;?>" hidden>
                                         <input name="towner" value="<?php echo $_SESSION["username"];?>" hidden>
                                         
                                           <input name="pyear" value="<?php echo $_SESSION["yearid"];?>" hidden>
                                         
                                        <!-- div class="form-group">
                                            <label>Date</label>
                                            <input name="ptransdate" class="form-control" placeholder="Enter text">
                                        </div -->

                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input name="pamount" class="form-control" placeholder="Enter text">
                                        </div>
                                       
                                          <div class="form-group">
                                            <label>Account</label>
                                            <select name="paccountno" class="form-control">
                                                <option value=""></option>
                            <?php                        
                            
                            $qry='SELECT * from ctm_budget_items_set where budgetid='.$id.'  order by Accountno asc';
         
          foreach($dbh->query($qry) as $row) {
            //print_r($row);
           
           ?> 
                                                <option value="<?php echo($row["Accountid"]); ?>"><?php echo($row["AccountName"]); ?></option>
                                        
                                                <?php
                                                 }
           
        ?>
                                            </select>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Category</label>
                                            <select name="pcatno" class="form-control">
                                                <option value="Housing">Housing</option>
                                                <option value="Transportation">Transportation</option>
                                                <option value="Food">Food</option>
                                                <option value="Utilities">Utilities</option>
                                                <option value="Insurance">Insurance</option>
                                                <option value="Healthcare">Healthcare</option>
                                                <option value="Personal">Personal</option>
                                                <option value="Entertainment">Entertainment</option>
                                                <option value="Other">Other</option>
                                            </select>
              
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label>Supplier</label>
                                            <input name="psupplier" class="form-control" placeholder="Enter text">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Note</label>
                                            <input name="pnote" class="form-control" placeholder="Enter text">
                                        </div>
                                        
                             <!-- button type="submit" class="btn btn-default">Submit Button</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button -->
                                        
                                    </form>
                                
                                            
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" Onclick="javascript:SaveExpense();return false;">Add</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal expenses --> 
    
    
     
    <!-- Modal transfer -->
                           <div class="modal fade" id="myTransfer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel1">Add Transfer</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                        <div class="modal-body">
                                          
                                    <form role="form" id="idtransfer" name="transferfrm">
                                        
                                        <input name="pbudgetid" value="<?php echo $id;?>" hidden >
                                        <input name="towner" value="<?php echo $_SESSION["username"];?>" hidden>
                                        
                                           <input name="pyear" value="<?php echo $_SESSION["yearid"];?>" hidden>
                                           
                                        
                                        <!-- div class="form-group">
                                            <label>Date</label>
                                            <input name="ptransdate" class="form-control" placeholder="Enter text">
                                        </div -->
                                        
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input name="pamount" class="form-control" placeholder="Enter text">
                                        </div>
                                       
                                                                                <div class="form-group">
                                            <label>From Account</label>
                                            <select name="paccountfrom" class="form-control">
                                                <option value=""></option>
                            <?php                        
                            
                            $qry='SELECT * from ctm_budget_items_set where budgetid='.$id.'  order by Accountno asc';
         
          foreach($dbh->query($qry) as $row) {
            //print_r($row);
           
           ?> 
                                                <option value="<?php echo($row["Accountid"]); ?>"><?php echo($row["AccountName"]); ?></option>
                                        
                                                <?php
                                                 }
           
        ?>
                                            </select>
                                        </div>
                                        
                                          <div class="form-group">
                                            <label>To Account</label>
                                            <select name="paccountto" class="form-control">
                                                <option value=""></option>
                            <?php                        
                            
                            $qry='SELECT * from ctm_budget_items_set where budgetid='.$id.'  order by Accountno asc';
         
          foreach($dbh->query($qry) as $row) {
            //print_r($row);
           
           ?> 
                                                <option value="<?php echo($row["Accountid"]); ?>"><?php echo($row["AccountName"]); ?></option>
                                        
                                                <?php
                                                 }
           
        ?>
                                            </select>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label>Note</label>
                                            <input name="pnote" class="form-control" placeholder="Enter text">
                                        </div>
                                        
                                        
                                       
                                        
                                        <!-- button type="submit" class="btn btn-default">Submit Button</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button -->
                                        
                                    </form>
                                
                                            
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" Onclick="javascript:SaveTransfer();return false;">Add</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal transfer --> 
                            
                            
                            
                            
                         <!-- Modal Alloc -->
                             <div class="modal fade" id="myAlloc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel1">Add Allocation</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                        <div class="modal-body">
                                          
                                    <form role="form" id="idalloc" name="allocfrm">
                                        
                                        <input name="pbudgetid" value="<?php echo $id;?>" hidden >
                                        <input name="towner" value="<?php echo $_SESSION["username"];?>" hidden>
                                        
                                           <input name="pyear" value="<?php echo $_SESSION["yearid"];?>" hidden>
                                           
                                        <!-- div class="form-group">
                                            <label>Date</label>
                                            <input name="ptransdate" class="form-control" placeholder="Enter text">
                                        </div -->
                                        
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input name="pamount" class="form-control" placeholder="Enter text">
                                        </div>
                                        
                                       
                                        <div class="form-group">
                                            <label>From Account</label>
                                            <select name="paccountfrom" class="form-control">
                                                <option value=""></option>
                            <?php                        
                            
                            $qry='SELECT * from ctm_budget_items_set where budgetid='.$id.'  order by Accountno asc';
         
          foreach($dbh->query($qry) as $row) {
            //print_r($row);
           
           ?> 
                                                <option value="<?php echo($row["Accountid"]); ?>"><?php echo($row["AccountName"]); ?></option>
                                        
                                                <?php
                                                 }
           
        ?>
                                            </select>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label>Allocation Key</label>
                                            <input name="pbudgetto" class="form-control" placeholder="Enter text">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Note</label>
                                            <input name="pnote" class="form-control" placeholder="Enter text">
                                        </div>
                                        
                                        
                                       
                                        
                                        <!-- button type="submit" class="btn btn-default">Submit Button</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button -->
                                        
                                    </form>
                                
                                            
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" Onclick="javascript:SaveAlloc();return false;">Add</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal Alloc -->        
         
         
         
         
             <!-- Modal Account Edit -->
                        
                            <div class="modal fade" id="myAccountEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel1">Add Account</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                        <div class="modal-body">

                                          
                                    <form role="form" id="idaccountedit" name="accountfrm">
                                  
                                        <input name="pbudgetid" value="<?php echo $id;?>" hidden>
                                        
                                         <input name="accountid" id="paccountid" value="<?php echo($row["Accountid"]);?>" hidden>
                                                
                                        <input name="puid" value="<?php echo $_SESSION["username"];?>" hidden>
                            
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs customtab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home2Edit" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">General</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile2Edit" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Details</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages2Edit" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Other Settings</span></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home2Edit" role="tabpanel">
                                
                                 <div class="p-20"> 
                                    
                        
                                     <div class="form-group">
                                            <label>Account No</label>
                                            <input id="aano" name="paccountno" class="form-control" placeholder="Enter text">
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Cost Center</label>
                                            <input name="pccenter" id="bccenter" class="form-control" placeholder="Enter text">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Account Name</label>
                                            <input id="acname" name="paccountname" class="form-control" placeholder="Enter text">
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Account Type</label>
                                            <select id="atype" name="paccounttype" class="form-control">
                                                <option value="Bank">Bank</option>
                                                <option value="Budget">Budget</option>
                                                <option value="Funder">Funder</option>
                                                <option value="Allocation">Allocation</option>
                                            </select>
                                        </div>
                                        
                                        
                                         
                                            <div class="form-group">
                                            <label>Source</label>
                                            <select id="asource" name="psource" class="form-control">
                                                <option value=""></option>
                            <?php                        
         
          foreach($dbh->query('SELECT * from ctm_budget_funder_set order by Accountno asc') as $row) {
            //print_r($row);
           
           ?> 
                                                <option value="<?php echo($row["AccountNo"]); ?>"><?php echo($row["AccountNo"]); ?></option>
                                        
                                                <?php
                                                 }
           
        ?>
                                            </select>
                                        </div>
                                        
                                        
                                        </div>  
                                        

                                </div>
                                
                                
                                <div class="tab-pane  p-20" id="profile2Edit" role="tabpanel">
                                        
                                        
                                         <div class="form-group">
                                            <label>By Percent</label>
                                            <select onclick="toggleAmountEdit(this);" id="abypercent" name="pbypercent" class="form-control">
                                                <option value="No">No</option>
                                                <option value="Yes">Yes</option>
                                            </select>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label>Percent Rate</label>
                                            <input id="abypercrate" name="ppercentrate" class="form-control" placeholder="Enter text">
                                        </div>
                                       
                                        
                                        <div class="form-group">
                                            <label>Initial Amount</label>
                                            <input id="aamount" name="pamount" class="form-control" placeholder="Enter text">
                                        </div>
                                        
                                     
                                 </div>
                                
                                
                                 <div class="tab-pane p-20" id="messages2Edit" role="tabpanel">
                                
                                    
                                   
                                            <div class="form-group">
                                            <label>Order</label>
                                            <input id="aord" name="porder" class="form-control" placeholder="Enter text">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select id="astatus" name="pstatus" class="form-control">
                                                <option value="Active">Active</option>
                                                <option value="Closed">Closed</option>
                                            </select>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label>Note</label>
                                            <input name="pnote" id="bnote" class="form-control" placeholder="Enter text">
                                        </div>
                                        
                                   
                                   
                                    
                                        
                                        <div class="form-group">
                                            <label>Location</label>
                                            <select id="alocation" name="plocation" class="form-control">
                                                <option>Keybank</option>
                                                <option>MandT</option>
                                                <option>Sefcu</option>
                                            </select>
                                        </div>
                                   
                              </div>
                                
                                
                            </div>    
                                        
                                        
                                        <!-- button type="submit" class="btn btn-default">Submit Button</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button -->
                                        
                                    </form>
                                
                                            
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" Onclick="javascript:updateAccount(this);return false;">Save Changes</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal AccountEdit--> 
  
                            
    
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- Footable -->
    <script src="../assets/plugins/footable/js/footable.all.min.js"></script>
    <script src="../assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <!--FooTable init-->
    <script src="js/footable-init.js"></script>
    <!-- ============================================================== -->
    
      <!-- Sweet-Alert  -->
    <script src="../assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="../assets/plugins/sweetalert/jquery.sweet-alert.custom.js"></script>
    
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>