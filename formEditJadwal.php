<?php include 'checkSession.php'; ?>
<?php include_once('connectToDB.php');

 $id = $_GET['id'];
 //$qur = mysql_query("select * FROM tbl_service_schedule ORDER BY service_dt, service_type");
 $qur = mysql_query("select * FROM tbl_service_schedule WHERE id = $id");
 if(mysql_num_rows($qur) > 0){
	while($row = mysql_fetch_array($qur)){ 
		$service_dt = $row["service_dt"];
		$service_type = $row["service_type"];
		$theme = $row["theme"];
		$preacher_nm = $row["preacher_nm"];
	}
 }
 ?>
<link rel="stylesheet" href="css/form-builder.min.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/form-render.min.css" type="text/css" media="screen" />

<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
<script src="js/form-builder.min.js" type="text/javascript"></script>
<script src="js/form-render.min.js" type="text/javascript"></script>

<form id="rendered-form" action="setJadwalPelayanan.php" method="post">
  <div class="rendered-form">
    <div class="">
      <h1 type="h1" subtype="h1" class="header" id="">Tambah Jadwal Pelayanan</h1>
    </div>
    <div class="form-group field-servicedt"><label for="servicedt">Tanggal Pelayanan <span class="required">*</span> </label> <input type="date" required="" class="form-control calendar" name="service_dt" id="service_dt" aria-required="true"></div>
    <div class="form-group field-servicetype">
      <label for="servicetype">Jenis Pelayanan <span class="required">*</span> </label>
      <select type="select" required="" class="form-control select" name="service_type" id="service_type" aria-required="true">
        <option value="KU1" selected="true">KU 1</option>
        <option value="KU2">KU 2</option>
        <option value="Remaja">Remaja</option>
        <option value="Pemuda">Pemuda</option>
        <option value="Youth(Gabungan)">Youth ( Gabungan)</option>
        <option value="KomisiPasutri">Komisi Pasutri</option>
        <option value="KomisiWanita">Komisi Wanita</option>
        <option value="KomisiUsiaEmas">Komisi Usia Emas</option>
        <option value="PersekutuanDoa">Persekutuan Doa</option>
        <option value="MPD">MPD</option>
        <option value="Natal">Natal</option>
        <option value="JumatAgung">Jumat Agung</option>
        <option value="Paskah">Paskah</option>
        <option value="TahunBaru">Tahun Baru</option>
        <option value="KKR">KKR</option>
      </select>
    </div>
    <div class="form-group field-theme"><label for="theme">Tema  </label> <input type="text" subtype="text" class="form-control text-input" name="theme" id="theme"></div>
    <div class="form-group field-preachernm"><label for="preachernm">Nama Pengkhotbah <span class="required">*</span> </label> <input type="text" subtype="text" required="" class="form-control text-input" name="preacher_nm" id="preacher_nm" aria-required="true"></div>
    <div class="form-group field-penterjemah"><label for="penterjemah">Penterjemah  </label> <input type="text" subtype="text" class="form-control text-input" name="penterjemah" id="penterjemah"></div>
    <div class="form-group field-worshipleader"><label for="worshipleader">Worship Leader  </label> <input type="text" subtype="text" class="form-control text-input" name="worshipleader" id="worshipleader"></div>
    <div class="form-group field-singers"><label for="singers">Singers  <span class="tooltip-element" tooltip="Pisahkan dengan tanda koma apabila lebih dari 1. (Contoh : Webster, Redo)">?</span></label> <input type="text" subtype="text" class="form-control text-input" name="singers" id="singers"></div>
    <div class="form-group field-pemusik"><label for="pemusik">Pemusik  <span class="tooltip-element" tooltip="Pisahkan dengan tanda koma apabila lebih dari 1. (Contoh : Webster, Redo)">?</span></label> <input type="text" subtype="text" class="form-control text-input" name="pemusik" id="pemusik"></div>
    <div class="form-group field-kolektan"><label for="kolektan">Kolektan  <span class="tooltip-element" tooltip="Pisahkan dengan tanda koma apabila lebih dari 1. (Contoh : Webster, Redo)">?</span></label> <input type="text" subtype="text" class="form-control text-input" name="kolektan" id="kolektan"></div>
    <div class="form-group field-usher"><label for="usher">Usher  <span class="tooltip-element" tooltip="Pisahkan dengan tanda koma apabila lebih dari 1. (Contoh : Webster, Redo)">?</span></label> <input type="text" subtype="text" class="form-control text-input" name="usher" id="usher"></div>
    <div class="form-group field-lcd"><label for="lcd">LCD  </label> <input type="text" subtype="text" class="form-control text-input" name="lcd" id="lcd"></div>
    <div class="form-group field-soundsystem"><label for="soundsystem">Sound System  <span class="tooltip-element" tooltip="Pisahkan dengan tanda koma apabila lebih dari 1. (Contoh : Webster, Redo)">?</span></label> <input type="text" subtype="text" class="form-control text-input" name="soundsystem" id="soundsystem"></div>
	<div class="form-group field-button-1472405594993">
		<button type="submit" subtype="submit" class="btn btn-success button-input" name="submit" id="submit">Save</button>
		<a href="dashboard.php"><button type="button" subtype="button" class="btn btn-warning button-input" name="button" id="button">Back</button></a>
	</div>
	
  </div>
</form>