<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Maia Materials Exchange</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #0b626b;
      color: #333;
    }
    header {
      background: #0b626b;
      color: white;
      padding: 1.5rem;
      text-align: center;
    }
    .card-img{
        align-items: center;
        text-align: center;
        margin-bottom: 1rem;
    }
    section {
      padding: 2rem;
      background: white;
      margin: 2rem;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    footer {
      background: #0b626b;
      color: white;
      text-align: center;
      padding: 1rem;
    }
    .grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    }
    .contact-tooltip {
  position: relative;
  cursor: help;
  display: inline-block;
  border-bottom: 1px dotted #666;
}
@media (max-width: 767.98px) {
    .navbar .navbar-brand,
    .navbar .navbar-toggler {
        display: inline-block;
        vertical-align: middle;
        float: none;
    }
    .navbar .navbar-brand {
        margin-right: 1rem;
    }
    .navbar {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }
}

.contact-tooltip .tooltip-text {
  visibility: hidden;
  width: 180px;
  background-color: #333;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 6px;
  position: absolute;
  z-index: 1;
  bottom: 125%; /* Posição acima */
  left: 50%;
  margin-left: -90px;
  opacity: 0;
  transition: opacity 0.3s;
}

.contact-tooltip:hover .tooltip-text {
  visibility: visible;
  opacity: 1;
}
    .card {
      background:#F1F2DC;
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
        background:#F1F2DC;
    }
.navbar{
    background-color: #08987F !important;
    color: #F1F2DC !important;
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
    .align-center{
        text-align: center;
        align-items: center;

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

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <a class="navbar-brand" href="#">MaiaXChange</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <!-- Left Side -->
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="#sobre">Sobre</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#materiais">Materiais</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#contacto">Contacto</a>
      </li>
    </ul>

    <!-- Right Side -->
    <ul class="navbar-nav ml-auto">
      @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
        {{-- @if (Route::has('register'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Registar</a>
          </li>
        @endif --}}
      @else
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('home') }}">Administrador</a>
            <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </li>
      @endguest
    </ul>
  </div>
</nav>

<header>

    <h1 style="color: #F1F2DC; font-size: 60px;">Maia Materials Exchange</h1>
  <p style="font-size: 20px;">Plataforma autónoma para partilha e aquisição de materiais excedentes industriais</p>
</header>

<section id="sobre" class="text-center">
  <div>
    <img src="/environment.jpg" alt="" style="width: 50%; height: 50%;  object-fit:cover;">
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
  <h2>Materiais Disponíveis
    @guest
        <a class="btn-publicar" href="{{ route('login') }}">+ </a>
    @else
        <a class="btn-publicar" href="{{ route('posts.create') }}">+ </a>
    @endguest
    </h2>

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
        @if (!$post->is_deleted && $post->is_approved && (!$post->expires_at || $post->expires_at->isFuture()))
            <div class="card">
                <h3>{{ $post->title }}</a></h3>
                <p><strong>Disponivel até:</strong> {{ $post->expires_at ? $post->expires_at->format('d/m/Y') : 'Sem data limite' }}</p>
                <div class="image-container">
                    <img
                        src="{{ $post->url ?? ($post->attachment_path && isImage($post->attachment_path) ? asset('storage/' . $post->attachment_path) : 'https://static-00.iconduck.com/assets.00/document-round-icon-2048x2048-gay00wsr.png') }}"
                        alt="{{ $post->title }}"
                        onerror="this.src='https://static-00.iconduck.com/assets.00/document-round-icon-2048x2048-gay00wsr.png';"
                    />
                </div>
                @php
                    $desc = $post->description;
                    $descLimit = 100;
                @endphp
                <div style="margin-top: 20px">
                    <strong>Descrição</strong>
                    @if(strlen($desc) > $descLimit)
                        <p>
                            <span class="desc-short-{{ $post->id }}">{{ Str::limit($desc, $descLimit) }}</span>
                            <span class="desc-full-{{ $post->id }}" style="display:none;">{{ $desc }}</span>
                            <a href="javascript:void(0);" class="ver-mais" data-id="{{ $post->id }}">ver mais</a>
                            <a href="javascript:void(0);" class="ver-menos" data-id="{{ $post->id }}" style="display:none;">ver menos</a>
                        </p>
                    @else
                        <p>{{ $desc }}</p>
                    @endif
                </div>
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.querySelectorAll('.ver-mais').forEach(function(btn) {
                        btn.addEventListener('click', function() {
                            var id = btn.getAttribute('data-id');
                            document.querySelector('.desc-short-' + id).style.display = 'none';
                            document.querySelector('.desc-full-' + id).style.display = '';
                            btn.style.display = 'none';
                            document.querySelector('.ver-menos[data-id="' + id + '"]').style.display = '';
                        });
                    });
                    document.querySelectorAll('.ver-menos').forEach(function(btn) {
                        btn.addEventListener('click', function() {
                            var id = btn.getAttribute('data-id');
                            document.querySelector('.desc-short-' + id).style.display = '';
                            document.querySelector('.desc-full-' + id).style.display = 'none';
                            btn.style.display = 'none';
                            document.querySelector('.ver-mais[data-id="' + id + '"]').style.display = '';
                        });
                    });
                });
                </script>


                    <p>
                        <strong>Contacto:</strong>
                    </p>
                    @guest
                    <span class="contact-tooltip">******<span class="tooltip-text">Faça login para ver o contacto</span></span>
                    @else
                    {{ $post->contact }}
                    @endguest


            </div>
        @endif
    @empty
        <p>Nenhum material disponível no momento.</p>
    @endforelse
</div>

</section>

<section id="testemunhos" class="align-center">
    <h2>Testemunhos</h2>
    <p>Veja o que dizem os nossos utilizadores:</p>
    <div class="grid">
        <div class="card card-img">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Testemunho Ana" style="width:80px; height:80px; border-radius:50%; object-fit:cover; margin-bottom: 1rem;">
            <p>"Uma plataforma incrível! Consegui doar materiais que não usava e ajudar outras empresas."</p>
            <p><strong>Ana, Empresa de Construção</strong></p>
        </div>
        <div class="card card-img">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Testemunho João" style="width:80px; height:80px; border-radius:50%; object-fit:cover; margin-bottom: 1rem;">
            <p>"Excelente iniciativa! Encontrei materiais que precisava a um custo muito baixo."</p>
            <p><strong>João, Responsável de produção</strong></p>
        </div>
        <div class="card card-img">
            <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Testemunho Maria" style="width:80px; height:80px; border-radius:50%; object-fit:cover; margin-bottom: 1rem;">
            <p>"A MaiaXChange facilitou a partilha de recursos entre empresas locais. Recomendo!"</p>
            <p><strong>Maria, Gestora de Projetos</strong></p>
        </div>
    </div>
</section>

<section class="align-center" style="margin-bottom: 2rem;">
    <h2>Os nossos parceiros</h2>
    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 3.5rem; margin-top: 1.5rem;">
        <div style="text-align: center;">
            <div style="width:110px; height:110px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5qZ5zcsTJhRXLUtFFOJLjnMzZAt1Mlza7yw&s" alt="Parceiro 1" style="max-width:80px; max-height:80px; object-fit: contain; border-radius: 0;">
            </div>
            <div style="margin-top: 0.8rem;">Plastrofa</div>
        </div>
        <div style="text-align: center;">
            <div style="width:110px; height:110px; margin: 0 auto;  display: flex; align-items: center; justify-content: center;">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbgNz8hfRFw9HxlAfBeDOPajUQmRDaW2P0pw&s" alt="Parceiro 2" style="max-width:80px; max-height:80px; object-fit: contain; border-radius: 0;">
            </div>
            <div style="margin-top: 0.8rem;">Hansa Flex</div>
        </div>
        <div style="text-align: center;">
            <div style="width:110px; height:110px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/be/Mota-Engil_Logo.svg/1691px-Mota-Engil_Logo.svg.png" alt="Parceiro 3" style="max-width:80px; max-height:80px; object-fit: contain; border-radius: 0;">
            </div>
            <div style="margin-top: 0.8rem;">Mota Engil</div>
        </div>
        <div style="text-align: center;">
            <div style="width:110px; height:110px; margin: 0 auto;  display: flex; align-items: center; justify-content: center;">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOffz_MVTzfn7ZB8B0CJ-w3xMDCxGaokxKjw&s" alt="Parceiro 4" style="max-width:80px; max-height:80px; object-fit: contain; border-radius: 0;">
            </div>
            <div style="margin-top: 0.8rem;">UMAIA</div>
        </div>
    </div>
</section>

<section id="contacto" class="align-center">
  <h2>Contacto</h2>
  <p>Tem dúvidas ou sugestões? Fale connosco!</p>

  <form action="{{ route('contact.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="O seu nome" required>
    <input type="email" name="email" placeholder="O seu email" required>
    <textarea name="message" rows="5" placeholder="Escreva a sua mensagem..." required></textarea>
    <button type="submit" style="background: #0b626b;">Enviar Mensagem</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
