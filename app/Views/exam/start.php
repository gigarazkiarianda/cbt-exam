<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2 class="mt-4 text-center">Mulai Ujian: <?= esc($category['category_name']) ?></h2>
    <div id="timer" class="mb-4 text-center h5">Waktu: <span id="time" class="text-danger">0:00</span></div>

    <div class="alert alert-info text-center">
        Total Soal: <?= esc(count($questions)) ?> | 
        Soal Terjawab: <span id="answered-count"><?= esc(count($answered)) ?></span>
    </div>

    <form action="<?= site_url('exam/submit/' . esc($category['id'])); ?>" method="post" id="exam-form">
        <?php foreach ($questions as $question): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?= esc($question['question']) ?></h5>
                    <?php foreach (['option_a', 'option_b', 'option_c', 'option_d'] as $option): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answer[<?= esc($question['id']) ?>]" value="<?= esc($question[$option]) ?>" 
                                <?= (isset($answered[$question['id']]) && $answered[$question['id']] === $question[$option]) ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="answer-<?= esc($question['id']) ?>-<?= esc($option) ?>"><?= esc($question[$option]) ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <button type="submit" class="btn btn-success btn-lg btn-block">Submit Ujian</button>
    </form>

</div>

<script>
    const totalQuestions = <?= esc(count($questions)) ?>;  
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

    .btn-success:hover {
        background-color: #218838; 
        color: white; 
    }

    .alert {
        font-size: 1.1em;
    }

    #timer {
        font-size: 1.5em;
    }

    .form-check-input {
        position: relative;
        cursor: pointer;
        width: 20px; 
        height: 20px; 
        margin-right: 10px; 
    }

    .form-check-label {
        cursor: pointer;
        font-size: 1.1em; 
    }

    .form-check-input:checked {
        background-color: #28a745; 
        border-color: #28a745; 
    }

    .form-check-input:checked + .form-check-label {
        color: #28a745; 
        font-weight: bold; 
    }

    .form-check-input:focus {
        outline: none; 
    }

    .form-check-input:focus-visible {
        outline: 2px solid #28a745; 
    }

    .card-title {
        font-size: 1.2em;
    }

    .btn {
        border-radius: 0; 
    }

    @media (max-width: 768px) {
        .card-title {
            font-size: 1.1em;
        }

        .form-check-label {
            font-size: 1em; 
        }
    }
</style>

<?= $this->endSection() ?>
