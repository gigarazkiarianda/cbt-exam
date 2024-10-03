<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2 class="text-center mb-4">Hasil Ujian</h2>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Nama Kategori</th>
                    <th>Skor</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($examDetails)): ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada hasil ujian yang tersedia.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($examDetails as $detail): ?>
                        <tr>
                            <td><?= esc($detail['user_id']) ?></td>
                            <td><?= esc($detail['username']) ?></td>
                            <td><?= esc($detail['category_name']) ?></td>
                            <td><?= esc($detail['score']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4 text-center">
        <a href="<?= base_url('/exam/index') ?>" class="btn btn-success btn-lg">Mulai Ujian Baru</a>
    </div>
</div>

<style>
    body {
        background-color: #f8f9fa; 
    }

    .table {
        background-color: #fff; 
        border-radius: 0.5rem; 
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
    }

    th {
        background-color: #007bff; 
        color: white; 
    }

    td {
        vertical-align: middle;
    }

    .btn-success {
        background-color: #28a745;
        color: white; 
        padding: 0.75rem 1.5rem; 
        font-size: 1.2rem; 
    }

    .btn-success:hover {
        background-color: #218838; 
        color: white; 
    }

    @media (max-width: 576px) {
        .btn-success {
            width: 100%; 
        }

        .table {
            font-size: 0.9rem;
        }
    }
</style>

<?= $this->endSection() ?>
