<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">

    <div class="col-xl-12">
        <div class="row">

            <?php
            // Fungsi untuk mengambil data statistik
            function get_statistic($table_name, $label, $icon, $koneksi) {
                $query = "SELECT * FROM $table_name";
                $result = mysqli_query($koneksi, $query);
                $count = mysqli_num_rows($result);
                return [
                    'count' => $count,
                    'label' => $label,
                    'icon' => $icon
                ];
            }

            // Data statistik yang ditampilkan
            $statistics = [
                get_statistic('tb_skills', 'Ketrampilan', 'bxs-book-bookmark', $koneksi),
                get_statistic('tb_experience', 'Pengalaman', 'bxs-note', $koneksi),
                get_statistic('tb_project', 'Proyek', 'bxs-message-square-dots', $koneksi),
                get_statistic('tb_services', 'Layanan', 'bxs-message-square-dots', $koneksi),
                get_statistic('tb_education', 'Pendidikan', 'bxs-message-square-dots', $koneksi),
                get_statistic('tb_certificate', 'Sertifikat', 'bxs-message-square-dots', $koneksi),
            ];

            // Loop untuk menampilkan data statistik
            foreach ($statistics as $stat) { ?>
                <div class="col-lg-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex flex-wrap">
                                <div class="me-3">
                                    <p class="text-muted mb-2"><?= htmlspecialchars($stat['label']) ?></p>
                                    <h5 class="mb-0"><?= htmlspecialchars($stat['count']) ?></h5>
                                </div>
                                <div class="avatar-sm ms-auto">
                                    <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                        <i class="bx <?= htmlspecialchars($stat['icon']) ?>"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
    <!-- end col -->

</div>
