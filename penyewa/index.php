<?php
include("../controllers/Penyewa.php");
include("../lib/functions.php");
$obj = new PenyewaController();

// Ambil alamat filter jika ada
$alamat_filter = isset($_GET['alamat']) ? $_GET['alamat'] : '';
$rows = $obj->getPenyewaList($alamat_filter);  // Pass alamat filter ke controller

$theme = setTheme();
getHeader($theme);
?>

<div class="header icon-and-heading">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
    <h2><strong>Penyewa</strong> <small>List Semua Data</small> </h2>
</div>
<hr style="margin-bottom:-2px;"/>

<!-- Form filter -->
<form method="get" action="">
    <div class="form-group">
        <label for="alamat">Filter berdasarkan Alamat Penyewa:</label>
        <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Masukkan alamat" value="<?php echo htmlspecialchars($alamat_filter); ?>">
    </div>
    <button type="submit" class="btn btn-primary">Filter</button>
</form>

<a style="margin:10px 0px;" class="btn btn-large btn-info" href="add.php"><i class="fa fa-plus"></i> Buat Data Baru</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>nomor_penyewa</th>
            <th>nama</th>
            <th>jk</th>
            <th>alamat</th>
            <th width="140">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($rows as $row){ ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["nomor_penyewa"]; ?></td>
            <td><?php echo $row["nama"]; ?></td>
            <td><?php echo $row["jk"]; ?></td>
            <td><?php echo $row["alamat"]; ?></td>
            <td class="text-center" width="200">
                <a class="btn btn-info btn-sm" href="edit.php?id=<?php echo $row['id']; ?>">
                    <i class="fa fa-pencil"></i>
                </a>
                <a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $row['id']; ?>">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php
getFooter($theme, "");
?>
