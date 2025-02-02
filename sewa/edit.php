<?php
include("../controllers/Sewa.php");
include("../lib/functions.php");
$obj = new SewaController();
if(isset($_GET["id"])){
    $id=$_GET["id"];
}

$msg=null;
if (isset($_POST["submitted"])==1 && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $id = $_POST['id'];
    $nomor_bukti = $_POST['nomor_bukti'];
    $nomor_penyewa = $_POST['nomor_penyewa'];
    $tanggal_sewa = $_POST['tanggal_sewa'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    // Update the database record using your controller's method
$dat = $obj->updatesewa($id, $nomor_bukti, $nomor_penyewa, $tanggal_sewa, $tanggal_kembali);
$msg = getJSON($dat);
}
$rows = $obj->getSewa($id);
$theme=setTheme();
getHeader($theme);
?>

    <?php 
    if($msg===true){ 
        echo '<div class="alert alert-success" style="display: block" id="message_success">Update Data Berhasil</div>';
        echo '<meta http-equiv="refresh" content="2;url='.base_url().'sewa/">';
    } elseif($msg===false) {
        echo '<div class="alert alert-danger" style="display: block" id="message_error">Update Gagal</div>'; 
    } else {

    }
    
    ?>
        <div class="header icon-and-heading">
        <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
        <h2><strong>sewa</strong> <small>Edit Data</small> </h2>
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
                        <label>nomor_bukti:</label>
                        <input type="text" class="form-control" id="nomor_bukti" name="nomor_bukti" 
                            value="<?php echo $row['nomor_bukti']; ?>" />
                    </div>
                
                    <div class="form-group">
                        <label>nomor_penyewa:</label>
                        <input type="text" class="form-control" id="nomor_penyewa" name="nomor_penyewa" 
                            value="<?php echo $row['nomor_penyewa']; ?>" />
                    </div>
                
                    <div class="form-group">
                        <label>tanggal_sewa:</label>
                        <input type="date" class="form-control" id="tanggal_sewa" name="tanggal_sewa" 
                            value="<?php echo $row['tanggal_sewa']; ?>" />
                    </div>
                
                    <div class="form-group">
                        <label>tanggal_kembali:</label>
                        <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" 
                            value="<?php echo $row['tanggal_kembali']; ?>" />
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
