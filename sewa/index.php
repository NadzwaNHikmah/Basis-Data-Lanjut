<?php
include("../controllers/Sewa.php");
include("../controllers/Sewadetail.php");
include("../lib/functions.php");

$obj = new SewaController();
$detail = new SewadetailController();

// Ambil semua data transaksi tanpa filter tanggal
$rows = $obj->getsewaList();

$theme = setTheme();
getHeader($theme);
?>

<div class="header icon-and-heading">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
    <h2><strong>Sewa</strong> <small>List Semua Data</small> </h2>
</div>
<hr style="margin-bottom:-2px;"/>
<a style="margin:10px 0px;" class="btn btn-large btn-info" href="add.php">
    <i class="fa fa-plus"></i> Buat Data Baru
</a>
<a style="margin:10px 0px;" class="btn btn-large btn-secondary" href="laporan.php">
    <i class="fa fa-file-alt"></i> Laporan Transaksi
</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="30">ID</th>
            <th width="50">Nomor Bukti</th>
            <th width="50">Nomor Penyewa</th>
            <th>Nama</th>
            <th width="50">Tanggal Sewa</th>
            <th width="150">Total Sewa</th>
            <th width="50">Tanggal Kembali</th>
            <th width="140">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($rows as $row) { 
            $total = $detail->countSewadetail($row['id']);
        ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["nomor_bukti"]; ?></td>
            <td><?php echo $row["nomor_penyewa"]; ?></td>
            <td><?php echo $row["nama"]; ?></td>
            <td><?php echo $row["tanggal_sewa"]; ?></td>
            <td><?php echo $total; ?></td>
            <td><?php echo $row["tanggal_kembali"]; ?></td>
            <td class="text-center" width="200">
                <?php if ($total == 0) { ?>
                    <a class="btn btn-warning btn-sm" href="edit.php?id=<?php echo $row['id']; ?>">
                        <i class="fa fa-pencil-alt"></i>
                    </a>
                    <a class="btn btn-success btn-sm" href="detail.php?id=<?php echo $row['id']; ?>">
                        <i class="fa fa-briefcase"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $row['id']; ?>">
                        <i class="fa fa-trash"></i>
                    </a>
                <?php } else { 
                    if ($row["tanggal_kembali"] == "0000-00-00") {
                        if ($row["disewa"] == 1) { ?>
                            <a class="btn btn-warning btn-sm" href="detail.php?id=<?php echo $row['id']; ?>">
                                <i class="fa fa-paper-plane"></i>
                            </a>
                        <?php } else { ?>
                            <a class="btn btn-success btn-sm" href="detail.php?id=<?php echo $row['id']; ?>">
                                <i class="fa fa-briefcase"></i>
                            </a>
                        <?php } ?>
                    <?php } else { ?>
                        <a class="btn btn-info btn-sm" href="detail.php?id=<?php echo $row['id']; ?>">
                            <i class="fa fa-eye"></i>
                        </a>
                    <?php } 
                } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php
getFooter($theme, "");
?>
