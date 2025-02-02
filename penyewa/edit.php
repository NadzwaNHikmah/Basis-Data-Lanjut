<?php
include("../controllers/Penyewa.php");
include("../lib/functions.php");
$obj = new PenyewaController();
if(isset($_GET["id"])){
    $id=$_GET["id"];
}

$msg=null;
if (isset($_POST["submitted"])==1 && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $id = $_POST['id'];
    $nomor_penyewa = $_POST['nomor_penyewa'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
    // Update the database record using your controller's method
$dat = $obj->updatepenyewa($id, $nomor_penyewa, $nama, $jk, $alamat);
$msg = getJSON($dat);
}
$rows = $obj->getPenyewa($id);
$theme=setTheme();
getHeader($theme);
?>

    <?php 
    if($msg===true){ 
        echo '<div class="alert alert-success" style="display: block" id="message_success">Update Data Berhasil</div>';
        echo '<meta http-equiv="refresh" content="2;url='.base_url().'penyewa/">';
    } elseif($msg===false) {
        echo '<div class="alert alert-danger" style="display: block" id="message_error">Update Gagal</div>'; 
    } else {

    }
    
    ?>
        <div class="header icon-and-heading">
        <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
        <h2><strong>penyewa</strong> <small>Edit Data</small> </h2>
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
                        <label>nomor_penyewa:</label>
                        <input type="text" class="form-control" id="nomor_penyewa" name="nomor_penyewa" 
                            value="<?php echo $row['nomor_penyewa']; ?>" />
                    </div>
                
                    <div class="form-group">
                        <label>nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" 
                            value="<?php echo $row['nama']; ?>" />
                    </div>
                
                <div class="form-group">
                    <label>Jk:</label>
                    <select id="jk" name="jk" style="width:150px" 
                        class="form-control show-tick" required>
                    <option value="<?php echo $row['jk']; ?>">
                    <?php echo $row['jk']; ?></option>
                        <option value="L">L</option><option value="P">P</option>
                    </select>
                </div>
            
                    <div class="form-group">
                        <label>alamat:</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" 
                            value="<?php echo $row['alamat']; ?>" />
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
