<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?= site_url('/exam/index') ?>">CBT Exam</a>
    <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
            <?php if (!session()->get('logged_in')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('auth/login') ?>">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('auth/register') ?>">Register</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <span class="navbar-text">
                        Halo, <?= esc(session()->get('username')) ?>!
                    </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('auth/logout') ?>">Logout</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
