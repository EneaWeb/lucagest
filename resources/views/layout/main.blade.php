<!DOCTYPE html>
<html>
  <head>
      @include('layout.head')
  </head>
  <body class="fixed-header ">
  
    @include('layout.sidebar')
         
    @include('layout.header')

    <!-- START PAGE-CONTAINER -->
    <div class="page-container ">
        <!-- START PAGE CONTENT WRAPPER -->
        <div class="page-content-wrapper ">
            <!-- START PAGE CONTENT -->
            <div class="content ">

                 @include('layout.jumbothron')

                <!-- START CONTAINER FLUID -->
                  @yield('content')
            
              </div>
          <!-- END PAGE CONTENT WRAPPER -->
      </div>
      <!-- END PAGE CONTAINER -->

    @include('layout.footer')
    
    @include('layout.overlay')

    @include('layout.foot')
   
  </body>
</html>