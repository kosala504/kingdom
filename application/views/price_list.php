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
                        <h6 class="m-0 font-weight-bold text-primary">Rates - KOK</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Price Type</th>
                                            <th>Amount</th>
                                            <th>Date Fixed</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($prices  as $row):
                                        ?>
                                        <tr>
                                            <td><?php echo $row->price_id; ?></td> 
                                            <td><?php echo $row->price_type; ?></td>
                                            <td><?php echo $row->amount; ?></td> 
                                            <td><?php echo $row->date_fixed; ?></td>
                                            <td>
                                                <a href="#" class="btn btn-primary" id="price-edit"  onclick="edit_price_popup('<?=$row->price_id?>','<?=$row->amount?>','<?=$row->price_type?>'); " data-toggle="modal" data-target="#editPrice"><i class="fas fa-sliders-h"></i>&nbsp;ADJUST</a>
                                                
                                            </td>

                                        </tr>
                                        <?php endforeach; ?>
                                        
                                    </tbody>

                                </table>
                                
                    </div>
            
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        <div class="modal fade" id="editPrice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-blue">
                        <h5 class="modal-title" id="exampleModalLabel">ADJUST <label id="p_type" style="text-transform: uppercase;"></label>&nbsp;RATE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </div>
                    <div class="modal-body">
                        <input type="hidden"  id="edit-price-id" value=""/>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Amount</label>&nbsp;&nbsp;
                                    <label class="error" id="edit-error_price2"> Please enter only numbers.</label>
                                    <input class="form-control" id="edit-price" placeholder="Enter Amount" name="edit-price" type="text" autofocus>
                                    <label class="error" id="edit-error_price"> Field is required.</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Effective Year</label>&nbsp;&nbsp;
                                    <?php echo '<select name="year" id="year" class="form-control"><option value="0">-Year-</option>' . PHP_EOL;
                                      for($i = date("Y"); $i >=date("Y")-2; $i--){
                                          echo '<option value="' . $i . '">' . $i . '</option>' . PHP_EOL;
                                      }
                                      echo '</select>';?>
                                    <label class="error" id="error_year"> Field is required.</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Effective Month</label>&nbsp;&nbsp;
                                    <select name="month" id="month" class="form-control">
                                      <option value="0">-Month-</option>
                                      <option value="January">January</option>
                                      <option value="February">February</option>
                                      <option value="March">March</option>
                                      <option value="April">April</option>
                                      <option value="May">May</option>
                                      <option value="June">June</option>
                                      <option value="July">July</option>
                                      <option value="August">August</option>
                                      <option value="September">September</option>
                                      <option value="October">October</option>
                                      <option value="November">November</option>
                                      <option value="December">December</option>
                                      </select>
                                    <label class="error" id="error_month"> Field is required.</label>
                                </div>
                            </div>
                      </div>
                        
                    </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                        <button id="editPriceSubmit" type="button" class="btn btn-primary">UPDATE</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <?php $this->load->view('frame/footer_view')?>
        <script src="<?=base_url()?>assets/js/view/price_list.js"></script>
                    