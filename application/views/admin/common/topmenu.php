<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<!-- navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-inner">
        <a class="brand" href="index.html"><img src="<?php echo base_url('public/admin/img/logo.png') ?>"></a>

        <!-- shows same menu as sidebar but for mobile devices -->
        <button type="button" class="btn btn-navbar visible-phone" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="nav-collapse collapse visible-phone mobile-menu">
            <ul class="nav">
                <li class="active"><a href="index.html">Home</a></li>
                <li><a href="chart-showcase.html">Charts</a></li>
                <li><a href="user-list.html">Users</a></li>
                <li><a href="form-showcase.html">Forms</a></li>
                <li><a href="gallery.html">Gallery</a></li>
                <li><a href="icons.html">Icons</a></li>
                <li><a href="calendar.html">Calendar</a></li>
                <li><a href="tables.html">Tables</a></li>
                <li><a href="ui-elements.html">UI Elements</a></li>
            </ul>
        </div>
        
    </div>
</div>
<!-- end navbar -->