<?php
include("../controllers/Sewa.php");
include("../controllers/Sewadetail.php");
include("../lib/functions.php");

$obj = new SewaController();
$detail = new SewadetailController();

$theme = setTheme();
getHeader($theme);

$rows = $obj->getSewaList(null, null);
?>

<div class="header icon-and-heading">
    <i class="zmdi zmdi-file-text zmdi-hc-4x custom-icon"></i>
    <h2><strong>Laporan Transaksi</strong></h2>
</div>
<hr/>

<button type="button" class="btn btn-success" onclick="printReport()">Cetak Laporan</button>

<table class="table table-bordered table-striped" style="margin-top: 20px;" id="reportTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nomor Bukti</th>
            <th>Nomor Penyewa</th>
            <th>Nama</th>
            <th>Tanggal Sewa</th>
            <th>Total Sewa</th>
            <th>Tanggal Kembali</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rows as $row) { ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["nomor_bukti"]; ?></td>
            <td><?php echo $row["nomor_penyewa"]; ?></td>
            <td><?php echo $row["nama"]; ?></td>
            <td><?php echo $row["tanggal_sewa"]; ?></td>
            <td><?php echo $detail->countSewadetail($row['id']); ?></td>
            <td><?php echo $row["tanggal_kembali"]; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<a href="index.php" class="btn btn-secondary">Kembali ke Daftar Sewa</a>

<script>
function printReport() {
    var printContent = document.getElementById("reportTable").outerHTML;
    var originalContent = document.body.innerHTML;
    document.body.innerHTML = "<h2>Laporan Transaksi Alat-alat Gunung</h2>" + printContent;
    window.print();
    document.body.innerHTML = originalContent;
    location.reload();
}
</script>

<?php getFooter($theme, ""); ?>
