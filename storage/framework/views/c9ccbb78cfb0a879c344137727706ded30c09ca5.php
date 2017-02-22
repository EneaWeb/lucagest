
<!-- START HEADER -->
<div class="header ">
   <!-- START MOBILE CONTROLS -->
   <div class="container-fluid relative">
      <!-- LEFT SIDE -->
      <div class="pull-left full-height visible-sm visible-xs">
      <!-- START ACTION BAR -->
      <div class="header-inner">
         <a href="#" class="btn-link toggle-sidebar visible-sm-inline-block visible-xs-inline-block padding-5" data-toggle="sidebar">
            <span class="icon-set menu-hambuger"></span>
         </a>
      </div>
      <!-- END ACTION BAR -->
      </div>
      <div class="pull-center hidden-md hidden-lg">
      <div class="header-inner">
         <div class="brand inline">
            <a href="/">
            <img src="/assets/img/logo.png" alt="logo" data-src="/assets/img/logo.png" data-src-retina="/assets/img/logo_2x.png" style="width:78px; height:auto">
            </a>
         </div>
      </div>
      </div>
      <!-- RIGHT SIDE -->
      <div class="pull-right full-height visible-sm visible-xs">
      <!-- START ACTION BAR -->
      <div class="header-inner">
         <a href="#" class="btn-link visible-sm-inline-block visible-xs-inline-block" data-toggle="quickview" data-toggle-element="#quickview">
            <span class="icon-set menu-hambuger-plus"></span>
         </a>
      </div>
      <!-- END ACTION BAR -->
      </div>
   </div>
   <!-- END MOBILE CONTROLS -->
   <div class=" pull-left sm-table hidden-xs hidden-sm">
      <div class="header-inner">
      <div class="brand inline">
         <img src="/assets/img/logo.png" alt="logo" data-src="/assets/img/logo.png" data-src-retina="/assets/img/logo.png" width="78" height="22">
      </div>
      <!-- START NOTIFICATION LIST -->
      <ul class="notification-list no-margin hidden-sm hidden-xs b-grey b-l b-r no-style p-l-30 p-r-20">
         <li class="p-r-15 inline">
            <div class="dropdown">
            
            
            </div>
         </li>
         
      </ul>
      <!-- END NOTIFICATIONS LIST -->
      
      </div>
   </div>
   <div class=" pull-right">
      <!-- START User Info-->
      <div class="visible-lg visible-md m-t-10">
      <div class="pull-left p-r-10 p-t-10 fs-16 font-heading">
         <span class="semi-bold"><?php echo Auth::check() ? Auth::user()->name : ''; ?></span>
      </div>
      <div class="dropdown pull-right">
         <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="thumbnail-wrapper d32 circular inline m-t-5">
            <img src="/assets/img/user_icon.png" alt="" data-src="/assets/img/user_icon.png" data-src-retina="/assets/img/user_icon.png" width="32" height="32">
      </span>
         </button>

         <?php if(Auth::check()): ?>
            <ul class="dropdown-menu profile-dropdown" role="menu">
                  <li><a href="#"><i class="pg-settings_small"></i> Settings</a>
                  </li>
                  <li><a href="#"><i class="pg-outdent"></i> Feedback</a>
                  </li>
                  <li><a href="#"><i class="pg-signals"></i> Help</a>
                  </li>
                  <li class="bg-master-lighter">
                  <a href="#" class="clearfix">
                  <span class="pull-left">Logout</span>
                  <span class="pull-right"><i class="pg-power"></i></span>
                  </a>
                  </li>
            </ul>
         <?php endif; ?>

      </div>
      </div>
      <!-- END User Info-->
   </div>
</div>
<!-- END HEADER -->