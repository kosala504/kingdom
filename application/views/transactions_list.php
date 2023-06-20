<!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?=$title?></h1>
                <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong><?php echo $this->session->flashdata('success'); ?></strong>
                </div>
            <?php elseif($this->session->flashdata('error')):?>
                <div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong><?php echo $this->session->flashdata('error'); ?></strong>
                </div>
            <?php endif;?>    
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Transactions - KOK</h6>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addTransaction" style="float: right;"><i class=" fa fa-receipt"></i> Add Transaction</button>
                        <form method="post" id="import_csv" enctype="multipart/form-data" style="float: right;">
                            <input type="file" name="csv_file" id="csv_file" required accept=".csv" / style="width: 210px">
                            <button type="submit" name="import_csv" class="btn btn-primary btn-sm" id="import_csv_btn"><i class=" fa fa-download"></i> Import from app</button>&nbsp;&nbsp;
                        </form> 
                    </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Supplier ID</th>
                                            <th>Supplier Name</th>
                                            <th>Date</th>
                                            <th>Green tea supply(Kg)</th>
                                            <th>Amount(Rs.)</th>
                                            <th>Additional Income</th>
                                            <th>Gross pay</th>
                                            <th>Cash Advance</th>
                                            <th>Welfare</th>
                                            <th>Transport</th>
                                            <th>Manure</th>
                                            <th>Made tea</th>
                                            <th>KOK Product</th>
                                            <th>Other deductions</th>
                                            <th>Total deductions</th>
                                            <th>Net pay</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($transactions  as $row): 
                                        $ex = 0;   
                                        $net = 0;   
                                        $t_pr =  $row->tea_price;      
                                        $ad =  $row->ad_income;
                                        $gross = $t_pr+$ad; 

                                        $cash = $row->cash_adv;     
                                        $wel = $row->welfare;     
                                        $trans = $row->transport;     
                                        $man = $row->manure;     
                                        $md_t = $row->made_tea;  
                                        $kok = $row->kok_product;     
                                        $otr = $row->other_ded; 
                                        $ex = $cash+$wel+$trans+$man+$md_t+$kok+$otr;
                                        $net=$gross-$ex;    
                                        
                                        ?>    
                                        <tr>
                                            <td><?php echo $row->trans_id; ?></td> 
                                            <td><?php echo $row->sup_id; ?></td>
                                            <td><?php echo $row->sup_name; ?></td> 
                                            <td><?php echo $row->trans_date; ?></td> 
                                            <td><?php echo $row->tea_kg; ?></td> 
                                            <td><?php echo $row->tea_price; ?></td> 
                                            <td><?php echo $row->ad_income; ?></td> 
                                            <td><?php echo $gross; ?></td> 
                                            <td><?php echo $cash; ?></td> 
                                            <td><?php echo $row->welfare; ?></td> 
                                            <td><?php echo $row->transport; ?></td> 
                                            <td><?php echo $row->manure; ?></td> 
                                            <td><?php echo $row->made_tea; ?></td> 
                                            <td><?php echo $row->kok_product; ?></td> 
                                            <td><?php echo $row->other_ded; ?></td> 
                                            <td><?php echo $ex; ?></td> 
                                            <td><?php echo $net; ?></td> 
                                            
                                            <td>
                                                <a href="#" id="transaction-edit"  onclick="edit_transaction_popup('<?=$row->trans_id?>','<?=$row->sup_id?>','<?=$row->sup_name?>','<?=$row->trans_date?>','<?=$row->tea_kg?>','<?=$row->tea_price?>','<?=$row->ad_income?>','<?=$row->cash_adv?>','<?=$row->welfare?>','<?=$row->transport?>','<?=$row->manure_kg?>','<?=$row->manure?>','<?=$row->made_kg?>','<?=$row->made_tea?>','<?=$row->kok_product?>','<?=$row->other_ded?>','<?=$ex?>','<?=$net?>');" data-toggle="modal" data-target="#editTransaction"><i class="fa fa-pen"></i></a>
                                                <a href="#" id="supplier-delete" onclick="deactivate_confirmation('<?=$row->trans_id?>');" data-toggle="modal" data-target="#deactivateConfirm"><i class="fa fa-trash"style="color: red"></i> </a>
                                                
                                            </td>

                                        </tr>
                                        <?php endforeach; ?>
                                        
                                    </tbody>
                                </table>
                                
                      </div>
                    </div>
                  </div>
                    
                <!-- /.col-lg-12 -->
            

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <?php foreach($tea_price  as $row):
              $tp = $row->amount; 
            endforeach; 

            foreach($transport  as $row):
              $trn = $row->amount; 
            endforeach;
            ?>  

        <!-- Modal -->
        <div class="modal fade" id="deactivateConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-red">
                        <h5 class="modal-title" id="exampleModalLabel">DELETE CONFIRMATION </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>Are you going to delete transaction #<label id="trans_id" style="color:blue;"></label>?</label><br/>
                        <label>Click <b>Yes</b> to continue.</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <a id="deactivateYesButton" class="btn btn-danger" >Yes</a>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

<!-- Modal: modalCart -->
<div class="modal fade" id="addTransaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Add transaction</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Supplier:</label>&nbsp;&nbsp;
                    <label class="error" id="error_id"> Please select supplier.</label>
                    <br>
                    <select name="state" class="form-control-lg-6" id="js-example-basic-single" style="width: 75%">
                        <option value="0" selected="selected">--SELECT SUPPLIER--</option>
                        <?php foreach($suppliers as $row): ?>
                          <option value="<?php echo $row->sup_id; ?>"><?php echo $row->sup_id."-".$row->l_name ?></option>
                        <?php endforeach; ?> 
                    </select> 
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Date:</label>&nbsp;&nbsp;
                    <label class="error" id="error_date"> Please select date.</label>
                    <input type="date" class="form-control" id="transfer_date" name="transfer_date">
                      <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
      </div>

        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Earnings</th>
              <th>Quantity</th>
              <th>Unit Price(Rs)</th>
              <th>Amount(Rs)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Green tea supply</td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="g_qty" name="g_qty" type="text" ng-model="g_qty" autofocus onblur="getAmount()">
                </div>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="grn_tea" name="grn" type="text" ng-model="grn_tea" onblur="getAmount()" disabled="disabled" value="<?=$tp ?>">
              </td>
              <td>
                  <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="grn_tot" name="gadi" type="text" disabled="disabled">
              </td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Additional Earnings</td>
              <td></td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="ad_in" name="ad_in" type="text" autofocus onblur="getAmount()" value="0">
                </div>
              </td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="ad_tot" name="adi" type="text" disabled="disabled">
              </td>
            </tr>
            <tr>
              <th></th>
              <td></td>
              <td></td>
              <td><b>Gross Pay</b></td>
              <td><b>
                  <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="gross_tot" name="gross_pay" type="text" disabled="disabled">
              </b></td>
            </tr>
        </tbody>
            <thead>
            <tr>
              <th>#</th>
              <th>Deductions</th>
              <th>Quantity</th>
              <th>Unit Price(Rs)</th>
              <th>Amount(Rs)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Cash advance</td>
              <td></td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="cs_ad" name="cs_ad" type="text" autofocus onblur="getAmount()" value="0">
                </div>
              </td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="cs_tot" name="cs_tot" type="text" disabled="disabled">
              </td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Kok Welfare</td>
              <td></td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="welfare" name="welfare" type="text" autofocus onblur="getAmount()" value="0">
                </div>
              </td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="wel_tot" name="wel_tot" type="text" disabled="disabled">
              </td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Transport</td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="trans_qty" name="trans_qty" type="text" disabled="disabled">
                </div>
              </td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="trans" name="trans" type="text" disabled="disabled" value="<?=$trn ?>">
              </td>
                </div>
              </td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="trans_tot" name="trans_tot" type="text" disabled="disabled">
              </td>
            </tr>
            <tr>
              <th scope="row">4</th>
              <td>Manure</td>
              <td>
                  <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="man_qty" name="man_qty" type="text" autofocus onblur="getAmount()" value="0">
                </div>
              </td>
              <td>
                  <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="manure" name="manure" type="text" autofocus onblur="getAmount()" value="0">
                </div>
              </td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="man_tot" name="man_tot" type="text" disabled="disabled">
              </td>
            </tr>
            <tr>
              <th scope="row">5</th>
              <td>Made tea</td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="mt_qty" name="mt_qty" type="text" autofocus onblur="getAmount()" value="0">
                </div>
              </td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="mt" name="mt" type="text" autofocus onblur="getAmount()" value="0">
                </div>
              </td>
              <td>
                  <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="mt_tot" name="mt_tot" type="text" disabled="disabled">
              </td>
            </tr>
            <tr>
              <th scope="row">6</th>
              <td>KOK Product</td>
              <td>
                  
              </td>
              <td>
                  <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="kok" name="kok" type="text" autofocus onblur="getAmount()" value="0">
                </div>
              </td>
              <td>
                  <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="kok_tot" name="kok_tot" type="text" disabled="disabled">
              </td>
            </tr>
            <tr>
              <th scope="row">7</th>
              <td>Other Deductions</td>
              <td>
                
              </td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="othr" name="othr" type="text" autofocus onblur="getAmount()" value="0">
                </div>
              </td>
              <td>
                  <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="othr_tot" name="othr_tot" type="text" disabled="disabled">
              </td>
            </tr>
            <tr>
              <th></th>
              <td></td>
              <td></td>
              <td>Total Deductions</td>
              <td>
                  <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="did_tot" name="did_tot" type="text" disabled="disabled">
              </td>
            </tr>
            <tr>
              <th></th>
              <td></td>
              <td></td>
              <td><b>Net Pay</b><br>
                  <label class="error" id="error_no_data"> All fields are empty!</label>
              </td>
              <td>
                  <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="net_pay" name="net_pay" type="text" disabled="disabled" value="0">
              </td>
            </tr>
          </tbody>
        </table>

      </div>
      <!--Footer-->
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" id="newTransactionSubmit">Checkout</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal: modalCart -->
            <!-- /.modal-dialog -->
    
        <!-- /.modal -->    

<div class="modal fade" id="editTransaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Edit transaction</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Supplier:</label>&nbsp;&nbsp;
                    <label class="error" id="edit-error_id"> Please select supplier.</label>
                    <br>
                    <select name="edit-sup" class="form-control-lg-6" id="edit-sup" style="width: 75%">
                        <option value="0" selected="selected">--SELECT SUPPLIER--</option>
                        <?php foreach($suppliers as $row): ?>
                          <option value="<?php echo $row->sup_id; ?>"><?php echo $row->sup_id."-".$row->l_name ?></option>
                        <?php endforeach; ?> 
                    </select> 
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Date:</label>&nbsp;&nbsp;
                    <label class="error" id="edit-error_date"> Please select date.</label>
                    <input type="date" class="form-control" id="edit-transfer_date" name="transfer_date">
                      <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
      </div>

        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Earnings</th>
              <th>Quantity</th>
              <th>Unit Price(Rs)</th>
              <th>Amount(Rs)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Green tea supply</td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-g_qty" name="g_qty" type="text" ng-model="g_qty" autofocus onblur="getAmountEdit()">
                </div>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-grn_tea" name="grn" type="text" ng-model="grn_tea" onblur="getAmountEdit()" disabled="disabled" value="<?=$tp ?>">
              </td>
              <td>
                  <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-grn_tot" name="gadi" type="text" disabled="disabled">
              </td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Additional Earnings</td>
              <td></td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-ad_in" name="ad_in" type="text" autofocus onblur="getAmountEdit()" value="0">
                </div>
              </td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-ad_tot" name="adi" type="text" disabled="disabled">
              </td>
            </tr>
            <tr>
              <th></th>
              <td></td>
              <td></td>
              <td><b>Gross Pay</b></td>
              <td><b>
                  <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-gross_tot" name="gross_pay" type="text" disabled="disabled">
              </b></td>
            </tr>
        </tbody>
            <thead>
            <tr>
              <th>#</th>
              <th>Deductions</th>
              <th>Quantity</th>
              <th>Unit Price(Rs)</th>
              <th>Amount(Rs)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Cash advance</td>
              <td></td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-cs_ad" name="cs_ad" type="text" autofocus onblur="getAmountEdit()" value="0">
                </div>
              </td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-cs_tot" name="cs_tot" type="text" disabled="disabled">
              </td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Kok Welfare</td>
              <td></td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-welfare" name="edit-welfare" type="text" autofocus onblur="getAmountEdit()" value="0">
                </div>
              </td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-wel_tot" name="edit-wel_tot" type="text" disabled="disabled">
              </td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Transport</td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-trans_qty" name="edit-trans_qty" type="text" disabled="disabled">
                </div>
              </td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-trans" name="edit-trans" type="text" disabled="disabled" value="<?=$trn ?>">
              </td>
                </div>
              </td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-trans_tot" name="edit-trans_tot" type="text" disabled="disabled">
              </td>
            </tr>
            <tr>
              <th scope="row">4</th>
              <td>Manure</td>
              <td>
                  <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-man_qty" name="man_qty" type="text" autofocus onblur="getAmountEdit()">
                </div>
              </td>
              <td>
                  <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-manure" name="manure" type="text" autofocus onblur="getAmountEdit()">
                </div>
              </td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-man_tot" name="man_tot" type="text" disabled="disabled">
              </td>
            </tr>
            <tr>
              <th scope="row">5</th>
              <td>Made tea</td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-mt_qty" name="mt_qty" type="text" autofocus onblur="getAmountEdit()">
                </div>
              </td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-mt" name="mt" type="text" autofocus onblur="getAmountEdit()">
                </div>
              </td>
              <td>
                  <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-mt_tot" name="mt_tot" type="text" disabled="disabled">
              </td>
            </tr>
            <tr>
              <th scope="row">6</th>
              <td>KOK Product</td>
              <td>
              </td>
              <td>
                  <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-kok" name="kok" type="text" autofocus onblur="getAmountEdit()">
                </div>
              </td>
              <td>
                  <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-kok_tot" name="kok_tot" type="text" disabled="disabled">
              </td>
            </tr>
            <tr>
              <th scope="row">7</th>
              <td>Other Deductions</td>
              <td>
              </td>
              <td>
                <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-othr" name="othr" type="text" autofocus onblur="getAmountEdit()">
                </div>
              </td>
              <td>
                  <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-othr_tot" name="othr_tot" type="text" disabled="disabled">
              </td>
            </tr>
            <tr>
              <th></th>
              <td></td>
              <td></td>
              <td>Total Deductions</td>
              <td>
                  <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-did_tot" name="did_tot" type="text" disabled="disabled">
              </td>
            </tr>
            <tr>
              <th></th>
              <td></td>
              <td></td>
              <td><b>Net Pay</b><br>
                  <label class="error" id="edit-error_no_data"> All fields are empty!</label>
              </td>
              <td>
                  <div class="d-none d-sm-block col-8">
                <input class="form-control form-control-sm ng-pristine ng-valid ng-not-empty ng-touched" id="edit-net_pay" name="net_pay" type="text" disabled="disabled" value="0">
              </td>
            </tr>
          </tbody>
        </table>

      </div>
      <!--Footer-->
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" id="editTransactionSubmit">Update</button>
      </div>
    </div>
  </div>
</div>


        <?php $this->load->view('frame/footer_view')?>
        <script src="<?=base_url()?>assets/js/view/transaction_list.js"></script>
        <script type="text/javascript">

          $(document).ready(function() {
            $('#dataTable2').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ],
                "order": [ 0, 'desc' ]
            } );
          } );
        </script>