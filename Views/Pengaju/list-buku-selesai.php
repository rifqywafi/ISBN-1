<?php 
$dataBukuSelesai = array_values($dataBukuSelesai);
$pagination = array(
	'length' => 6,
	'total' => sizeof($dataBukuSelesai),
	'currentPage' => isset($_GET['p']) ? (int) $_GET['p'] : 1,
);
$pagination['nbPages'] = ceil($pagination['total'] / $pagination['length']);
$pagination['offset'] = ($pagination['currentPage'] * $pagination['length']) - $pagination['length'];

// Paginated array
$paginated = array_slice($dataBukuSelesai, $pagination['offset'], $pagination['length'], true);
?>
<div class="container">

    <div class="row">
        <div class="my-5">
            <h2 class="display-5 fw-bolder mb-5">
            <span class="text-gradient d-inline">Buku Yang Sudah Diterbitkan</span>
            </h2>
        </div>
    </div>
    <?php if($dataBukuSelesai){?>
    <div class="row container mb-5">
        <?php foreach($paginated as $data){
        ?>    
        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="row card p-3 m-2">
                <div>
                    <p class="lead fw-light my-4">
                    <?= $data['buku_judul']?> (<?= $data['buku_tahun']?>)
                    </p>
                </div>
                <hr>
                <div>
                    <p class="text-muted">
                    Oleh : <?= $data['buku_penulis']?>
                    </p>
                </div>
                <div>
                    <a class="btn btn-success" href="database/isbn/<?=$data['buku_isbn']?>"  class="table-link" download><i class="bi bi-download me-2"></i>Download ISBN</a>
                    <a class="btn btn-primary" target="_blank" href="index.php?page=buku&act=preview&id=<?= $data['buku_id']?>&docs=<?= $data['buku_dokumen']?>" class="table-link"><i class="bi bi-eye-fill me-2"></i>Preview</a>
                </div>
            </div>
        </div>
        <?php  } ?>
    </div>
    <div class="row">
        <ul class="pagination">
            <li class="page-item"> 
                <?php
                    if($pagination['currentPage'] > 1)
                        echo '<a class="page-link" href="'.$_SERVER['REQUEST_URI'].'&p=1">First</a>';
                    else
                        echo '<a class="page-link">First</a>';
                ?>
            </li>
            <li class="page-item">
                <?php
                    if(($pagination['currentPage'] - 1) > 0)
                        echo '<a class="page-link nav-link" href="'.$_SERVER['REQUEST_URI'].'&p='.($pagination['currentPage'] - 1).'">Previous</a>';
                    else
                        echo '<a class="page-link nav-link">Previous</a>';
                ?>
            </li>
            <?php
                for($i = 1; $i <= $pagination['nbPages']; $i++) {
            ?>
            <li class="page-item" <?php echo $i == $pagination['currentPage'] ? ' class="active"' : '' ?>>
                <?php
                    if($i != $pagination['currentPage'])
                        echo '<a class="page-link nav-link" href="'.$_SERVER['REQUEST_URI'].'&p='.$i.'">'.$i.'</a>';
                    else
                        echo '<a class="page-link nav-link">'.$i.'</a>';
                ?>
            </li>
            <?php
                }
            ?>
            <li>
                <?php
                    if(($pagination['currentPage'] + 1) <= $pagination['nbPages'])
                        echo '<a class="page-link nav-link" href="'.$_SERVER['REQUEST_URI'].'&p='.($pagination['currentPage'] + 1).'">Next</a>';
                    else
                        echo '<a class="page-link nav-link">Next</a>';
                ?>
            </li>
            <li>
                <?php
                    if($pagination['currentPage'] < $pagination['nbPages'])
                        echo '<a class="page-link nav-link" href="'.$_SERVER['REQUEST_URI'].'&p='.$pagination['nbPages'].'">Last</a>';
                    else
                        echo '<a class="page-link nav-link">Last</a>';
                ?>
            </li>
        </ul>
    </div>
    <?php } else{ ?>
    <div class="row container mb-4">
        <div class="fw-bolder justify-content-center d-flex">-- Belum Ada --</div>
    </div>
    <?php } ?>
</div>
