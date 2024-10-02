<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="jumbotron mt-5">
    <h1 class="display-4">Welcome to the CBT Exam Platform</h1>
    <p class="lead">This is a platform where you can take exams online.</p>
    <hr class="my-4">
    <p>Click the button below to start your exam.</p>
    <a class="btn btn-primary btn-lg" href="/exam/start" role="button">Start Exam</a>
</div>
<?= $this->endSection() ?>
