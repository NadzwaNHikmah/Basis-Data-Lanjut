<?php
include("../controllers/Alat.php");
include("../lib/functions.php");

$obj = new AlatController();
$search = isset($_GET['search']) ? $_GET['search'] : ''; // Ambil parameter pencarian
$rows = $obj->getalatList($search); // Kirim parameter pencarian ke fungsi getalatList()
$theme = setTheme();
getHeader($theme);
?>

<div class="header icon-and-heading">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
    <h2><strong>Alat-Alat Gunung</strong> <small>List Semua Data</small></h2>
</div>
<hr style="margin-bottom:-2px;"/>

<!-- Form Pencarian -->
<form method="GET" action="">
    <div class="input-group" style="width: 300px; margin-bottom: 10px;">
        <input type="text" name="search" class="form-control" placeholder="Cari nama atau kode alat" value="<?php echo htmlspecialchars($search); ?>">
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </div>
</form>

<a style="margin:10px 0px;" class="btn btn-large btn-info" href="add.php">
    <i class="fa fa-plus"></i> Buat Data Baru
</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>kode_alat</th>
            <th>nama</th>
            <th>harga_sewa</th>
            <th width="140">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($rows)) { ?>
            <?php foreach($rows as $row) { ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["kode_alat"]; ?></td>
                    <td><?php echo $row["nama"]; ?></td>
                    <td><?php echo $row["harga_sewa"]; ?></td>
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
        <?php } else { ?>
            <tr>
                <td colspan="5" class="text-center">Data tidak ditemukan</td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php getFooter($theme, ""); ?>
