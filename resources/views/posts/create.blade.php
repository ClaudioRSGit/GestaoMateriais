<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Publicar Material</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
    }
    header {
      background: #005a87;
      color: white;
      text-align: center;
    }
    nav {
      background: #013e5c;
      padding: 1rem;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1rem;
      display: flex;
      justify-content: space-between;
    }
    nav a {
      color: white;
      text-decoration: none;
      font-weight: bold;
    }
    .nav-links {
      display: flex;
      gap: 1rem;
    }
    .form-container {
      background: white;
      max-width: 600px;
      margin: auto;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }
    input, textarea {
      padding: 0.8rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
    }
    @media (max-width: 600px) {
      nav {
        flex-direction: column;
        align-items: center;
      }
    }
    button {
      background: #005a87;
      color: white;
      padding: 0.8rem;
      border: none;
      border-radius: 6px;
      font-size: 1rem;
      cursor: pointer;
    }
    button:hover {
      background: #00466b;
    }
  </style>
</head>
<body>
<nav>
  <div class="nav-links">
    <a href="/">Início</a>
  </div>

</nav>
<div class="form-container" style="margin-top: 30px">
  <h2>Publicar Novo Material</h2>

  {{-- Erros de validação --}}
  @if ($errors->any())
    <div style="color:red;">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="title" placeholder="Título" value="{{ old('title') }}" required>


    <label for="attachment">Anexo (max 500MB)</label>
    <input type="file" name="attachment" class="form-control">

    <label for="duration_days">Duração do Anúncio (dias)</label>
    <input type="number" name="duration_days" class="form-control" value="7" min="1">

    <textarea name="description" placeholder="Descrição" required>{{ old('description') }}</textarea>

    <input type="text" name="contact" placeholder="Contacto (email ou telefone)" value="{{ old('contact') }}" required>

    <div style="text-align: center; margin-top: 20px; width: 100%; display: flex; justify-content: center; gap: 10px;">
      <button type="submit" style="width: 50%">Guardar</button>
      <a href="{{ url('/') }}" class="btn-danger"
        style="background:#d9534f; color:white; padding:0.8rem; border-radius:6px; text-decoration:none; display:inline-block; text-align:center; cursor:pointer; width: 50%;">Cancelar
      </a>
    </div>
    </form>
</div>

</body>
</html>
