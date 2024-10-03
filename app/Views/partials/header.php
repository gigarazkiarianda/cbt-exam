<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand text-primary font-weight-bold" href="<?= site_url('/exam/index') ?>">CBT Exam</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <?php if (!session()->get('logged_in')): ?>
                    <li class="nav-item">
                        <a class="nav-link text-success" href="<?= site_url('auth/login') ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-info" href="<?= site_url('auth/register') ?>">Register</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <span class="navbar-text text-dark">
                            Halo, <?= esc(session()->get('username')) ?>!
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="<?= site_url('auth/logout') ?>">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
