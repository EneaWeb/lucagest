<!-- START JUMBOTRON -->
<div class="jumbotron" data-pages="parallax">
<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
<div class="inner">
<!-- START BREADCRUMB -->
<ul class="breadcrumb">

      <li><a href="/">HOME</a></li>
      <?php $before = ''; ?>
      <?php if(Request::url() !== Request::root()): ?>
      <?php $__currentLoopData = explode('/',str_replace(Request::root().'/', '', Request::url())); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $segment): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <?php $this_segment = urldecode(str_replace('-',' ',$segment)); 
                  $before .= '/'.$this_segment; ?>
            <?php if(strlen($this_segment) <= 16): ?>
            <li><a href="<?php echo $before; ?>"><?php echo $this_segment; ?></a></li>
            <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
      <?php endif; ?>
</ul>
<!-- END BREADCRUMB -->
</div>
</div>
<!-- END JUMBOTRON -->