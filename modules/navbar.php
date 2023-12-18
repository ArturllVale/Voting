<?php
global $root_path;
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="<?php echo $root_path; ?>/">Vote TOP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-end" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-auto">
        <a class="nav-link" href="<?php echo $root_path; ?>/">Início</a>
        <a class="nav-link" href="<?php echo $root_path; ?>/sobre">Sobre</a>
        <a class="nav-link" href="<?php echo $root_path; ?>/pages/login.php">Painel</a>
        <a class="nav-link" href="<?php echo $root_path; ?>/pages/register.php">Nova Conta</a>
      </div>
    </div>
  </div>
</nav>