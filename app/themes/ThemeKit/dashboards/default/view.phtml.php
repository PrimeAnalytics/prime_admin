<!DOCTYPE html>
<html><head><link href="/themes/ThemeKit/assets/css/vendor/all.css" rel="stylesheet">
<link href="/themes/ThemeKit/assets/css/app/app.css" rel="stylesheet"></head><body><body>

  <!-- Wrapper required for sidebar transitions -->
  <div class="st-container">

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <a href="#sidebar-menu" data-toggle="sidebar-menu" data-effect="st-effect-3" class="toggle pull-left visible-xs"><i class="fa fa-bars"></i></a>

          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="index.html" class="navbar-brand hidden-xs navbar-brand-primary">ThemeKit</a>
        </div>
        <div class="navbar-collapse collapse" id="collapse">
          <form class="navbar-form navbar-left hidden-xs" role="search">
            <div class="search-2">
              <div class="input-group">
                <input type="text" class="form-control form-control-w-150" placeholder="Search .."><span class="input-group-btn">
            <button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
        </span>
              </div>
            </div>
          </form>
          <ul class="nav navbar-nav navbar-right">
<li class="dropdown user">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="%7B%7Buserimage%7D%7D" alt="" class="img-circle"> <?php echo $username; ?><span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
<li><a href="%7B%7Blogout%7D%7D"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
</li>
            <!-- // END user -->
          </ul>
</div>
      </div>
    </div>

    <div class="chat-window-container"></div>

    <!-- sidebar effects OUTSIDE of st-pusher: -->
    <!-- st-effect-1, st-effect-2, st-effect-4, st-effect-5, st-effect-9, st-effect-10, st-effect-11, st-effect-12, st-effect-13 -->

    <!-- content push wrapper -->
    <div class="st-pusher">

      <!-- Sidebar component with st-effect-3 (set on the toggle button within the navbar) -->
      <div class="sidebar left sidebar-size-2 sidebar-offset-0 sidebar-skin-blue sidebar-visible-desktop" id="sidebar-menu" data-type="collapse">
        <div class="split-vertical">
          <div class="sidebar-block tabbable tabs-icons">
            <ul class="nav nav-tabs">
<li class="active"><a href="#sidebar-tabs-menu" data-toggle="tab"><i class="fa fa-bars"></i></a></li>

            </ul>
</div>
          <div class="split-vertical-body">
            <div class="split-vertical-cell">
              <div class="tab-content">

                <div class="tab-pane active" id="sidebar-tabs-menu">
                  <div data-scrollable>
                    <ul class="sidebar-menu sm-icons-right sm-icons-block">
<li class="active"><a href="index.html"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                      <li><a href="email.html"><i class="fa fa-envelope"></i> <span>Email</span></a></li>
                      <li><a href="chat.html"><i class="fa fa-comments"></i> <span>Chat</span></a></li>
                    </ul>
</div>
                </div>
                <!-- // END .tab-pane -->

              </div>
              <!-- // END .tab-content -->

            </div>
            <!-- // END .split-vertical-cell -->

          </div>
          <!-- // END .split-vertical-body -->

        </div>
      </div>

      <!-- sidebar effects INSIDE of st-pusher: -->
      <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->

      <!-- this is the wrapper for the content -->
      <div class="st-content" id="content">

        <!-- extra div for emulating position:fixed of the menu -->
        <div class="st-content-inner">

          <div class="container-fluid">

          </div>

        </div>
        <!-- /st-content-inner -->

      </div>
      <!-- /st-content -->

    </div>
    <!-- /st-pusher -->

    <!-- Footer -->
    <footer class="footer"><strong>ThemeKit</strong> v4.0.0 © Copyright 2015
    </footer><!-- // Footer -->
</div>
  <!-- /st-container -->

  <!-- Modal -->
  <div class="modal fade image-gallery-item" id="showImageModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-header">
        On my way to the top
      </div>
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      <img class="img-responsive" src="images/place1-full.jpg" alt="Place">
</div>
  </div>
 
   <script>
    var colors = {
      "danger-color": "#e74c3c",
      "success-color": "#81b53e",
      "warning-color": "#f0ad4e",
      "inverse-color": "#2c3e50",
      "info-color": "#2d7cb5",
      "default-color": "#6e7882",
      "default-light-color": "#cfd9db",
      "purple-color": "#9D8AC7",
      "mustard-color": "#d4d171",
      "lightred-color": "#e15258",
      "body-bg": "#f6f6f6"
    };
    var config = {
      theme: "admin",
      skins: {
        "default": {
          "primary-color": "#3498db"
        }
      }
    };
  </script>
</body><script src="/themes/ThemeKit/assets/js/vendor/all.js"></script>
<script src="/themes/ThemeKit/assets/js/app/app.js"></script><?php echo $this->getContent(); ?></body></html>