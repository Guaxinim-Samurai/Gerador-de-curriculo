<?php
// generate.php
function h($s){ return htmlspecialchars(trim($s), ENT_QUOTES, 'UTF-8'); }

$nome = $_POST['nome'] ?? '';
$profissao = $_POST['profissao'] ?? '';
$email = $_POST['email'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$resumo = nl2br(h($_POST['resumo'] ?? ''));
$skills = array_filter(array_map('trim', explode(',', $_POST['skills'] ?? '')));
$experiences = $_POST['experiences'] ?? [];
$educations = $_POST['educations'] ?? [];
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Currículo - <?=h($nome)?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>
<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
      <a class="navbar-brand" href="index.php">Gerador de Currículo</a>
    </div>
  </nav>

  <div class="container">
    <div class="text-end mb-3">
      <a href="index.php" class="btn btn-secondary">Voltar</a>
      <button onclick="window.print()" class="btn btn-primary">Imprimir</button>
      <button id="downloadPdf" class="btn btn-success">Baixar Currículo (JS)</button>
    </div>

    <div id="cvContent" class="bg-white p-4 rounded shadow-sm">
      <header class="mb-3 border-bottom pb-2">
        <h2><?=h($nome)?></h2>
        <p class="text-muted"><?=h($profissao)?> | <?=h($email)?> | <?=h($telefone)?></p>
      </header>

      <?php if($resumo): ?>
      <section class="mb-3">
        <h4>Resumo</h4>
        <p><?=$resumo?></p>
      </section>
      <?php endif; ?>

      <?php if($experiences): ?>
      <section class="mb-3">
        <h4>Experiência Profissional</h4>
        <?php foreach($experiences as $e): ?>
          <div class="mb-2">
            <strong><?=h($e['cargo'] ?? '')?></strong> - <?=h($e['empresa'] ?? '')?><br>
            <small><?=h($e['periodo'] ?? '')?> <?=h($e['local'] ?? '')?></small>
            <p><?=nl2br(h($e['descricao'] ?? ''))?></p>
          </div>
        <?php endforeach; ?>
      </section>
      <?php endif; ?>

      <?php if($educations): ?>
      <section class="mb-3">
        <h4>Formação</h4>
        <?php foreach($educations as $edu): ?>
          <div class="mb-2">
            <strong><?=h($edu['curso'] ?? '')?></strong> - <?=h($edu['instituicao'] ?? '')?><br>
            <small><?=h($edu['periodo'] ?? '')?> <?=h($edu['local'] ?? '')?></small>
          </div>
        <?php endforeach; ?>
      </section>
      <?php endif; ?>

      <?php if($skills): ?>
      <section>
        <h4>Habilidades</h4>
        <?php foreach($skills as $s): ?>
          <span class="badge bg-secondary me-1 mb-1"><?=h($s)?></span>
        <?php endforeach; ?>
      </section>
      <?php endif; ?>
    </div>
  </div>

  <script>
    document.getElementById('downloadPdf').addEventListener('click', () => {
      const element = document.getElementById('cvContent');
      html2pdf().from(element).set({
        margin: 10,
        filename: 'curriculo.pdf',
        html2canvas: { scale: 2 },
        jsPDF: { orientation: 'portrait', unit: 'mm', format: 'a4' }
      }).save();
    });
  </script>
</body>
</html>