
 <?php



                     if(isset($_POST['filter']))
                         {
                           $fromdate = $_POST['fromdate'];
                           $todate = $_POST['todate'];
                        $open = $conn->query("SELECT * FROM administrator_account_name where refid='1' ");
                            $bils = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where DATE(dayBookDate)>='$fromdate' AND DATE(dayBookDate) <= '$todate' AND finyear = '".$_SESSION["finyearid"]."' and debit='6'  and mode='1'   and dr_cr='D' Group BY debit ORDER BY refid ");
                             $bils1 = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where DATE(dayBookDate)>='$fromdate' AND DATE(dayBookDate) <= '$todate' AND  finyear = '".$_SESSION["finyearid"]."' and credit='46' and mode='1'  and dr_cr='C' Group BY credit ORDER BY refid
 ");
                              $dex = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.debit= b.refid WHERE DATE(a.dayBookDate)>='$fromdate' AND DATE(a.dayBookDate) <= '$todate' AND  b.act_group_head='12' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='D' Group BY a.debit ORDER BY a.refid");
                              $dex1 = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.cred= b.refid WHERE DATE(a.dayBookDate)>='$fromdate' AND DATE(a.dayBookDate) <= '$todate' AND b.act_group_head='14' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='C' Group BY a.credit ORDER BY a.refid");
                              $bil5 = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where DATE(dayBookDate)>='$fromdate' AND DATE(dayBookDate) <= '$todate' AND   finyear = '".$_SESSION["finyearid"]."' and credit='5'  and mode='1'   and dr_cr='C' Group BY credit ORDER BY refid ");
                               $bil2 = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where DATE(dayBookDate)>='$fromdate' AND DATE(dayBookDate) <= '$todate' AND   finyear = '".$_SESSION["finyearid"]."' and debit='4'  and mode='1'   and dr_cr='D' Group BY debit ORDER BY refid ");

                               $inex = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.debit= b.refid WHERE DATE(a.dayBookDate)>='$fromdate' AND DATE(a.dayBookDate) <= '$todate' AND b.act_group_head='13' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='D'  Group BY a.debit ORDER BY a.refid");
                               $inex1 = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.credit= b.refid WHERE DATE(a.dayBookDate)>='$fromdate' AND DATE(a.dayBookDate) <= '$todate' AND  b.act_group_head='15' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='C'  Group BY a.credit ORDER BY a.refid");
                          
                         }



                         else{
                           $open = $conn->query("SELECT * FROM administrator_account_name where refid='1' ");
                            $bils = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where  finyear = '".$_SESSION["finyearid"]."' and debit='6'  and mode='1'   and dr_cr='D' Group BY debit ORDER BY refid ");
                             $bils1 = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where finyear = '".$_SESSION["finyearid"]."' and credit='46' and mode='1'  and dr_cr='C' Group BY credit ORDER BY refid
 ");
                              $dex = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.debit= b.refid WHERE b.act_group_head='12' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='D'  Group BY a.debit ORDER BY a.refid");
                              $dex1 = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.credit= b.refid WHERE b.act_group_head='14' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='C'  Group BY a.credit ORDER BY a.refid");
                              $bil5 = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where  finyear = '".$_SESSION["finyearid"]."' and credit='5'  and mode='1'   and dr_cr='C' Group BY credit ORDER BY refid ");
                               $bil2 = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where  finyear = '".$_SESSION["finyearid"]."' and debit='4'  and mode='1'   and dr_cr='D' Group BY debit ORDER BY refid ");

                               $inex = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.debit= b.refid WHERE b.act_group_head='13' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='D'  Group BY a.debit ORDER BY a.refid");
                               $inex1 = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.credit= b.refid WHERE b.act_group_head='15' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='C'  Group BY a.credit ORDER BY a.refid");
                        
                         }
                ?>

                                    <!-- <button type="button"  style="float: right;" class="btn btn-primary btn-rounded"  onClick="showmodel()" float="right"><span class="glyphicon glyphicon-plus"></span>Add New</button><br><br>-->
                                    


      <!-- --------------GRID 1-1  --------------------------- -->
                                                      
                                                                 <?php
                                                                  $exptot=0;
                                                                  $pur=0;
                                                                    
                                                       $open1 = $open->fetch_assoc();
                                                       //echo $open1['opening_balance'];
                                                       $exptot=$exptot+$open1['opening_balance'];
                                                             
                                                           
                                                            while($rows = $bils->fetch_assoc())
                                                   {
                                                    //echo $rows['billamnt'];
                                                    $pur=$pur+$rows['billamnt'];
                                                       //$debittot=$debittot+$rows['billamnt'];
                                                   }
                                                         
                                                       
                                                           if(mysqli_num_rows($bils1) > 0){
                                                            while($rows1 = $bils1->fetch_assoc())
                                                   {

                                                    //echo $rows1['amnt'];
                                                    $pur=$pur-$rows1['amnt'];
                                                    $exptot=$exptot+$pur;
                                                      // $debittot=$debittot+$rows1['amnt'];
                                                     // $debittot=$debittot+$rows1['amnt'];
                                                   }
                                                 }else{
                                                  //echo "0";
                                                   $pur=$pur-0;
                                                    $exptot=$exptot+$pur;
                                                 }
                                                          ?>
                                                      
                                            <?php
                             
                             if(mysqli_num_rows($dex)>0)
                                               {
                                                ?>
                                                
                                                <?php
                               while($rowdx = $dex->fetch_assoc())
                                                   {
// echo $rowdx['amnt']; 
                                    $exptot=$exptot+$rowdx['amnt']; 
                                   ?>
                            
                           <?php }
                       }
                           ?>
                      
                                                
                                                 

<!--  ----------------------GRID 1-2--------------------------------- -->

                             
                                                               <?php
                                                               $sale=0;
                                                               $intot=0;
                                                               
                                                               while($row5 = $bil5->fetch_assoc())
                                                   {
                                                    //echo $row5['billamnt'];
                                                    $sale=$sale+$row5['billamnt'];

                                                       //$debittot=$debittot+$row['billamnt'];
                                                   }

                                                              
                                                              
                                                               while($row2 = $bil2->fetch_assoc())
                                                   {
                                                    //echo $row2['amnt'];
                                                    $sale=$sale-$row2['amnt'];
                                                      // $debittot=$debittot+$row2['amnt'];
                                                   }

                                                          

                                                            $intot=$intot+$sale; ?>
                                                       

                                                                    <?php
                             
                             if(mysqli_num_rows($dex1)>0)
                                               {
                                                ?>
                                                 
                                                <?php
                               while($rowdx1 = $dex1->fetch_assoc())
                                                   {

                                //echo $rowdx1['amnt']; 
                                    $intot=$intot+$rowdx1['amnt']; 
                                   ?>
                           
                           <?php }
                       }
                          

                                                      $vmprd=$conn->query("SELECT * from us_products where pr_isactive='0' ");

                                                      $amountz=0;

                                                     while($rowprd = $vmprd->fetch_assoc())
                                                   {

                                                    $date= date('d-m-Y');
                                                    
                                                      $vmsr=$conn->query("SELECT * from us_stockreport where sr_itemid='".$rowprd['pr_productid']."' order by sr_date desc limit 1");
                                                        
                                                        if($rowsr = $vmsr->fetch_assoc())
                                                       {
                                                      $amountz = $amountz +  $rowsr['sr_amount'];
                                                        }
                                                        else{

                                                          $vmprd1=$conn->query("SELECT * from us_products where pr_productid='".$rowprd['pr_productid']."' ");

                                                          $rowsrprd = $vmprd1->fetch_assoc();

                                                         $amountz = $amountz + ($rowsrprd['pr_stock']*$rowsrprd['pr_purchaseprice']);

                                                        } }

                                                      $close=$amountz;
                                                      //echo $close;
                                                      $intot=$intot+$close;
                                                       ?>
                                                   
<!-- ---------------------------------GRID 2-1-------------------------------------- -->

                          

                                                              <?php
                                                               $exptot1=0;
                                                              if($intot>$exptot){
                                                                $dif=$intot-$exptot; 
                                                         //echo $dif;
                                                   $exptot1=$exptot+$dif;
                                                 }
                                          ?>
                                         
                                            <?php if($exptot1 > 0){
                                             //echo $exptot1; 
                                         }
                                            else{
                                              //echo $exptot;
                                            }

                                            ?>
                                        
<!-- ----------------------------------GRID 2-2------------------------------------ -->

                                                              <?php
                                                              $intot1=0;
                                                              if($exptot>$intot){
                                                                $dif1=$exptot-$intot; 
                                                              ?>
                                                                       <tr height="40px">
                                                  
                                               
                                                 <?php //echo $dif1;
                                                   $intot1=$intot+$dif1;
                                                   ?>
                                              
                                          <?php }else{
                                          ?>
                                           
                                          <?php }
                                          ?>
                                          
                                            <?php
                                            if($intot1>0){
                                            //echo $intot1;
                                          }
                                          else{
                                             //echo $intot;
                                          }
                                             ?>
                   




<!-- ----------------------------------GRID 3-1------------------------------------ -->

                                                               <?php
                                                              $expsum=0;
                                                              if($exptot>$intot){
                                                                $dif1=$exptot-$intot; 
                                                              ?>
                                                                       
                                                 <?php //echo $dif1;
                                                   $expsum=$expsum+$dif1;
                                                   ?>
                                             
                                          <?php }
                                  
                             if(mysqli_num_rows($inex)>0)
                                               {
                                                ?>
                                                 
                                                <?php
                               while($rowinx = $inex->fetch_assoc())
                                                   {

                               ?>
                               
                                   <?php 
                                   //echo $rowinx['amnt']; 

                                   $expsum=$expsum+$rowinx['amnt'];

                                   ?>
                               
                           <?php }
                       }
                           ?>
                      
<!-- ----------------------------------GRID 3-2------------------------------------ -->

                      
                                                               <?php
                                                               $incsum=0;
                                                              if($intot>$exptot){
                                                                $dif=$intot-$exptot; 
                                                              ?>
                                                         
                                                   <?php // $dif;
                                                   $incsum=$incsum+$dif;
                                                   ?>
                                            
                                          <?php }
                                          if(mysqli_num_rows($inex1)>0)
                                               {
                                                ?>
                                                
                                                <?php
                               while($rowinx1 = $inex1->fetch_assoc())
                                                   {

                               ?>
                               
                                   <?php //echo $rowinx1['amnt']; 

                                   $incsum=$incsum+$rowinx1['amnt'];

                                   ?>
                              
                           <?php 
                         }}
                           ?>    
           


<!-- ----------------------------------GRID 4-1------------------------------------ -->

               
                                                               <?php
                                                               $expsum1=0;
                                                              if($incsum>$expsum){
                                                                $diftot=$incsum-$expsum; 
                                                              ?>
                                                        
                                                   <?php //echo $diftot;
                                                   $expsum1=$expsum+$diftot;
                                                   ?>
                                              
                                          <?php }
                                          ?>
                                        
                                          
                                            <?php if($expsum1 > 0){ //echo $expsum1; 
                                            }
                                            else{
                                              //echo $expsum;
                                            }

                                            ?>
                                       

<!-- ----------------------------------GRID 4-2------------------------------------ -->

                        
                                                                    <?php
                                                              $incsum1=0;
                                                              if($expsum>$incsum){
                                                                $dif1tot=$expsum-$incsum; 
                                                              ?>
                                                         
                                                 <?php //echo $dif1tot;
                                                   $incsum1=$incsum+$dif1tot;
                                                   ?>
                                              
                                          <?php }else{
                                          ?>
                                           
                                          <?php }
                                          ?>
                                          
                                            <?php
                                            if($incsum1>0){
                                            //echo $incsum1;
                                          }
                                          else{
                                             //echo $incsum;
                                          }
                                             ?>
                                           


<!--  FOR REFERANCE -->
