<?php session_start(); ?>
<?php 

if(!isset($_SESSION['username']))
{
	// echo "<script>alert('Maaf, Session anda telah habis, silahkan login kembali.'); location.href='index.php';</script>";
}
$data = (include 'getJadwal.php');
$data = json_decode($data,true);

header('Content-type: text/html');
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>GKR Mobile Admin Panel</title>
	
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="js/hideshow.js" type="text/javascript"></script>
	<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

</head>


<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="#">GKR Mobile</a></h1>
			<h2 class="section_title">Dashboard</h2>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>Welcome, <?php echo $_SESSION['username']; ?></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="#">GKR Mobile</a> <div class="breadcrumb_divider"></div> <a class="current">Dashboard</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
		<form class="quick_search">
			<input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		<hr/>
		<h3>Jadwal Pelayanan</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="formTambahJadwal.php">Tambah Jadwal Pelayanan</a></li>
		</ul>
		<h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_jump_back"><a href="#">Keluar</a></li>
		</ul>
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2016 GKR Mobile</strong></p>
		</footer>
	</aside><!-- end of sidebar -->
	
	<section id="main" class="column">
		
		<h4 class="alert_info">Selamat datang di GKR Mobile Admin Panel</h4>		
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Jadwal Pelayanan</h3>
		<ul class="tabs">
   			<li><a href="#tab1">Jadwal</a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>Jenis Kebaktian</th> 
    				<th>Tema</th> 
    				<th>Nama Pengkhotbah</th> 
    				<th>Tanggal</th>
					<th></th>
				</tr> 
			</thead> 
			<tbody> 
				<?php
					if(isset($data) && $data['status'] != 0)
					{
						foreach($data['count'] as $key=>$val){ 
							echo '<td>' . $val['service_type'] . '</td>';
							echo '<td>' . $val['theme'] . '</td>';
							echo '<td>' . $val['preacher_nm'] . '</td>';
							echo '<td>' . $val['service_dt'] . '</td>';
							echo '<td><a href="www.google.com"><input type="image" src="images/icn_edit.png" title="Edit"></a></td>';
						} 
					}
				?> 				
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
		
		<div class="clear"></div>
	</section>


</body>

</html>