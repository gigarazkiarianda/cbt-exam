<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2 class="mt-4 text-center text-primary">Selamat Datang di Ujian CBT!</h2>
    <p class="text-center text-secondary">Silakan pilih kategori ujian di bawah ini:</p>
    
    <div class="row">
        <?php foreach ($categories as $category): ?>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm border-primary">
                    <div class="card-header bg-primary text-white">
                        <h5 class="my-0 font-weight-normal"><?= esc($category['category_name']); ?></h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Ikuti ujian untuk <?= esc($category['category_name']); ?>.</p>
                        <a href="<?= site_url('exam/start/' . esc($category['id'])); ?>" class="btn btn-lg btn-block btn-success">Ambil Ujian</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>
