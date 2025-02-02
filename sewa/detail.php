<?php
include("../controllers/Sewadetail.php");
include("../controllers/Sewa.php");
include("../lib/functions.php");
$sewa = new SewaController();
$obj = new SewadetailController();
if(isset($_GET["id"])){
    $id=$_GET["id"];
}
$msg=null;
if (isset($_POST["submitted"])==1 && $_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = true;
    
    $dat = $sewa->updateStatus($id, $status);
    $msg = getJSON($dat);
}
if (isset($_POST["kembali"])==1 && $_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = true;
    
    $dat = $sewa->updateDikembalikan($id, $status);
    $msg = getJSON($dat);
}
$baris2 = $sewa->getSewa($id);
$rows = $obj->getsewadetailList($id);
$total= $obj->countSewadetail($id);
$theme = setTheme();
getHeader($theme);
?>
<?php 
    if($msg===true){ 
        echo '<div class="alert alert-success" style="display: block" id="message_success">Update Data Berhasil</div>';
        echo '<meta http-equiv="refresh" content="2;url='.base_url().'sewa/detail.php?id='.$id.'">';
    } elseif($msg===false) {
        echo '<div class="alert alert-danger" style="display: block" id="message_error">Update Gagal</div>'; 
    } else {

    }
    
    ?>
<div class="header icon-and-heading">
<i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
<h2><strong>Sewa Detail</strong> <small>List All Data</small> </h2>
</div>
<dl class="row mt-3">
        <?php foreach ($baris2 as $baris): ?>
        
        
            <dt class="col-sm-3" style="margin-left:50px">Id:</dt><dd class="col-sm-7" style="margin-left:-150px"><?php echo $baris['id']; ?></dd>
            
            <dt class="col-sm-3" style="margin-left:50px">Nomor_bukti:</dt><dd class="col-sm-7" style="margin-left:-150px"><?php echo $baris['nomor_bukti']; ?></dd>

            <dt class="col-sm-3" style="margin-left:50px">Nomor_penyewa:</dt><dd class="col-sm-7" style="margin-left:-150px"><?php echo $baris['nomor_penyewa']; ?> - <?php echo $baris['nama']; ?></dd>

            

            <dt class="col-sm-3" style="margin-left:50px">Tanggal_sewa:</dt><dd class="col-sm-7" style="margin-left:-150px"><?php echo $baris['tanggal_sewa']; ?></dd>

            <dt class="col-sm-3" style="margin-left:50px">Tanggal_kembali:</dt><dd class="col-sm-7" style="margin-left:-150px"><?php echo $baris['tanggal_kembali']; ?></dd>

            <dt class="col-sm-3" style="margin-left:50px">Total_sewa:</dt><dd class="col-sm-7" style="margin-left:-150px"><?php echo $total; ?></dd>

            
            
            
</dl>
<?php endforeach; ?>
<hr style="margin-bottom:-4px;"/>
<?php
if($baris['disewa']==0){
    echo '<a style="margin:10px 0px;" class="btn btn-large btn-info" href="detailadd.php?id='.$id.'"><i class="fa fa-plus"></i> Tambah Data</a>';
}
?>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="30">No</th>
           
            <th width="80">kode_alat</th>
            <th>nama</th>
            <?php if($baris['disewa']==0){ ?>
            <th width="140">Action</th>
            <?php } ?>
        </tr>
    </thead>
    <thead>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i=1;
        foreach($rows as $row){ ?>
        <tr>
            <td><?php echo $i; ?></td>
            
            <td><?php echo $row["kode_alat"]; ?></td>
            <td><?php echo $row["nama"]; ?></td>
            <?php if($baris['disewa']==0){ ?>
            <td class="text-center" width="200">
            
                <a class="btn btn-danger btn-sm" href="detaildelete.php?id=<?php echo $id; ?>&iddetail=<?php echo $row['id']; ?>">
                <i class="fa fa-trash"></i></a>
            
            </td>
            <?php } ?>
        </tr>
        <?php 
        $i++;} ?>
    </tbody>
</table>
<form name="formStatus" method="POST" action="">
    <input type="hidden" class="form-control" name="submitted" value="1"/>
    <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>"/>
    <div class="d-flex justify-content-end">
    <?php
        if($baris['disewa']==0){
            echo '<button class="save btn btn-large btn-success" type="submit"><i class="fa fa-handshake"></i> Submit</button>';
        }
    ?>
        
    </div>     
</form>
<form name="formDikembalikan" method="POST" action="">
    <input type="hidden" class="form-control" name="kembali" value="1"/>
    <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>"/>
    
    <?php
        if($baris['disewa']==1 && $baris['dikembalikan']==0){
            echo '<button class="save btn btn-large btn-warning" type="submit"><i class="fa fa-calendar-check"></i> Set Dikembalikan</button>';
        }
    ?>
        
     
</form>
<?php
getFooter($theme, "");
?>
