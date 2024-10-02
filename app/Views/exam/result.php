<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2 class="mt-5">Exam Results</h2>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $result): ?>
                <tr>
                    <td><?= esc($result['id']) ?></td>
                    <td><?= esc($result['score']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="mt-4">
       
        <a href="<?= base_url('/exam/start') ?>" class="btn btn-success">Start New Exam</a>
    </div>
</div>

<?= $this->endSection() ?>
