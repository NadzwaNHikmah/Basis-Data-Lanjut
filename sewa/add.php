<?php
include("../controllers/Sewa.php");
include("../controllers/Penyewa.php");
include("../lib/functions.php");
$obj = new SewaController();
$penyewa = new PenyewaController();
$list = $penyewa->getPenyewaList();
$msg=null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $nomor_bukti = $_POST['nomor_bukti'];
    $nomor_penyewa = $_POST['nomor_penyewa'];
    $tanggal_sewa = $_POST['tanggal_sewa'];
    
    // Insert the database record using your controller's method
$dat = $obj->addsewa($nomor_bukti, $nomor_penyewa, $tanggal_sewa);
$msg = getJSON($dat);
}
$theme=setTheme();
getHeader($theme);
$nomor_bukti = generateRandomString();
?>

<?php 
if($msg===true){ 
    echo '<div class="alert alert-success" style="display: block" id="message_success">Insert Data Berhasil</div>';
    echo '<meta http-equiv="refresh" content="2;url='.base_url().'sewa/">';
} elseif($msg===false) {
    echo '<div class="alert alert-danger" style="display: block" id="message_error">Insert Gagal</div>'; 
} else {

}

?>
        <div class="header icon-and-heading fs-1">
        <i class="zmdi zmdi-view-dashboard zmdi-hc-4x"></i>
            <h2><strong>sewa</strong> <small>Add New Data</small> </h2>
        </div>
        <hr/>
        <form name="formAdd" method="POST" action="">
            
                <div class="form-group col-md-3">
                    <label>Nomor_bukti:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="nomor_bukti" value="<?php echo $nomor_bukti; ?>" readonly="readonly"/>
                        
                    </div>
                </div>
            
                <div class="form-group mt-3">
                    <label>Nomor_penyewa:</label>
                    
                    <select class="form-control" name="nomor_penyewa" id="nomor_penyewa">
                        <option value="">Pilih Penyewa...</option>
                        <?php foreach($list as $ang): ?>
                            <option value="<?php echo htmlspecialchars($ang['nomor_penyewa']); ?>">
                                <?php echo htmlspecialchars($ang['nomor_penyewa']) . ' - ' . htmlspecialchars($ang['nama']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            
                <div class="form-group mt-3">
                    <label>Tanggal_sewa:</label>
                    <input type="date" class="form-control" name="tanggal_sewa"  />
                </div>
            
               
            
            <button class="save btn btn-large btn-info" type="submit">Save</button>
            <a href="#index" class="btn btn-large btn-default">Cancel</a>
        </form>

<?php
getFooter($theme,"<script src='../lib/forms.js'></script>");
?>
</body>
</html>