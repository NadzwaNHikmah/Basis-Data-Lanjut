<?php
include("../controllers/Alat.php");
include("../lib/functions.php");
$obj = new AlatController();
if(isset($_GET["id"])){
    $id=$_GET["id"];
}

$msg=null;
if (isset($_POST["submitted"])==1 && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $id = $_POST['id'];
    $kode_alat = $_POST['kode_alat'];
    $nama = $_POST['nama'];
    $harga_sewa = $_POST['harga_sewa'];
    // Update the database record using your controller's method
$dat = $obj->updatealat($id, $kode_alat, $nama, $harga_sewa);
$msg = getJSON($dat);
}
$rows = $obj->getAlat($id);
$theme=setTheme();
getHeader($theme);
?>

    <?php 
    if($msg===true){ 
        echo '<div class="alert alert-success" style="display: block" id="message_success">Update Data Berhasil</div>';
        echo '<meta http-equiv="refresh" content="2;url='.base_url().'alat/">';
    } elseif($msg===false) {
        echo '<div class="alert alert-danger" style="display: block" id="message_error">Update Gagal</div>'; 
    } else {

    }
    
    ?>
        <div class="header icon-and-heading">
        <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
        <h2><strong>alat</strong> <small>Edit Data</small> </h2>
        </div>
        <hr style="margin-bottom:-2px;"/>
        <form name="formEdit" method="POST" action="">
            <input type="hidden" class="form-control" name="submitted" value="1"/>
            <?php foreach ($rows as $row): ?>
            
                    <div class="form-group">
                        <label>id:</label>
                        <input type="text" class="form-control" id="id" name="id" 
                            value="<?php echo $row['id']; ?>" readonly/>
                    </div>
                
                    <div class="form-group">
                        <label>kode_alat:</label>
                        <input type="text" class="form-control" id="kode_alat" name="kode_alat" 
                            value="<?php echo $row['kode_alat']; ?>" />
                    </div>
                
                    <div class="form-group">
                        <label>nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" 
                            value="<?php echo $row['nama']; ?>" />
                    </div>
                
                    <div class="form-group">
                        <label>harga_sewa:</label>
                        <input type="text" class="form-control" id="harga_sewa" name="harga_sewa" 
                            value="<?php echo $row['harga_sewa']; ?>" />
                    </div>
                
            
            <?php endforeach; ?>
            <button class="save btn btn-large btn-info" type="submit">Save</button>
            <a href="#index" class="btn btn-large btn-default">Cancel</a>
        </form>
                                        
<?php
getFooter($theme,"<script src='../lib/forms.js'></script>");
?>
</body>
</html>


