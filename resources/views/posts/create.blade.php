<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Publicar Material</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      padding: 2rem;
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

<div class="form-container">
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

  <form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <input type="text" name="title" placeholder="Título" value="{{ old('title') }}" required>
    <input type="url" name="url" placeholder="URL (opcional)" value="{{ old('url') }}">
    <textarea name="description" placeholder="Descrição" required>{{ old('description') }}</textarea>
    <input type="text" name="contact" placeholder="Contacto (email ou telefone)" value="{{ old('contact') }}" required>
    <button type="submit">Guardar</button>
  </form>
</div>

</body>
</html>
