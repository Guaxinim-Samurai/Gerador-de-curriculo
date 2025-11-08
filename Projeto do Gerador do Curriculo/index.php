<?php
// index.php
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Gerador de Currículo - Formulário</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
      <a class="navbar-brand" href="#">Gerador de Currículo</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="index.php">Início</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Sobre</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Ajuda</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Conteúdo principal -->
  <div class="container bg-white p-4 rounded shadow-sm">
    <h1 class="mb-3">Gerador de Currículo</h1>
    <p class="text-muted">Preencha as informações abaixo e gere seu currículo em PDF.</p>

    <form action="generate.php" method="post" id="cvForm">
      <div class="mb-4">
        <h4>Dados Pessoais</h4>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Nome</label>
            <input name="nome" type="text" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Profissão / Cargo</label>
            <input name="profissao" type="text" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label">E-mail</label>
            <input name="email" type="email" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label">Telefone</label>
            <input name="telefone" type="text" class="form-control">
          </div>
        </div>
        <label class="form-label mt-3">Resumo profissional</label>
        <textarea name="resumo" class="form-control" rows="3"></textarea>
      </div>

      <div class="mb-4">
        <h4>Experiências</h4>
        <div id="experiences"></div>
        <button type="button" class="btn btn-outline-primary mt-2" id="addExperience">+ Adicionar experiência</button>
      </div>

      <div class="mb-4">
        <h4>Formação</h4>
        <div id="educations"></div>
        <button type="button" class="btn btn-outline-primary mt-2" id="addEducation">+ Adicionar formação</button>
      </div>

      <div class="mb-4">
        <h4>Habilidades</h4>
        <label class="form-label">Digite habilidades separadas por vírgula</label>
        <input name="skills" type="text" class="form-control" placeholder="Ex: PHP, MySQL, HTML, CSS, JavaScript">
      </div>

      <div class="text-end">
        <button type="submit" class="btn btn-success">Gerar Currículo</button>
      </div>
    </form>
  </div>

  <script>
    let expIndex = 0;
    let eduIndex = 0;

    function createExperience(index) {
      const div = document.createElement('div');
      div.classList.add('border', 'p-3', 'mb-3', 'rounded');
      div.innerHTML = `
        <label class="form-label">Empresa</label>
        <input name="experiences[${index}][empresa]" class="form-control mb-2" required>
        <label class="form-label">Cargo</label>
        <input name="experiences[${index}][cargo]" class="form-control mb-2">
        <label class="form-label">Período</label>
        <input name="experiences[${index}][periodo]" class="form-control mb-2">
        <label class="form-label">Local</label>
        <input name="experiences[${index}][local]" class="form-control mb-2">
        <label class="form-label">Descrição</label>
        <textarea name="experiences[${index}][descricao]" class="form-control mb-2"></textarea>
        <button type="button" class="btn btn-danger btn-sm" onclick="this.parentElement.remove()">Remover</button>
      `;
      return div;
    }

    function createEducation(index) {
      const div = document.createElement('div');
      div.classList.add('border', 'p-3', 'mb-3', 'rounded');
      div.innerHTML = `
        <label class="form-label">Curso / Grau</label>
        <input name="educations[${index}][curso]" class="form-control mb-2" required>
        <label class="form-label">Instituição</label>
        <input name="educations[${index}][instituicao]" class="form-control mb-2">
        <label class="form-label">Período</label>
        <input name="educations[${index}][periodo]" class="form-control mb-2">
        <label class="form-label">Local</label>
        <input name="educations[${index}][local]" class="form-control mb-2">
        <button type="button" class="btn btn-danger btn-sm" onclick="this.parentElement.remove()">Remover</button>
      `;
      return div;
    }

    document.getElementById('addExperience').addEventListener('click', () => {
      document.getElementById('experiences').appendChild(createExperience(expIndex++));
    });
    document.getElementById('addEducation').addEventListener('click', () => {
      document.getElementById('educations').appendChild(createEducation(eduIndex++));
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>