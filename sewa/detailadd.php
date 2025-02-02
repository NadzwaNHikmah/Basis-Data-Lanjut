<?php
include("../controllers/Sewadetail.php");
include("../controllers/Alat.php");
include("../lib/functions.php");
$obj = new SewadetailController();
$myalat = new AlatController();
$alat = $myalat->getalatList();
if(isset($_GET["id"])){
    $id=$_GET["id"];
}
$msg=null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $sewa_id = $id;
    $kode_alat = $_POST['kode_alat'];
    // Insert the database record using your controller's method
$dat = $obj->addsewadetail($sewa_id, $kode_alat);
$msg = getJSON($dat);
}
$theme=setTheme();
getHeader($theme);
?>

<?php 
if($msg===true){ 
    echo '<div class="alert alert-success" style="display: block" id="message_success">Insert Data Berhasil</div>';
    echo '<meta http-equiv="refresh" content="2;url='.base_url().'sewa/detail.php?id='.$id.'">';
} elseif($msg===false) {
    echo '<div class="alert alert-danger" style="display: block" id="message_error">Insert Gagal</div>'; 
} else {

}

?>
        <div class="header icon-and-heading fs-1">
        <i class="zmdi zmdi-view-dashboard zmdi-hc-4x"></i>
            <h2><strong>sewadetail</strong> <small>Add New Data</small> </h2>
        </div>
        <hr/>
        <form name="formAdd" method="POST" action="">
            
                <div class="form-group">
                <label for="alat">Select a Alat:</label>
                <select class="form-control mb-3" name="kode_alat" id="kode_alat">
                    <option value="">Select a alat...</option>
                    <?php foreach($alat as $alat): ?>
                        <option value="<?php echo htmlspecialchars($alat['kode_alat']); ?>">
                            <?php echo htmlspecialchars($alat['kode_alat']) . ' - ' . htmlspecialchars($alat['nama']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                </div>
                
            
            <button class="save btn btn-large btn-info" type="submit">Save</button>
            <a href="#index" class="btn btn-large btn-default">Cancel</a>
        </form>

<?php
getFooter($theme,"<script src='../lib/forms.js'></script>");
?>
</body>
</html>
