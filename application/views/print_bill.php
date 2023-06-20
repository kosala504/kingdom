<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kingdom of kandurata</title>
    <link href="<?=base_url()?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>/assets/css/sb-admin-2.min.css" rel="stylesheet" media="screen,print">

    <input type="hidden"  id="base-url" value="<?=base_url()?>"/>
    <style type="text/css" media="screen,print">
      table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
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
    </style>

</head>
<body>
<!-- Begin Page Content -->
<button onclick="window.print()" class="noPrint">
<i class="fas fa-print"></i>&nbsp;Print
</button>
<?php
      $date=date_create($bill_date);
      $a = 0;
      foreach($tea_price  as $row): 
        $a = $row->amount;
      endforeach;

?>
<div class="prpage">   
   
                                        
   <div class="row" id="examples">
    <?php
       foreach($detail  as $row): 
    ?>
    <div class="col-xs-4 col-md-4 col-lg-4 pull-left">
            <?php 
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
            ?>
            <table>
              <tbody>
                <tr>
                  <td colspan="3"><center><b>Kingdom Of Kandurata Group</b></center>
                </tr>
                <tr>
                  <td colspan="2"><center><b>Raw Green Tea Leaf Collector</b></center></td>
                  <td><center><b><?php echo $row->sup_id; ?></b></center></td>
                </tr>
                <tr>
                    <td><center><b>Reg No-2924</b></center></td>
                    <td><center><b>TP - 0552287091</b></center></td>
                    <td><center><b><?php echo date_format($date,"M-Y"); ?></b></center></td>
                </tr>
                <tr>
                  <td colspan="3">Suplier Name :-<?php echo $row->f_name; ?><?php echo $row->l_name; ?></td>
                </tr>
                <tr>
                  <td>G/Leaf(kg)</td>
                  <td>Rate per kg</td>
                  <td>Amount</td>
                </tr>
                <tr>
                  <td class="amount_right"><?php echo $row->tea_kg; ?>kg</td>
                  <td class="amount_right">Rs.<?php echo number_format((float)$a, 2, '.', ','); ?></td>
                  <td class="tot amount_right"><?php echo number_format((float)$row->tea, 2, '.', ','); ?></td>
                </tr>
                <tr>
                  <td colspan="2">Additional Income</td>
                  <td class="amount_right"><?php echo number_format((float)$row->ad_income, 2, '.', ','); ?></td>
                </tr>
                <tr>
                  <td colspan="2"><b>Gross Pay</b></td>
                  <td class="tot amount_right"><b><?php echo number_format((float)$gross, 2, '.', ','); ?></b></td>
                </tr>
                <tr>
                  <td colspan="3"><b>Deductions</b></td>
                </tr>
                <tr>
                  <td>Advance</td>
                  <td class="tot amount_right"><?php echo number_format((float)$row->cash_adv, 2, '.', ','); ?></td>
                  <td></td>
                </tr>
                <tr>
                  <td>KOK Welfare</td>
                  <td class="tot amount_right"><?php echo number_format((float)$row->welfare, 2, '.', ','); ?></td>
                  <td></td>
                </tr>
                <tr>
                  <td>Transport</td>
                  <td class="tot amount_right"><?php echo number_format((float)$row->transport, 2, '.', ','); ?></td>
                  <td></td>
                </tr>
                <tr>
                  <td>Manure</td>
                  <td class="tot amount_right"><?php echo number_format((float)$row->man_tot, 2, '.', ','); ?></td>
                  <td></td>
                </tr>
                <tr>
                  <td>Made Tea</td>
                  <td class="tot amount_right"><?php echo number_format((float)$row->made_tea, 2, '.', ','); ?></td>
                  <td><center></td>
                </tr>
                <tr>
                  <td>KOK Product</td>
                  <td class="tot amount_right"><?php echo number_format((float)$row->kok_p, 2, '.', ','); ?></td>
                  <td></td>
                </tr>
                <tr>
                  <td>Others</td>
                  <td class="tot amount_right"><?php echo number_format((float)$row->other, 2, '.', ','); ?></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="2"><b>Total Deductions</b></td>
                  <td class="tot amount_right"><b><?php echo number_format((float)$ded, 2, '.', ','); ?></b></td>
                </tr>
                <tr>
                  <td colspan="2"><b>Balance Amount</b></td>
                  <td class="tot amount_right"><b><?php echo number_format((float)$net, 2, '.', ','); ?></b></td>
                </tr>
              </tbody>
            </table>  
          </div>
          <?php 
          endforeach;
          ?> 
      </div>                  <!-- End of Main Content --> 


<script type="text/javascript">
  function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>
</body>

</html>
        
                    