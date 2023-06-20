<!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy;<a href="https://www.linkedin.com/in/kosala-hasantha-19a84214b/" target="_blank"> Kosala Hasantha</a> <?php echo date('Y'); ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?=base_url();?>authentication/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
      <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
      
    <script src="<?=base_url()?>assets/js/jquery.min.js"></script> 
    <script src="<?=base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=base_url()?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?=base_url()?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?=base_url()?>assets/js/demo/datatables-demo.js"></script>
    <script src="<?=base_url()?>assets/js/demo/chart-area-demo.js"></script>
    <script src="<?=base_url()?>assets/js/demo/chart-pie-demo.js"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="<?=base_url()?>assets/js/bootstrap-editable.js"></script>
    <script src="<?=base_url()?>assets/js/sb-admin-2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>

</html>