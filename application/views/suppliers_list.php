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
                        <h6 class="m-0 font-weight-bold text-primary">Suppliers - KOK</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sup ID</th>
                                            <th>State</th>
                                            <th>Initials</th>
                                            <th>Last Name</th>
                                            <th>NIC</th>
                                            <th>Address</th>
                                            <th>Tel</th>
                                            <th>Email</th>
                                            <th>Bank</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($suppliers  as $row): ?>
                                        <tr>
                                            <td><?php echo $row->sup_id; ?></td> 
                                            <td><?php echo $row->state; ?></td>
                                            <td><?php echo $row->f_name; ?></td> 
                                            <td><?php echo $row->l_name; ?></td> 
                                            <td><?php echo $row->nic; ?></td> 
                                            <td><?php echo $row->address; ?></td> 
                                            <td><?php echo $row->tel; ?></td> 
                                            <td><?php echo $row->email; ?></td> 
                                            <td><?php echo $row->bank_name; ?></td> 
                                            
                                            <td>
                                                <a href="#" id="supplier-edit"  onclick="edit_supplier_popup('<?=$row->sup_id?>','<?=$row->state?>','<?=$row->f_name?>','<?=$row->l_name?>','<?=$row->nic?>','<?=$row->address?>','<?=$row->tel?>','<?=$row->email?>','<?=$row->bank_name?>','<?=$row->bank_branch?>','<?=$row->acc_holder?>','<?=$row->acc_number?>');" data-toggle="modal" data-target="#editSupplier"> <i class="fas fa-user-edit"></i> </a>
                                                <a href="#" id="supplier-delete" onclick="deactivate_confirmation('<?=$row->l_name?>','<?=$row->sup_id?>');" data-toggle="modal" data-target="#deactivateConfirm"> <i class="fas fa-user-times" style="color: red"></i> </a>
                                                
                                            </td>

                                        </tr>
                                        <?php endforeach; ?>
                                        
                                    </tbody>

                                </table>
                                
                    </div>
                    <div class="col-lg-12" style="position:fixed;bottom: 5%;left: 88%; width: 150px;text-align: center;border-radius: 100%;">
                        <img class="add_user" src="<?=base_url()?>assets/img/add.png" data-toggle="modal" data-target="#addSupplier" />
                            </div>
                        </div>
                    </div>
                    
                <!-- /.col-lg-12 -->
            

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

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
                        <label>Are you going to delete supplier <label id="sup_name" style="color:blue;"></label>?</label><br/>
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

        <div class="modal fade bd-example-modal-lg" id="addSupplier" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"> 
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-blue">
                        <h5 class="modal-title" id="exampleModalLabel">CREATE NEW SUPPLIER</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Supplier ID</label> &nbsp;&nbsp;
                                    <label class="error" id="error_id"> field is required.</label>
                                    <label class="error" id="error_id2"> name must be numeric.</label>
                                    <label class="error" id="error_id3"> Supplier id already used.</label>
                                    <input class="form-control" id="sup_id" placeholder="Supplier ID" name="sup_id" type="text" autofocus>
                                </div> 
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>State</label>&nbsp;&nbsp;
                                    <label class="error" id="error_state"> field is required.</label>
                                    <select name="state" id="state" class="form-control" >
                                        <option value="0" selected="selected">-- SELECT STATE --</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Ms">Ms</option>
                                        <option value="Miss">Miss</option>
                                    </select> 
                                </div>
                            </div>
                      </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Initials</label> &nbsp;&nbsp;
                                    <label class="error" id="error_name"> field is required.</label>
                                    <label class="error" id="error_name2"> name must be alphanumeric.</label>
                                    <input class="form-control" id="f_name" placeholder="Initials" name="f_name" type="text" autofocus>
                                </div> 
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Last Name</label> &nbsp;&nbsp;
                                    <label class="error" id="error_last_name"> field is required.</label>
                                    <label class="error" id="error_last_name2"> name must be alphanumeric.</label>
                                    <input class="form-control" id="l_name" placeholder="Last Name" name="l_name" type="text" autofocus>
                                </div> 
                            </div>
                      </div>
                      <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>NIC</label> &nbsp;&nbsp;
                                    <label class="error" id="error_nic"> field is required.</label>
                                    <label class="error" id="error_nic2"> name must be alphanumeric.</label>
                                    <label class="error" id="error_nic3">NIC already exist.</label>
                                    <input class="form-control" id="nic" placeholder="NIC" name="nic" type="text" autofocus>
                                </div> 
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Telephone</label> &nbsp;&nbsp;
                                    <label class="error" id="error_tel"> field is required.</label>
                                    <label class="error" id="error_tel2">Invalid telephone number</label>
                                    <input class="form-control" id="tel" placeholder="Telephone" name="tel" type="text" autofocus>
                                </div> 
                            </div>
                      </div>
                      <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Email</label> &nbsp;&nbsp;
                                    <label class="error" id="error_email"> field is required.</label>
                                    <label class="error" id="error_email2"> email has already exist.</label>
                                    <label class="error" id="error_email3"> invalid email adress.</label>
                                    <input class="form-control" id="email" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                            </div>
                      </div>
                      <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Adddress</label>&nbsp;&nbsp;
                                    <label class="error" id="error_address"> field is required.</label>
                                    <textarea class="form-control" id="address" placeholder="Address" name="address" type="text" autofocus rows="4"></textarea> 
                                </div>
                            </div>
                      </div>
                      <fieldset class="border p-2">
                         <legend class="w-auto">Bank Details</legend>
                      <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Bank Name</label> &nbsp;&nbsp;
                                    <input class="form-control" id="bank" placeholder="Bank Name" name="bank" type="text" autofocus>
                                </div> 
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Branch</label> &nbsp;&nbsp;
                                    <input class="form-control" id="branch" placeholder="Branch" name="branch" type="text" autofocus>
                                </div> 
                            </div>  
                      </div>
                      <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Account Holder</label>&nbsp;&nbsp;
                                    <input class="form-control" id="holder" placeholder="Account Holder Name" name="holder" type="text" autofocus>
                                </div>
                            </div>
                      </div>
                      <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Account number</label>&nbsp;&nbsp;
                                    <label class="error" id="error_acc_no"> Please enter valid account number.</label>
                                    <input class="form-control" id="acc_no" placeholder="Account number" name="acc_no" type="text" autofocus>
                                </div>
                            </div>
                      </div>
                  </fieldset>
                        
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                        <button id="newSupplierSubmit" type="button" class="btn btn-primary">CREATE</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->    

        <div class="modal fade bd-example-modal-lg" id="editSupplier" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-blue">
                        <h5 class="modal-title" id="exampleModalLabel">UPDATE SUPPLIER DETAILS</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Supplier ID</label> &nbsp;&nbsp;
                                    <input class="form-control" id="edit-sup_id" name="edit-sup_id" type="text" disabled="disabled">
                                </div> 
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>State</label>&nbsp;&nbsp;
                                    <label class="error" id="edit-error_state"> field is required.</label>
                                    <select name="edit-state" id="edit-state" class="form-control" >
                                        <option value="0" selected="selected">-- SELECT STATE --</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Ms">Ms</option>
                                        <option value="Miss">Miss</option>
                                    </select> 
                                </div>
                            </div>
                      </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Initials</label> &nbsp;&nbsp;
                                    <label class="error" id="edit-error_name"> field is required.</label>
                                    <label class="error" id="edit-error_name2"> name must be alphanumeric.</label>
                                    <input class="form-control" id="edit-f_name" placeholder="Initials" name="edit-f_name" type="text" autofocus>
                                </div> 
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Last Name</label> &nbsp;&nbsp;
                                    <label class="error" id="edit-error_last_name"> field is required.</label>
                                    <label class="error" id="edit-error_last_name2"> name must be alphanumeric.</label>
                                    <input class="form-control" id="edit-l_name" placeholder="Last Name" name="edit-l_name" type="text" autofocus>
                                </div> 
                            </div>
                      </div>
                      <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>NIC</label> &nbsp;&nbsp;
                                    <label class="error" id="edit-error_nic"> field is required.</label>
                                    <label class="error" id="edit-error_nic2"> nic must be alphanumeric.</label>
                                    <label class="error" id="edit-error_nic3"> NIC has already exist.</label>
                                    <input class="form-control" id="edit-nic" placeholder="NIC" name="edit-nic" type="text" autofocus>
                                </div> 
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Telephone</label> &nbsp;&nbsp;
                                    <label class="error" id="edit-error_tel"> field is required.</label>
                                    <label class="error" id="edit-error_tel2">Invalid telephone number</label>
                                    <input class="form-control" id="edit-tel" placeholder="Telephone" name="edit-tel" type="text" autofocus>
                                </div> 
                            </div>
                      </div>
                      <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Email</label> &nbsp;&nbsp;
                                    <label class="error" id="edit-error_email"> field is required.</label>
                                    <label class="error" id="edit-error_email2"> email has already exist.</label>
                                    <label class="error" id="edit-error_email3"> invalid email adress.</label>
                                    <input class="form-control" id="edit-email" placeholder="E-mail" name="edit-email" type="email" autofocus>
                                </div>
                            </div>
                      </div>
                      <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Adddress</label>&nbsp;&nbsp;
                                    <label class="error" id="edit-error_address"> field is required.</label>
                                    <textarea class="form-control" id="edit-address" placeholder="Address" name="edit-address" type="text" autofocus rows="4"></textarea> 
                                </div>
                            </div>
                      </div>
                      <fieldset class="border p-2">
                         <legend class="w-auto">Bank Details</legend>
                      <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Bank Name</label> &nbsp;&nbsp;
                                    <input class="form-control" id="edit-bank" placeholder="Bank Name" name="edit-bank" type="text" autofocus>
                                </div> 
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Branch</label> &nbsp;&nbsp;
                                    <input class="form-control" id="edit-branch" placeholder="Branch" name="edit-branch" type="text" autofocus>
                                </div> 
                            </div>  
                      </div>
                      <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Account Holder</label>&nbsp;&nbsp;
                                    <input class="form-control" id="edit-holder" placeholder="Account Holder Name" name="edit-holder" type="text" autofocus>
                                </div>
                            </div>
                      </div>
                      <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Account number</label>&nbsp;&nbsp;
                                    <input class="form-control" id="edit-acc_no" placeholder="Account number" name="edit-acc_no" type="text" autofocus>
                                </div>
                            </div>
                      </div>
                  </fieldset>
                        
                    </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                        <button id="editSupplierSubmit" type="button" class="btn btn-primary">UPDATE</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <?php $this->load->view('frame/footer_view')?>
        <script src="<?=base_url()?>assets/js/view/suppliers_list.js"></script>
                    