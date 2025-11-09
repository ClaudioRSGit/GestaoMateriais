@extends('layouts.app')

@section('title', 'Maia Materials Exchange')

@section('content')

<section id="hero" class="hero-section">
  <div class="container hero-content">
    <div class="hero-text">
      <h2>Transforme materiais excedentes em novas oportunidades</h2>
      <p>Conectamos empresas para dar nova vida a recursos que parecem sem uso, promovendo sustentabilidade e economia circular.</p>
      <a href="#sobre" class="btn-primary">Saber Mais</a>
    </div>
    <div class="hero-image">
        <img src="/environment.jpg" alt="Sustentabilidade e Reciclagem" />
    </div>
</div>
</section>

<section id="sobre" class="sobre-section">
  <h2>Porque fazemos o que fazemos</h2>
  <div class="container sobre-content">
    <div class="sobre-item">
      <div class="icon">🔄</div>
      <h3>Reduzir o desperdício industrial</h3>
      <p>Promovemos a reutilização de materiais para minimizar impactos ambientais e gerar valor.</p>
    </div>
    <div class="sobre-item">
      <div class="icon">🌱</div>
      <h3>Promover sustentabilidade</h3>
      <p>Incentivamos práticas sustentáveis que beneficiam as empresas e o planeta.</p>
    </div>
    <div class="sobre-item">
      <div class="icon">💡</div>
      <h3>Fortalecer a economia circular local</h3>
      <p>Conectamos parceiros para um ciclo de materiais mais consciente e colaborativo.</p>
    </div>
  </div>
</section>

<section id="materiais">
  <h2>
    Materiais Disponíveis
    @guest
      <a class="btn-publicar" href="{{ route('login') }}">+</a>
    @else
      <a class="btn-publicar" href="{{ route('posts.create') }}">+</a>
    @endguest
  </h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if($errors->any())
    <div class="alert alert-error">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="materiais-grid">
    @forelse($posts as $post)
      @if (!$post->is_deleted && $post->is_approved && (!$post->expires_at || $post->expires_at->isFuture()))
        <div class="material-card">
          <img
            src="{{ $post->url ?? ($post->attachment_path && isImage($post->attachment_path) ? asset('storage/' . $post->attachment_path)) }}"
            alt="{{ $post->title }}"
          />

          <h3>{{ $post->title }}</h3>

          @php
            $desc = $post->description;
            $descLimit = 100;
          @endphp

          <div class="material-desc">
            <strong>Descrição:</strong>
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

          <div class="material-contact">
            <strong>Contacto:</strong>
            @guest
              <span class="contact-tooltip">******<span class="tooltip-text">Faça login para ver o contacto</span></span>
            @else
              {{ $post->contact }}
            @endguest

            <div class="material-meta">
                <span>🕒</span>
                {{ $post->expires_at ? 'Até ' . $post->expires_at->format('d/m/Y') : 'Sem limite de data' }}
            </div>
          </div>
        </div>
      @endif
    @empty
      <p>Nenhum material disponível no momento.</p>
    @endforelse
  </div>
</section>

<section id="testemunhos">
  <h2>Testemunhos</h2>
  <p>Veja o que dizem os nossos utilizadores:</p>
  <div class="grid">
    <div class="card">
      <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Testemunho Ana" style="border-radius: 50%; width: 70px; height: 70px; object-fit: cover; margin-bottom: 1rem;">
      <p>"Uma plataforma incrível! Consegui doar materiais que não usava e ajudar outras empresas."</p>
      <p><strong>Ana, Empresa de Construção</strong></p>
    </div>
    <div class="card">
      <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Testemunho João" style="border-radius: 50%; width: 70px; height: 70px; object-fit: cover; margin-bottom: 1rem;">
      <p>"Excelente iniciativa! Encontrei materiais que precisava a um custo muito baixo."</p>
      <p><strong>João, Responsável de produção</strong></p>
    </div>
    <div class="card">
      <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Testemunho Maria" style="border-radius: 50%; width: 70px; height: 70px; object-fit: cover; margin-bottom: 1rem;">
      <p>"A MaiaXChange facilitou a partilha de recursos entre empresas locais. Recomendo!"</p>
      <p><strong>Maria, Gestora de Projetos</strong></p>
    </div>
  </div>
</section>

<section class="align-center" style="margin-bottom: 2rem;">
  <h2>Os nossos parceiros</h2>
  <div>
    <div>
      <div>
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5qZ5zcsTJhRXLUtFFOJLjnMzZAt1Mlza7yw&s" alt="Parceiro Plastrofa" />
      </div>
      <div>Plastrofa</div>
    </div>
    <div>
      <div>
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbgNz8hfRFw9HxlAfBeDOPajUQmRDaW2P0pw&s" alt="Parceiro Hansa Flex" />
      </div>
      <div>Hansa Flex</div>
    </div>
    <div>
      <div>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/be/Mota-Engil_Logo.svg/1691px-Mota-Engil_Logo.svg.png" alt="Parceiro Mota Engil" />
      </div>
      <div>Mota Engil</div>
    </div>
    <div>
      <div>
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOffz_MVTzfn7ZB8B0CJ-w3xMDCxGaokxKjw&s" alt="Parceiro UMAIA" />
      </div>
      <div>UMAIA</div>
    </div>
  </div>
</section>

<section id="contacto" class="align-center">
  <h2>Contacte-nos!</h2>
  <p>Tem dúvidas ou sugestões? Fale connosco!</p>

  <form action="{{ route('contact.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="O seu nome" required />
    <input type="email" name="email" placeholder="O seu email" required />
    <textarea name="message" rows="5" placeholder="Escreva a sua mensagem..." required></textarea>
    <button type="submit">Enviar Mensagem</button>
  </form>
</section>

@endsection

@push('scripts')
<script>
  setTimeout(() => {
    document.querySelectorAll('.alert').forEach(el => el.style.display = 'none');
  }, 3000);
</script>

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.ver-mais').forEach(function(btn) {
      btn.addEventListener('click', function() {
        const id = btn.getAttribute('data-id');
        document.querySelector('.desc-short-' + id).style.display = 'none';
        document.querySelector('.desc-full-' + id).style.display = '';
        btn.style.display = 'none';
        document.querySelector('.ver-menos[data-id="' + id + '"]').style.display = '';
      });
    });

    document.querySelectorAll('.ver-menos').forEach(function(btn) {
      btn.addEventListener('click', function() {
        const id = btn.getAttribute('data-id');
        document.querySelector('.desc-short-' + id).style.display = '';
        document.querySelector('.desc-full-' + id).style.display = 'none';
        btn.style.display = 'none';
        document.querySelector('.ver-mais[data-id="' + id + '"]').style.display = '';
      });
    });
  });
</script>
@endpush
@endpush
