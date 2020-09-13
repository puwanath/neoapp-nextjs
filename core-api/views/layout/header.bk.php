<header class="c-layout-header c-layout-header-onepage c-layout-header-4 c-bordered c-layout-header-default-mobile c-header-transparent-dark" id="home" data-minimize-offset="40">
	<div class="c-navbar">
		<div class="container-fluid">
			<!-- BEGIN: BRAND -->
			<div class="c-navbar-wrapper clearfix">
				<div class="c-brand c-pull-left">
					<a href="<?=$url;?>" class="c-logo">
						<img src="<?=img_webp("images/".getcomp('logo_web'));?>" alt="<?php echo getcomp('companyname');?>" class="c-desktop-logo">
						<img src="<?=img_webp("images/".getcomp('logo_web'));?>" alt="<?php echo getcomp('companyname');?>" class="c-desktop-logo-inverse">
						<img src="<?=img_webp("images/".getcomp('logo_web'));?>" alt="<?php echo getcomp('companyname');?>" class="c-mobile-logo" style="max-height:30px;">
					</a>
					<button class="c-hor-nav-toggler" type="button" data-target=".c-mega-menu">
  					<span class="c-line c-line-1"></span>
  					<span class="c-line c-line-2"></span>
  					<span class="c-line c-line-3"></span>
					</button>
          <!-- <a href="<?=$url;?>/lg.php?lg=TH&uri=<?=$uri;?>" class="c-cart-toggler c-link" style="font-weight:600;padding-top:3px;">TH</a>
          <a href="<?=$url;?>/lg.php?lg=EN&uri=<?=$uri;?>" class="c-cart-toggler c-link" style="font-weight:600;padding-top:3px;">EN</a> -->
				</div>
				<!-- END: BRAND -->
				<!-- BEGIN: HOR NAV -->
        <nav class="c-mega-menu c-mega-menu-onepage c-pull-right c-mega-menu-dark c-mega-menu-dark-mobile c-fonts-uppercase c-fonts-bold" data-onepage-animation-speed="700">
        	<ul class="nav navbar-nav c-theme-nav">
        		<li class="c-onepage-link c-active active">
        			<a href="#home" class="c-link"><?=$word->wordvar('Home');?></a>
        		</li>
        		<li class="c-onepage-link ">
        			<a href="#office" class="c-link"><?=$word->wordvar('office');?></a>
        		</li>
        		<li class="c-onepage-link ">
        			<a href="#specification-and-facilities" class="c-link"><?=$word->wordvar('SPECIFICATION AND FACILITIES');?></a>
        		</li>
        		<li class="c-onepage-link ">
        			<a href="#directory" class="c-link"><?=$word->wordvar('Directory');?></a>
        		</li>
        		<li class="c-onepage-link ">
        			<a href="https://www.glasshouseatsindhorn.com/" target="_blank" class="c-link"><?=$word->wordvar('Glasshouse');?></a>
        		</li>
        		<li class="c-onepage-link ">
        			<a href="#news" class="c-link"><?=$word->wordvar('News');?></a>
        		</li>
        		<li class="c-onepage-link ">
        			<a href="#contact" class="c-link"><?=$word->wordvar('Contact us');?></a>
        		</li>
            <li <?php if($_SESSION['lg']=="TH"){ echo "class='c-active hidden-xs hidden-sm'";}else{echo "class='hidden-xs hidden-sm'";}?>>
              <a href="<?=$url;?>/lg.php?lg=TH&uri=<?=$uri;?>" class="c-link" style="padding-left:0px;padding-right:0px;"><span style="padding: 5px;background-color: #d7c49b;">TH</span></a>
            </li>
            <li <?php if($_SESSION['lg']=="EN"){ echo "class='c-active hidden-xs hidden-sm'";}else{echo "class='hidden-xs hidden-sm'";}?>>
              <a href="<?=$url;?>/lg.php?lg=EN&uri=<?=$uri;?>" class="c-link" style="padding-left:0px;padding-right:0px;"><span style="padding: 5px;background-color: #d7c49b;">EN</span></a>
            </li>

        	</ul>
					<div class="c-onepage-link visible-sm visible-xs" style="height:50px;padding-top: 25px;">
						<a href="<?=$url;?>/lg.php?lg=TH&uri=<?=$uri;?>" class=""><span class="<?php echo ($_SESSION['lg']=='TH'?'lang-active':'lang-normal');?>">TH</span></a>
						<a href="<?=$url;?>/lg.php?lg=EN&uri=<?=$uri;?>" class=""><span class="<?php echo ($_SESSION['lg']=='EN'?'lang-active':'lang-normal');?>">EN</span></a>
					</div>
        </nav>

				<!-- END: HOR NAV -->
			</div>
		</div>
	</div>
</header>
