<!-- START JUMBOTRON -->
<div class="jumbotron" data-pages="parallax">
<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
<div class="inner">
<!-- START BREADCRUMB -->
<ul class="breadcrumb">

      <li><a href="/">HOME</a></li>
      <?php $before = ''; ?>
      @if (Request::url() !== Request::root())
      @foreach (explode('/',str_replace(Request::root().'/', '', Request::url())) as $k => $segment)
            <?php $this_segment = urldecode(str_replace('-',' ',$segment)); 
                  $before .= '/'.$this_segment; ?>
            @if (strlen($this_segment) <= 16)
            <li><a href="{!!$before!!}">{!!$this_segment!!}</a></li>
            @endif
      @endforeach
      @endif
</ul>
<!-- END BREADCRUMB -->
</div>
</div>
<!-- END JUMBOTRON -->