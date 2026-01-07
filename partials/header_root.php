<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$current = $current ?? '';
$pill = $pill ?? '';
?>
<header class="site-header">
  <div class="nav-container">
    <a class="brand" href="index.php">
      <span class="brand-mark">Discoverly</span>
      <?php if ($pill): ?><span class="brand-pill"><?= htmlspecialchars($pill) ?></span><?php endif; ?>
    </a>

    <button class="nav-toggle" type="button" aria-label="Toggle menu" aria-expanded="false">☰</button>

    <nav class="site-nav" id="siteNav">
      <a href="index.php" class="<?= $current==='home'?'is-active':'' ?>">Home</a>

      <?php if (isset($_SESSION['userID'])): ?>
        <a href="Sites/user-profile.php" class="<?= $current==='profile'?'is-active':'' ?>">My Profile</a>
        <a href="Scripts/logout.php" class="nav-cta">Logout</a>
      <?php else: ?>
        <a href="Sites/login.php" class="nav-cta">Login</a>
      <?php endif; ?>
    </nav>
  </div>
</header>
