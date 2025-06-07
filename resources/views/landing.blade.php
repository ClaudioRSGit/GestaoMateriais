<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Maia Materials Exchange</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #f4f4f4;
      color: #333;
    }
    header {
      background: #005a87;
      color: white;
      padding: 1.5rem;
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
    section {
      padding: 2rem;
      background: white;
      margin: 2rem;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    footer {
      background: #013e5c;
      color: white;
      text-align: center;
      padding: 1rem;
    }
    .grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    }
    .card {
      background: #eaf6fb;
      padding: 1rem;
      border-radius: 8px;
      text-align: center;
    }
    .image-container {
      width: 100%;
      height: 180px;
      overflow: hidden;
      border-radius: 6px;
      margin: 0.5rem 0;
    }
    .image-container img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  object-position: center;
  display: block;
  background: white;
}
.alert {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    padding: 1rem 1.5rem;
    border-radius: 6px;
    font-weight: bold;
    z-index: 999;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    max-width: 90%;
    text-align: center;
  }

  .alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
  }

  .alert-error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
  }
    .btn-publicar {
      display: inline-block;
      background: #005a87;
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 6px;
      text-decoration: none;
      font-size: 1.1rem;
      text-align: center;
      margin-bottom: 1rem;
    }
    .btn-publicar:hover {
      background: #00466b;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      max-width: 600px;
      margin: 0 auto;
    }
    form input, form textarea {
      padding: 0.8rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
      width: 100%;
      box-sizing: border-box;
    }
    form button {
      background: #005a87;
      color: white;
      border: none;
      padding: 0.8rem;
      border-radius: 6px;
      cursor: pointer;
      font-size: 1rem;
    }
    form button:hover {
      background: #00466b;
    }
    .contact-info {
      text-align: center;
      margin-top: 2rem;
      font-size: 1.1rem;
    }
    .nav-links {
      display: flex;
      gap: 1rem;
    }
    .text-center {
      text-align: center;
    }
    @media (max-width: 600px) {
      section {
        margin: 1rem;
        padding: 1.5rem;
      }
      nav {
        flex-direction: column;
        align-items: center;
      }
    }
  </style>
</head>
<body>

<nav>
  <div class="nav-links">
    <a href="#sobre">Sobre</a>
    <a href="#materiais">Materiais</a>
    <a href="#contacto">Contacto</a>
  </div>
  <div>
    @guest
        <a href="{{ route('login') }}">Login</a>
    @else
        <a href="{{ route('home') }}">Administrador</a>
    @endguest
  </div>
</nav>

<header>

    <h1>Maia Materials Exchange</h1>
  <p>Plataforma autónoma para partilha e aquisição de materiais excedentes industriais</p>
</header>

<section id="sobre" class="text-center">
  <div>
    <img src="/environment.jpg" alt="" style="width: 100%; height: auto; max-height: 300px; object-fit:cover;">
</div>
 <h1>Sobre o Projeto</h1>
  <p>O Maia Materials Exchange é mais do que uma plataforma digital — é um movimento para transformar desperdício em valor. </p>
  <p>Aqui, empresas podem publicar gratuitamente os seus materiais excedentes e ligá-los a quem precisa, seja para troca, doação ou venda.</p>
  <p>Este projeto nasceu com um propósito:</p>
  <p>🔄 Reduzir o desperdício industrial</p>
  <p>🌱 Promover a reutilização e a sustentabilidade</p>
  <p>💡 Fortalecer a economia circular local</p>

</section>

<section id="materiais">
  <h2>Materiais Disponíveis <a class="btn-publicar" href="{{ route('posts.create') }}">+ </a></h2>


{{-- Mensagem de sucesso --}}
@if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

{{-- Mensagem de erros --}}
@if($errors->any())
  <div class="alert alert-error">
    <ul style="margin: 0; padding: 0; list-style: none;">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

    @php
    function isImage($path) {
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        return in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg']);
    }
    @endphp

  <div class="grid">
    @forelse($posts as $post)
        @if (!$post->is_deleted && $post->is_approved)
            <div class="card">
                <h3>{{ $post->title }}</a></h3>
                <p><strong>Disponivel até:</strong> {{ $post->expires_at ? $post->expires_at->format('d/m/Y') : 'Sem data limite' }}</p>
                <div class="image-container">
                    <img
                        src="{{ $post->attachment_path && isImage($post->attachment_path) ? asset('storage/' . $post->attachment_path) : 'https://static-00.iconduck.com/assets.00/document-round-icon-2048x2048-gay00wsr.png' }}"
                        alt="{{ $post->title }}"
                        onerror="this.src='https://static-00.iconduck.com/assets.00/document-round-icon-2048x2048-gay00wsr.png';"
                    />
                </div>
                <div style="margin-top: 20px">
                    <strong>Descrição</strong>
                    <p>{{ $post->description }}</p>
                </div>
                <p><strong>Contacto:</strong> {{ $post->contact }}</p>
            </div>
        @endif
    @empty
        <p>Nenhum material disponível no momento.</p>
    @endforelse
</div>

</section>

<section id="contacto">
  <h2>Contacto</h2>
  <p>Tem dúvidas ou sugestões? Fale connosco!</p>

  <form action="{{ route('contact.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="O seu nome" required>
    <input type="email" name="email" placeholder="O seu email" required>
    <textarea name="message" rows="5" placeholder="Escreva a sua mensagem..." required></textarea>
    <button type="submit">Enviar Mensagem</button>
  </form>
</section>

<footer>
  <p>&copy; 2025 Maia Materials Exchange - Desenvolvido para a economia circular</p>
</footer>
<script>
    setTimeout(() => {
      document.querySelectorAll('.alert').forEach(el => el.style.display = 'none');
    }, 3000);
  </script>
</body>
</html>
