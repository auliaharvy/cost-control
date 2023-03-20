<html>

<style>
    table.groove {
        border-style: groove;
    }
</style>

<head>
    <title>Report Project <?php echo $project_name; ?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/printer.css">
</head>

<body>
    <h2 align="center">Report Project <?php echo $project_name; ?></h2>
    <hr />
    <h3 align="left">Rap Project</h3>
    <table border="1" style="width : 100%;" cellspacing="0" cellpadding="5">
        <thead style="font-size: large; background-color:gold;">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Kategori</th>
                <th class="text-center">Nama Pekerjaan</th>
                <th class="text-center">Jumlah RAP</th>
                <th class="text-center">Jumlah Aktual</th>
                <th class="text-center">Persentase</th>
                <th class="text-center">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (is_array($data_rap_biaya) || is_object($data_rap_biaya)) {
                $nomor = 1;
                foreach ($data_rap_biaya as $d) {
                    $id = $d['id']; ?>
                    <tr class="odd gradeX">
                        <td style="width: 2%; vertical-align:middle;" class="text-center"><?php echo $nomor++; ?></td>
                        <td style="width: 23%;" class="text over"><?php echo $d['nama_kategori']; ?></span></td>
                        <td style="width: 20%;" class="text over"><?php echo $d['nama_pekerjaan']; ?></span></td>
                        <td style="width: 10%;" class="text text-center size">Rp <?php echo $d['jumlah_biaya_v']; ?></span></td>
                        <td style="width: 10%;" class="text text-center size">Rp <?php echo $d['jumlah_aktual_v']; ?></span></td>
                        <td style="width: 10%;" class="text text-center size"><?php echo $d['presentase']; ?> %</span></td>
                        <td style="width: 20%;" class="text over"><?php echo $d['note']; ?></span></td>
                    </tr>
            <?php
                }
            } ?>
        </tbody>
    </table><br>
    <h3 align="left">Pembelian Project</h3>
    <table style="width: 100%;" border="1" cellspacing="0" cellpadding="5">
        <thead style="font-size: large; background-color:gold;">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Jumlah Pembelian</th>
                <th class="text-center">Kategori</th>
                <th class="text-center">Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $nomor = 1;
            foreach ($data_uang as $d) {
                $id = $d['id']; ?>
                <tr class="odd gradeX">
                    <td style="width: 2%; vertical-align:middle;" class="text-center"><?php echo $nomor++; ?></td>
                    <td style="width: 15%;" class="text size"><span><?php echo $d['created_at']; ?></td>
                    <td style="width: 23%;" class="text over"><span><?php echo $d['keterangan']; ?></td>
                    <?php if ($d['jumlah_pembelian_v'] == null) { ?>
                        <td style="width: 25%;" class="text text-center size"><span>Rp. 0</span></td>
                    <?php } else { ?>
                        <td style="width: 25%;" class="text text-center size"><span>Rp. <?php echo $d['jumlah_pembelian_v']; ?></span></td>
                    <?php } ?>
                    <td style="width: 10%;" class="text over"><span><?php echo $d['nama_kategori']; ?></td>
                    <td style="width: 25%;" class="text over"><a href="<?php echo base_url('/upload/pembelian/' . $d['upload_file']); ?>" target="_blank">
                            <img src="<?php echo base_url('/upload/pembelian/' . $d['upload_file']); ?>" height="125px;" width="80px;" /></a></td>
                </tr>
            <?php
            } ?>
        </tbody>
    </table>
    <script>
        window.print();
    </script>

</body>
<style>
    .over {
        white-space: normal;
        overflow: visible;
        word-wrap: break-word;
        font-size: 17px;
    }

    .size {
        font-size: 17px;
    }
</style>

</html>