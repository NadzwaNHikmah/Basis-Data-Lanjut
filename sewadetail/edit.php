<?php
include("../controllers/Sewadetail.php");
include("../lib/functions.php");
$obj = new SewadetailController();
if(isset($_GET["id"])){
    $id=$_GET["id"];
}

$msg=null;
if (isset($_POST["submitted"])==1 && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $id = $_POST['id'];
    $sewa_id = $_POST['sewa_id'];
    $kode_alat = $_POST['kode_alat'];
    // Update the database record using your controller's method
$dat = $obj->updatesewadetail($id, $sewa_id, $kode_alat);
$msg = getJSON($dat);
}
$rows = $obj->getSewadetail($id);
$theme=setTheme();
getHeader($theme);
?>

    <?php 
    if($msg===true){ 
        echo '<div class="alert alert-success" style="display: block" id="message_success">Update Data Berhasil</div>';
        echo '<meta http-equiv="refresh" content="2;url='.base_url().'sewadetail/">';
    } elseif($msg===false) {
        echo '<div class="alert alert-danger" style="display: block" id="message_error">Update Gagal</div>'; 
    } else {

    }
    
    ?>
        <div class="header icon-and-heading">
        <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
        <h2><strong>sewadetail</strong> <small>Edit Data</small> </h2>
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
                        <label>sewa_id:</label>
                        <input type="text" class="form-control" id="sewa_id" name="sewa_id" 
                            value="<?php echo $row['sewa_id']; ?>" />
                    </div>
                
                    <div class="form-group">
                        <label>kode_alat:</label>
                        <input type="text" class="form-control" id="kode_alat" name="kode_alat" 
                            value="<?php echo $row['kode_alat']; ?>" />
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
