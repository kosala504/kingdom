<!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Genarate Letters for Banks</h1>   
                <div class="col-xl-12 col-md-12 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                      <form method='post' action="<?= base_url('Print_letter'); ?>">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Year</div>
                                    <div>
                                      <?php echo '<select name="year" class="form-control"><option value="0">-Select Year-</option>' . PHP_EOL;
                                      for($i = date("Y"); $i >=date("Y")-2; $i--){
                                          echo '<option value="' . $i . '">' . $i . '</option>' . PHP_EOL;
                                      }
                                      echo '</select>';?>
                                  </div>
                                </div>
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Select Month</div>
                                    <div>
                                    <select name="month" class="form-control">
                                      <option value="0">-Select month-</option>
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
                                  </div>
                                </div>
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Select Bank</div>
                                    <div>
                                    <select name="bank" class="form-control">
                                      <option value="0">-Select Bank-</option>
                                      <?php foreach($banks as $row): ?>
                                        <option value="<?php echo $row->bank_name; ?>"><?php echo $row->bank_name; ?></option>
                                  <?php endforeach; ?> 
                                    </select>
                                  </div>
                                </div>
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                      Date in letter</div>
                                    <div>
                                    <input type="date" class="form-control" id="billing_date" name="billing_date">
                                     <span class="glyphicon glyphicon-calendar"></span>
                                  </div>
                                </div>
                                <div class="col-auto">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        .</div>
                                    <div>
                                    <input class="btn btn-primary" type='submit' name='submit' value="View">
                                </div>
                            </div>
                            </form>
                          </div>
                        </div>
                    </div>

                </div>
                <!-- /.col-lg-12 -->
            

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content --> 

            <?php $this->load->view('frame/footer_view')?>

        
        
                    