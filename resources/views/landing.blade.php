<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Maia Materials Exchange</title>
  <style>
    /* Seu CSS original mantido */
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
  background: white; /* opcional: fundo para imagens com transparência */
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
      padding: 0.8rem 1.5rem;
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

<header>
  <h1>Maia Materials Exchange</h1>
  <p>Plataforma autónoma para partilha e aquisição de materiais excedentes industriais</p>
</header>

<nav>
  <a href="#sobre">Sobre</a>
  <a href="#materiais">Materiais</a>
  <a href="#contacto">Contacto</a>
</nav>

<section id="sobre">
  <h2>Sobre o Projeto</h2>
  <p>O Maia Materials Exchange é uma plataforma digital de reutilização industrial que permite às empresas publicar gratuitamente os seus excedentes e encontrar interessados para compra, troca ou doação. Promovemos a sustentabilidade, a redução de desperdício e a economia circular.</p>
</section>

<section id="materiais">
  <h2>Materiais Disponíveis</h2>
  <a class="btn-publicar" href="{{ route('posts.create') }}">+ Publicar Anúncio</a>

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


  <div class="grid">
    @forelse($posts as $post)
      <div class="card">
        <h3><a href="{{ $post->url }}" target="_blank" rel="noopener noreferrer">{{ $post->title }}</a></h3>
        <div class="image-container">
            <img
              src="{{ $post->url ?: 'https://assets-v2.lottiefiles.com/a/ba3f8d16-1161-11ee-9146-ff1c243cfdd2/8M5yJUdrZC.gif' }}"
              alt="{{ $post->title }}"
              onerror="this.src='https://assets-v2.lottiefiles.com/a/ba3f8d16-1161-11ee-9146-ff1c243cfdd2/8M5yJUdrZC.gif';"
            >
          </div>
        <p>{{ $post->description }}</p>
        <p><strong>Contacto:</strong> {{ $post->contact }}</p>
      </div>
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
