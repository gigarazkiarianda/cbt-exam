<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h2 class="mt-5">Start Exam</h2>
<div id="timer" class="mb-4">Waktu: <span id="time">0:00</span></div>

<!-- Menampilkan jumlah soal yang ada -->
<div class="alert alert-info">
    Total Soal: <?= esc($pager->getTotal()) ?> | 
    Soal Sekarang: <?= esc($pager->getCurrentPage()) ?> 
</div>

<!-- Card untuk menampilkan pertanyaan -->
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title"><?= esc($questions[0]['question']) ?></h5>
        <form action="/exam/submit" method="post" id="exam-form">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="answer[<?= esc($questions[0]['id']) ?>]" value="A" <?= (isset($answered[$questions[0]['id']]) && $answered[$questions[0]['id']] === 'A') ? 'checked' : '' ?> required>
                <label class="form-check-label"><?= esc($questions[0]['option_a']) ?></label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="answer[<?= esc($questions[0]['id']) ?>]" value="B" <?= (isset($answered[$questions[0]['id']]) && $answered[$questions[0]['id']] === 'B') ? 'checked' : '' ?>>
                <label class="form-check-label"><?= esc($questions[0]['option_b']) ?></label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="answer[<?= esc($questions[0]['id']) ?>]" value="C" <?= (isset($answered[$questions[0]['id']]) && $answered[$questions[0]['id']] === 'C') ? 'checked' : '' ?>>
                <label class="form-check-label"><?= esc($questions[0]['option_c']) ?></label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="answer[<?= esc($questions[0]['id']) ?>]" value="D" <?= (isset($answered[$questions[0]['id']]) && $answered[$questions[0]['id']] === 'D') ? 'checked' : '' ?>>
                <label class="form-check-label"><?= esc($questions[0]['option_d']) ?></label>
            </div>
    </div>
</div>

<button type="submit" class="btn btn-success">Submit Exam</button>
</form>

<div class="mt-3">
    <!-- Kotak menu soal -->
    <div class="d-flex flex-wrap justify-content-center mb-3">
        <?php for ($i = 1; $i <= esc($pager->getTotal()); $i++): ?>
            <?php 
                
                $isAnswered = isset($answered[$i]);
               
                $buttonClass = $isAnswered ? 'btn-success' : 'btn-outline-primary';
            ?>
            <a href="<?= base_url('/exam/navigate/' . $i) ?>" class="btn <?= $buttonClass ?> mx-1" style="width: 40px; height: 40px;">
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
