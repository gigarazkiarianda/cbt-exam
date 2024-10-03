<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h2 class="mt-5">Mulai Ujian</h2>
<div id="timer" class="mb-4">Waktu: <span id="time">0:00</span></div>

<div class="alert alert-info">
    Total Soal: <?= esc($pager->getTotal()) ?> | 
    Soal Sekarang: <?= esc($pager->getCurrentPage()) ?> 
</div>

<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title"><?= esc($questions[0]['question']) ?></h5>
        <form action="<?= site_url('exam/submit/' . esc($category['id'])); ?>" method="post" id="exam-form">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="answer[<?= esc($questions[0]['id']) ?>]" value="<?= esc($questions[0]['option_a']) ?>" <?= (isset($answered[$questions[0]['id']]) && $answered[$questions[0]['id']] === esc($questions[0]['option_a'])) ? 'checked' : '' ?> required>
                <label class="form-check-label"><?= esc($questions[0]['option_a']) ?></label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="answer[<?= esc($questions[0]['id']) ?>]" value="<?= esc($questions[0]['option_b']) ?>" <?= (isset($answered[$questions[0]['id']]) && $answered[$questions[0]['id']] === esc($questions[0]['option_b'])) ? 'checked' : '' ?>>
                <label class="form-check-label"><?= esc($questions[0]['option_b']) ?></label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="answer[<?= esc($questions[0]['id']) ?>]" value="<?= esc($questions[0]['option_c']) ?>" <?= (isset($answered[$questions[0]['id']]) && $answered[$questions[0]['id']] === esc($questions[0]['option_c'])) ? 'checked' : '' ?>>
                <label class="form-check-label"><?= esc($questions[0]['option_c']) ?></label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="answer[<?= esc($questions[0]['id']) ?>]" value="<?= esc($questions[0]['option_d']) ?>" <?= (isset($answered[$questions[0]['id']]) && $answered[$questions[0]['id']] === esc($questions[0]['option_d'])) ? 'checked' : '' ?>>
                <label class="form-check-label"><?= esc($questions[0]['option_d']) ?></label>
            </div>
    </div>
</div>

<button type="submit" class="btn btn-success">Submit Ujian</button>
</form>

<div class="mt-3">
    <div class="d-flex flex-wrap justify-content-center mb-3">
        <?php for ($i = 1; $i <= esc($pager->getTotal()); $i++): ?>
            <?php 
            
                $isAnswered = isset($answered[$i]);
                $buttonClass = $isAnswered ? 'btn-success' : 'btn-outline-primary';
            ?>
            <a href="<?= base_url('/exam/navigate/' . esc($category['id']) . '/' . $i) ?>" class="btn <?= $buttonClass ?> mx-1" style="width: 40px; height: 40px;">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
</div>

<script>
    const totalQuestions = <?= esc($pager->getTotal()) ?>; 
    const totalTime = totalQuestions * 2 * 60; 

    let timerInterval;

    function startTimer(duration) {
        let timer = duration, minutes, seconds;
        timerInterval = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            document.getElementById('time').textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                clearInterval(timerInterval);
                document.getElementById('exam-form').submit(); 
            }
        }, 1000);
    }

    window.onload = function () {
        startTimer(totalTime);
    };
</script>

<style>
    .btn-success {
        background-color: #28a745; 
        color: white; 
    }

    .btn-outline-primary {
        border-color: #007bff; 
    }
</style>

<?= $this->endSection() ?>
