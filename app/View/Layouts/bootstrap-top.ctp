<?php echo $this->element('header');?>

    <?php echo $this->fetch('content'); ?>
    <hr>
    </div>
    <!-- /.container -->

    <!-- Bootstrap Core JavaScript -->
    <script src="/appointment/js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
</body>
</html>