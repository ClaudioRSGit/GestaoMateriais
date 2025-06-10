<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Publicar Material</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    :root {
      --primary: #0b626b;
      --primary-dark: #005a87;
      --accent: #F1F2DC;
      --bg-light: #ffffff;
      --text-dark: #333333;
      --radius: 10px;
      --input-radius: 6px;
      --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      background: var(--bg-light);
      color: var(--text-dark);
      line-height: 1.6;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    nav {
      background: var(--primary);
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: var(--accent);
    }

    nav a {
      color: var(--accent);
      text-decoration: none;
      font-weight: 600;
      transition: opacity 0.2s;
    }

    nav a:hover {
      opacity: 0.8;
    }

    .form-container {
      background: var(--accent);
      max-width: 600px;
      margin: 40px auto;
      padding: 2rem;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: var(--primary);
      font-size: 1.75rem;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 1.2rem;
    }

    label {
      font-weight: 600;
      margin-bottom: 0.3rem;
    }

    input, textarea, select {
      padding: 0.8rem;
      border: 1px solid #ccc;
      border-radius: var(--input-radius);
      font-size: 1rem;
      width: 100%;
      background: #fdfdfd;
      transition: border 0.2s, box-shadow 0.2s;
    }

    input:focus, textarea:focus, select:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 2px rgba(11, 98, 107, 0.2);
      outline: none;
    }

    textarea {
      min-height: 120px;
      resize: vertical;
    }

    .error-messages {
      color: #721c24;
      background: #f8d7da;
      border: 1px solid #f5c6cb;
      border-radius: var(--input-radius);
      padding: 1rem;
      margin-bottom: 1rem;
    }
    .conditional-input {
        height: 0;
        overflow: hidden;
        transition: height 0.3s ease;
        opacity: 0;
    }

    .conditional-input.active {
        height: auto;
        opacity: 1;
        margin-top: 1rem;
    }
    button, .cancel-btn {
      padding: 0.8rem 1rem;
      border-radius: var(--input-radius);
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      text-align: center;
      transition: background 0.2s;
    }

    button {
      background: var(--primary);
      color: white;
      border: none;
    }

    button:hover {
      background: var(--primary-dark);
    }

    .cancel-btn {
      background: #d9534f;
      color: white;
      text-decoration: none;
      display: inline-block;
    }

    .cancel-btn:hover {
      background: #c9302c;
    }

    .form-actions {
      display: flex;
      justify-content: space-between;
      gap: 1rem;
      margin-top: 1rem;
      width: 100%;
    }

    @media (max-width: 600px) {
      .form-actions {
        flex-direction: column;
      }
      .form-actions a,
      .form-actions button {
        width: 100%;
      }
    }
  </style>
</head>
<body>

  <nav>
    <a href="/" class="navbar-brand">MaiaXChange</a>
    <div class="nav-links">
      <a href="/">Início</a>
    </div>
  </nav>

  <div class="form-container">
    <h2>Publicar Novo Material</h2>

    {{-- Erros de validação --}}
    @if ($errors->any())
      <div class="error-messages">
        <ul class="mb-0 pl-3">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="text" name="title" placeholder="Título" value="{{ old('title') }}" required>

      <label for="type">Tipo de Conteúdo</label>
      <select name="type" id="type" required>
        <option value="attachment" {{ old('type') === 'attachment' ? 'selected' : '' }}>Anexo</option>
        <option value="url" {{ old('type') === 'url' ? 'selected' : '' }}>URL</option>
      </select>

      <div id="attachment-input" class="conditional-input active">
        <label for="attachmen   t">Anexo (max 500MB)</label>
        <input type="file" name="attachment">
      </div>

      <div id="url-input" class="conditional-input">
        <label for="url">URL</label>
        <input type="url" name="url" value="{{ old('url') }}">
      </div>

      <label for="duration_days">Duração do Anúncio (dias)</label>
      <input type="number" name="duration_days" value="7" min="1">

      <label for="description">Descrição</label>
      <textarea name="description" placeholder="Descrição" required>{{ old('description') }}</textarea>

      <label for="contact">Contacto (email ou telefone)</label>
      <input type="text" name="contact" placeholder="Contacto" value="{{ old('contact') }}" required>

      <div class="form-actions">
        <button type="submit" style="width: 50%">Guardar</button>
        <a href="{{ url('/') }}" style="width: 50%" class="cancel-btn">Cancelar</a>
      </div>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const typeSelector = document.getElementById('type');
    const attachmentInput = document.getElementById('attachment-input');
    const urlInput = document.getElementById('url-input');

    function toggleInputs() {
        if (typeSelector.value === 'attachment') {
        attachmentInput.classList.add('active');
        urlInput.classList.remove('active');
        } else {
        attachmentInput.classList.remove('active');
        urlInput.classList.add('active');
        }
    }

    typeSelector.addEventListener('change', toggleInputs);
    toggleInputs(); // chamada inicial
    });
  </script>

</body>
</html>
