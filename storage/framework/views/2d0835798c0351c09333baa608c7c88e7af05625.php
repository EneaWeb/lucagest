<!DOCTYPE html>
<html>
  <head>
      <?php echo $__env->make('layout.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </head>
  <body class="fixed-header ">
  
    <?php echo $__env->make('layout.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
         
    <?php echo $__env->make('layout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!-- START PAGE-CONTAINER -->
    <div class="page-container ">
        <!-- START PAGE CONTENT WRAPPER -->
        <div class="page-content-wrapper ">
            <!-- START PAGE CONTENT -->
            <div class="content ">

                 <?php echo $__env->make('layout.jumbothron', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <!-- START CONTAINER FLUID -->
                  <?php echo $__env->yieldContent('content'); ?>
            
              </div>
          <!-- END PAGE CONTENT WRAPPER -->
      </div>
      <!-- END PAGE CONTAINER -->

    <?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php echo $__env->make('layout.overlay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('layout.foot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   
  </body>
</html>