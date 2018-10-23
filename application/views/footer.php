        </div>
        <script type="text/javascript">
            <?php $sess = $this->session->userdata('user_info'); ?>
            var own_id = "<?php echo $sess->id; ?>";
            var base_url =  "<?php echo base_url();?>";
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js"></script>
        <script src="<?php echo base_url();?>assets/jquery-3.2.1.min.js"></script>
        <script src="<?php echo base_url();?>assets/tether.js"></script>
        <script src="<?php echo base_url();?>assets/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>assets/custom.js"></script>
    </body>
</html>