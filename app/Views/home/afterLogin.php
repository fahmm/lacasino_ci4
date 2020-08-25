<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" aria-selected="true">Login</a>
  </div>
</nav>
<p><i>Hay </i> <?= session()->get('nama_member'); ?></p>
<a href="/landing">Daftar Pemeriksaan</a>
<br>
<a href="/landing/kartuPasien">Kartu Pasien</a>
<br>
<a href="/landing/logout">Logout</a>