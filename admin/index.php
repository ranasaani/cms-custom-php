<?php include"admin_header.php";?>


      <div class="row">
        <div class="large-12 columns">
          <h1 class="docs header"><a href="">Admin Panel</a></h1>
          <ul class="breadcrumbs">
             <li class="current" ><a href="#">Dashboard</a></li>
            </ul>
          <hr>

            <ul class="large-block-grid-5 icons-grid">
              <li><a href="cms/post.php?type=page"><div class="icon-doc-text"></div><div class="radius secondary label">Pages</div></a></li>
              <li><a href="cms/categories.php"><div class="icon-folder"></div><div class="radius secondary label">Categories</div></a></li>
              <li><a href="cms/post.php"><div class="icon-edit"></div><div class="radius secondary label">Posts</div></a></li>
              <li><a href="cms/menus.php"><div class="icon-th-list"></div><div class="radius secondary label">Menus</div></a></li>
              <li><a href="cms/subscribers.php"><div class="icon-users"></div><div class="radius secondary label">Subscribers</div></a></li>
            </ul>
            <ul class="large-block-grid-5 icons-grid">
              <li><a href="cms/widget.php"><div class="icon-qrcode"></div><div class="radius secondary label">Widgets</div></a></li>
              <li><a href="cms/ads.php"><div class="icon-link"></div><div class="radius secondary label">Ads</div></a></li>
              <li><a href="cms/settings.php"><div class="icon-wrench"></div><div class="radius secondary label">Settings</div></a></li>
            </ul>
        </div>
      </div>


<?php include"footer.php";?>
<style>
.icons-grid li{
	text-align:center;
}
.icons-grid li:hover{
	color:#2BA6CB;
	cursor:pointer;
}
.icons-grid li:hover .label{
	color:#2BA6CB;
}
[class^="icon-"]{
	font-size:6em;
}

</style>