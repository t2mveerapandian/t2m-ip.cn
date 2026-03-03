<div class="page-sidebar nav-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<ul>
				<li style="margin-bottom:10px;">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone"></div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<!--<li>
					
					<form class="sidebar-search">
						<div class="input-box">
							<a href="javascript:;" class="remove"></a>
							<input type="text" placeholder="Search..." />
							<input type="button" class="submit" value=" " />
						</div>
					</form>
					
				</li>-->
				<li class="start <?php if(basename($_SERVER['PHP_SELF'])=='dashboard.php') echo "active";?>">
					<a href="dashboard.php">
					<i class="icon-home"></i>
					<span class="title">Dashboard</span>
					<span class="selected"></span>
					</a>
				</li>
				<li class="has-sub <?php if(basename($_SERVER['PHP_SELF'])=='manage_categories.php' || basename($_SERVER['PHP_SELF'])=='add_category.php' || basename($_SERVER['PHP_SELF'])=='edit_category.php') echo "active";?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i>
					<span class="title">Manage Category</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub">
						<li class="<?php if(basename($_SERVER['PHP_SELF'])=='add_category.php') echo "active";?>"><a href="add_category.php">Add New Category</a></li>
						<li class="<?php if(basename($_SERVER['PHP_SELF'])=='manage_categories.php') echo "active";?>"><a href="manage_categories.php">Category List</a></li>
					</ul>
				</li>
				

				<li class="has-sub <?php if(basename($_SERVER['PHP_SELF'])=='manage_products.php' || basename($_SERVER['PHP_SELF'])=='add_product.php') echo "active";?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i>
					<span class="title">Manage Products</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub">
						<li class="<?php if(basename($_SERVER['PHP_SELF'])=='add_product.php') echo "active";?>"><a href="add_product.php">Add Product</a></li>
						<li class="<?php if(basename($_SERVER['PHP_SELF'])=='manage_products.php') echo "active";?>"><a href="manage_products.php">Products List</a></li>
					</ul>
				</li>

				<li class="has-sub <?php if(basename($_SERVER['PHP_SELF'])=='manage_prmenu.php' || basename($_SERVER['PHP_SELF'])=='add_prmenu.php' || basename($_SERVER['PHP_SELF'])=='add_menu.php' || basename($_SERVER['PHP_SELF'])=='edit_prmenu.php' || basename($_SERVER['PHP_SELF'])=='edit_menu.php' || basename($_SERVER['PHP_SELF'])=='manage_menu.php') echo "active";?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i>
					<span class="title">Manage Menu</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub">
					    <li class="<?php if(basename($_SERVER['PHP_SELF'])=='add_menu.php') echo "active";?>"><a href="add_menu.php">Add New Menu</a></li>
						<li class="<?php if(basename($_SERVER['PHP_SELF'])=='manage_menu.php') echo "active";?>"><a href="manage_menu.php">Menu List</a></li>
					</ul>
				</li>
				<li class="has-sub <?php if(basename($_SERVER['PHP_SELF'])=='manage_slider_menu.php' || basename($_SERVER['PHP_SELF'])=='edit_slider_menu.php') echo "active";?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i>
					<span class="title">Manage Slider Menu</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub">
					    <li class="<?php if(basename($_SERVER['PHP_SELF'])=='manage_slider_menu.php' || basename($_SERVER['PHP_SELF'])=='edit_slider_menu.php') echo "active";?>"><a href="manage_slider_menu.php">Slider Menu List</a></li>
					</ul>
				</li>

				<li class="has-sub <?php if(basename($_SERVER['PHP_SELF'])=='manage_pages.php' || basename($_SERVER['PHP_SELF'])=='add_page.php') echo "active";?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i>
					<span class="title">Manage Pages</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub">
						<li class="<?php if(basename($_SERVER['PHP_SELF'])=='add_page.php') echo "active";?>"><a href="add_page.php">Add Page</a></li>
						<li class="<?php if(basename($_SERVER['PHP_SELF'])=='manage_pages.php') echo "active";?>"><a href="manage_pages.php">Page List</a></li>
					</ul>
				</li>

				<li class="has-sub <?php if(basename($_SERVER['PHP_SELF'])=='manage_blogs.php' || basename($_SERVER['PHP_SELF'])=='add_blog.php') echo "active";?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i>
					<span class="title">Manage News</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub">
						<li class="<?php if(basename($_SERVER['PHP_SELF'])=='add_blog.php') echo "active";?>"><a href="add_blog.php">Add News</a></li>
						<li class="<?php if(basename($_SERVER['PHP_SELF'])=='manage_blogs.php') echo "active";?>"><a href="manage_blogs.php">News List</a></li>
					</ul>
				</li>
				
				
                
                <li class="has-sub <?php if(basename($_SERVER['PHP_SELF'])=='manage_events.php' || basename($_SERVER['PHP_SELF'])=='add_events.php' || basename($_SERVER['PHP_SELF'])=='edit_events.php' || basename($_SERVER['PHP_SELF'])=='manage_slider.php' || basename($_SERVER['PHP_SELF'])=='add_slider.php' || basename($_SERVER['PHP_SELF'])=='edit_slider.php') echo "active";?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i>
					<span class="title">Manage Events</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub">
						<li class="<?php if(basename($_SERVER['PHP_SELF'])=='add_events.php') echo "active";?>"><a href="add_events.php">Add New Event</a></li>
						<li class="<?php if(basename($_SERVER['PHP_SELF'])=='manage_events.php') echo "active";?>"><a href="manage_events.php">Events List</a></li>
						<li class="<?php if(basename($_SERVER['PHP_SELF'])=='add_slider.php') echo "active";?>"><a href="add_slider.php">Add New Slider</a></li>
						<li class="<?php if(basename($_SERVER['PHP_SELF'])=='manage_slider.php') echo "active";?>"><a href="manage_slider.php">Slider List</a></li>
					</ul>
				</li>
				
				<li class="has-sub <?php if(basename($_SERVER['PHP_SELF'])=='manage_offices.php' || basename($_SERVER['PHP_SELF'])=='add_office.php' || basename($_SERVER['PHP_SELF'])=='edit_office.php') echo "active";?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i>
					<span class="title">Manage Offices</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub">
						<li class="<?php if(basename($_SERVER['PHP_SELF'])=='add_office.php') echo "active";?>"><a href="add_office.php">Add office</a></li>
						<li class="<?php if(basename($_SERVER['PHP_SELF'])=='manage_offices.php') echo "active";?>"><a href="manage_offices.php">Offices List</a></li>
					</ul>
				</li>
                
                <li class="has-sub <?php if(basename($_SERVER['PHP_SELF'])=='manage_homepageText.php' || basename($_SERVER['PHP_SELF'])=='add_homepageText.php') echo "active";?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i>
					<span class="title">Manage Home Text</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub">
						<li class="<?php if(basename($_SERVER['PHP_SELF'])=='add_homepageText.php') echo "active";?>"><a href="add_homepageText.php">Add Home Page Text</a></li>
						<li class="<?php if(basename($_SERVER['PHP_SELF'])=='manage_homepageText.php') echo "active";?>"><a href="manage_homepageText.php">Home Page Text</a></li>
					</ul>
				</li>
				
				<li class="has-sub <?php if(basename($_SERVER['PHP_SELF'])=='manage_career.php' || basename($_SERVER['PHP_SELF'])=='add_career.php') echo "active";?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i>
					<span class="title">Manage career</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub">
						<li class="<?php if(basename($_SERVER['PHP_SELF'])=='add_career.php') echo "active";?>"><a href="add_career.php">Add job post</a></li>
						<li class="<?php if(basename($_SERVER['PHP_SELF'])=='manage_career.php') echo "active";?>"><a href="manage_career.php">Job Post List</a></li>
					</ul>
				</li>
				
				<li class="<?php if(basename($_SERVER['PHP_SELF'])=='catalogue.php') echo "active";?>">
					<a href="catalogue.php">
					<i class="icon-user"></i>
					<span class="title">Upload IP Catalogue</span>
					</a>
				</li>
                
                <li class="<?php if(basename($_SERVER['PHP_SELF'])=='setting.php') echo "active";?>">
					<a href="setting.php">
					<i class="icon-user"></i>
					<span class="title">Setting</span>
					</a>
				</li>

				<li class="">
					<a href="functions/users.php?action=logout">
					<i class="icon-user"></i>
					<span class="title">Logout</span>
					</a>
				</li>

			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
