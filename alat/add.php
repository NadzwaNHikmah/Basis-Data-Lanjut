<?php
include("../controllers/Alat.php");
include("../lib/functions.php");
$obj = new AlatController();
$msg=null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $kode_alat = $_POST['kode_alat'];
    $nama = $_POST['nama'];
    $harga_sewa = $_POST['harga_sewa'];
    // Insert the database record using your controller's method
$dat = $obj->addalat($kode_alat, $nama, $harga_sewa);
$msg = getJSON($dat);
}
$theme=setTheme();
getHeader($theme);
?>

<?php 
if($msg===true){ 
    echo '<div class="alert alert-success" style="display: block" id="message_success">Insert Data Berhasil</div>';
    echo '<meta http-equiv="refresh" content="2;url='.base_url().'alat/">';
} elseif($msg===false) {
    echo '<div class="alert alert-danger" style="display: block" id="message_error">Insert Gagal</div>'; 
} else {

}

?>
        <div class="header icon-and-heading fs-1">
        <i class="zmdi zmdi-view-dashboard zmdi-hc-4x"></i>
            <h2><strong>alat</strong> <small>Add New Data</small> </h2>
        </div>
        <hr/>
        <form name="formAdd" method="POST" action="">
            
                <div class="form-group">
                    <label>Kode_alat:</label>
                    <input type="text" class="form-control" name="kode_alat"  />
                </div>
            
                <div class="form-group">
                    <label>Nama:</label>
                    <input type="text" class="form-control" name="nama"  />
                </div>
            
                <div class="form-group">
                    <label>Harga_sewa:</label>
                    <input type="text" class="form-control" name="harga_sewa"  />
                </div>
            
            <button class="save btn btn-large btn-info" type="submit">Save</button>
            <a href="#index" class="btn btn-large btn-default">Cancel</a>
        </form>

<?php
getFooter($theme,"<script src='../lib/forms.js'></script>");
?>
</body>
</html>