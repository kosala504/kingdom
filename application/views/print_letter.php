<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kingdom of kandurata - Banking Letters</title>
    <link href="<?=base_url()?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>/assets/css/sb-admin-2.min.css" rel="stylesheet" media="screen,print">

    <input type="hidden"  id="base-url" value="<?=base_url()?>"/>
    <style type="text/css" media="screen,print">
      table, th, td {
        border: 1px solid black;
        margin-left: auto;
        margin-right: auto;
        border-collapse: collapse;
        margin-top:  23px;
        margin-bottom: 23px;
      } 
      .amount_right{
        text-align: right;
      }
      @media print {
        .noPrint{
          display:none;
        }
      }
      button{
          float: right;
      }
      .row{
        page-break-after: always;
      }
    </style>

</head>
<body>
<!-- Begin Page Content -->
<button onclick="window.print()" class="noPrint">
<i class="fas fa-print"></i>&nbsp;Print
</button>
                                  
   <div class="row">
    <?php
      $date=date_create($let_date);
      $let_month=date_create($let_month);
      foreach($detail  as $row): 
        $bank = $row->bank_name; 
        $branch = $row->bank_branch; 
      endforeach;

    ?>
    <p style="margin-left: 150px;"> Manager, <br>
    Kingdom Of Kandurata, <br>
    Bibilegama.<br>
    <?php echo date_format($date,"Y/m/d"); ?><br><br>
    Manager, <br>
    <?php echo $bank; ?>, <br>
    <?php echo $branch; ?>. <br><br>
    <b><u> Green Tea Suppliers Salary transfer letter for <?php echo date_format($date,"Y-F"); ?> </u></b><br>
     Dear sir/madam, <br>
    We <b>Kindom Of Kandurata</b> request to Kindly tranfer the amounts of the following suppliers into their respective bank accounts by debetting from our bearing a/c no.0000000 for the month <?php echo date_format($let_month,"F"); ?> <br></p>
    
     <div class="col-lg-12 col-lg-12 col-lg-12 pull-center">
           <table style="float: center;">
             <thead>
               <tr>
                 <td colspan="6"><center><b><?php echo $bank;?>-<?php echo $branch; ?>(<?php echo date_format($date,"F-Y"); ?>)</b></center></td>
               </tr>
               <tr>
                 <td colspan="6"><center><b>Green Leaf Suppier's Name & Amount</b></center></td>
               </tr>
             </thead>
             <tbody>
               <tr>
                 <td><b>No</b></td>
                 <td><b>Reg No</b></td>
                 <td><b>State</b></td>
                 <td><b>Full Name</b></td>
                 <td><b>Bank Number</b></td>
                 <td><b>Amount</b></td>
               </tr>
               <tr>

            <?php
               $bank_tot = 0; 
               $no = 0;
              foreach($detail as $row):
                $tot_tea = $row->tea; 
                $ad_tot = $row->ad_income; 
                $gross = $tot_tea+$ad_tot;

                $c_ad = $row->cash_adv; 
                $welfare = $row->welfare; 
                $trans = $row->transport;
                $mn_tot = $row->man_tot;
                $md = $row->made_tea;
                $kok = $row->kok_p;
                $othr = $row->other;
                $ded = $c_ad+$welfare+$trans+$mn_tot+$md+$kok+$othr;
                $net = $gross-$ded;
                $bank_tot = $bank_tot+$net;
                $no = $no+1;
            ?>
                 <td><?php echo $no; ?></td>
                 <td><?php echo $row->sup_id; ?></td>
                 <td><?php echo $row->state; ?></td>
                 <td><?php echo $row->acc_holder; ?></td>
                 <td><?php echo $row->acc_number; ?></td>
                 <td style="text-align: right;"><?php echo number_format((float)$net, 2, '.', ','); ?></td>
               </tr>
              <?php endforeach; ?>
               <tr>
                 <td colspan="5" style="text-align: center;">Total</td>
                 <td style="text-align: right;"><?php echo number_format((float)$bank_tot, 2, '.', ','); ?></td>
               </tr>
             </tbody>
           </table> 
            
      </div>
      <p style="margin-left: 150px;"><br><br>
        Thank you.<br><br><br>
        --------------------<br>
        H.M.Ghanawathi,<br>
        Manager,<br>
        Kingdom Of Kandurata.<br>
      </p> 
      <p></p>
      <p></p>
    </div><!-- End of Main Content -->
</body>


</html>
        
                    