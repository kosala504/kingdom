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
                        <h6 class="m-0 font-weight-bold text-primary">Daily Tea Supply Compaison</h6>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addTransaction" style="float: right;"><i class=" fa fa-plus"></i> Add Factory Total</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Actual Kg(from suppliers)</th>
                                            <th>Delivered to the factory</th>
                                            <th>Difference</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 0;
                                        $grd = 0;
                                        $fac_tot = 0;
                                        $act_tot = 0;
                                        foreach($daily_kg as $row):
                                            $no++;
                                            $actual  = $row->tea_kg;
                                            $factory = $row->no_of_kilo;
                                            $diff = $factory - $actual;
                                            $flag = "";
                                            if($diff < 0){
                                                $flag = "🔻";
                                            }
                                            elseif ($diff > 0) {
                                                $flag = "🔼";
                                            }
                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>   
                                            <?php $date=date_create($row->trans_date);?>
                                            <td><?php echo date_format($date,"F-d"); ?></td> 
                                            <td><?php echo $actual; ?></td>
                                            <td><a href="#" id="transaction-edit"  onclick="edit_amount_popup('<?=$row->id?>','<?=$row->date?>','<?=$row->no_of_kilo?>');" data-toggle="modal" data-target="#editAmount"><?php echo $factory; ?></a></td>
                                            <td><?php echo $diff.''.$flag; ?></td>
                                            <?php 
                                                $grd = $grd+$diff;
                                                $act_tot = $act_tot+$actual;
                                                $fac_tot = $fac_tot+$factory;

                                            ?>
                                        </tr>
                                        <?php endforeach; 
                                            $flag1 = "";
                                            if($grd < 0){
                                                $flag1 = "🔻";
                                            }
                                            elseif ($grd > 0) {
                                                $flag1 = "🔼";
                                            }
                                        ?>
                                        <tr>
                                            <td><?php echo $no+1; ?></td>
                                            <td><b>Totals</b></td>
                                            <td><b><?php echo $act_tot; ?></b></td>
                                            <td><b><?php echo $fac_tot; ?></b></td>
                                            <td><b><?php echo $grd.''.$flag1; ?></b></td>
                                        </tr>
                                        
                                    </tbody>

                                </table>
                                
                            </div>
            
                        </div>
                        <!-- /.container-fluid -->
                    </div>

                </div>

            </div>
            <!-- End of Main Content -->

        <div class="modal fade" id="addTransaction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-blue">
                        <h5 class="modal-title" id="exampleModalLabel">Daily Factory Total</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date:</label>&nbsp;&nbsp;
                                    <label class="error" id="error_date"> Please select date.</label>
                                    <input type="date" class="form-control" id="transfer_date" name="transfer_date">
                                      <span class="glyphicon glyphicon-calendar"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Amount</label>&nbsp;&nbsp;
                                    <label class="error" id="error_amount"> Field is required.</label>
                                    <label class="error" id="error_amount2"> Please enter only numbers.</label>
                                    <input class="form-control" id="amount" placeholder="Enter Amount" name="amount" type="text" autofocus>
                                </div>

                            </div>
                      </div>
                        
                    </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                        <button id="addTeaSubmit" type="button" class="btn btn-primary">ADD</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="editAmount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-blue">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Daily Factory Total</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </div>
                    <div class="modal-body">
                        <input type="hidden"  id="edit-amount_id" value=""/>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date:</label>&nbsp;&nbsp;
                                    <label class="error" id="edit-error_date"> Please select date.</label>
                                    <input type="date" class="form-control" id="edit-transfer_date" name="edit-transfer_date">
                                      <span class="glyphicon glyphicon-calendar"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Amount</label>&nbsp;&nbsp;
                                    <label class="error" id="edit-error_amount"> Field is required.</label>
                                    <label class="error" id="edit-error_amount2"> Please enter only numbers.</label>
                                    <input class="form-control" id="edit-amount" placeholder="Enter Amount" name="edit-amount" type="text" autofocus>
                                </div>

                            </div>
                      </div>
                        
                    </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                        <button id="editAmountSubmit" type="button" class="btn btn-primary">Edit</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <?php $this->load->view('frame/footer_view')?>
        <script src="<?=base_url()?>assets/js/view/daily_tea_list.js"></script>
                    