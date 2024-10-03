<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2 class="mt-5">Exam Results</h2>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Category Name</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($examDetails as $detail): ?>
                <tr>
                    <td><?= esc($detail['user_id']) ?></td>
                    <td><?= esc($detail['username']) ?></td>
                    <td><?= esc($detail['category_name']) ?></td>
                    <td><?= esc($detail['score']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="mt-4">
        <a href="<?= base_url('/exam/start') ?>" class="btn btn-success">Start New Exam</a>
    </div>
</div>

<?= $this->endSection() ?>
