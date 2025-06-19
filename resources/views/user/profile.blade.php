@extends('layouts.app')

@section('content')
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f7f9fa;
      color: #333;
      min-height: 100vh;
    }
    header {
      background: #0b626b;
      color: white;
      padding: 1.5rem;
      text-align: center;
    }
    .container {
      max-width: 900px;
      margin: 2rem auto;
      background: white;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 0 12px rgba(0,0,0,0.1);
    }
    h1, h2 {
      color: #0b626b;
      margin-bottom: 1rem;
    }
    .user-info {
      margin-bottom: 2rem;
    }
    .user-info p {
      font-size: 1.1rem;
      margin: 0.3rem 0;
    }
    table {
      width: 100%;
    }
    table thead {
      background-color: #08987F;
      color: #F1F2DC;
    }
    table th, table td {
      padding: 0.75rem;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    .no-posts {
      text-align: center;
      font-style: italic;
      color: #777;
      margin-top: 1rem;
    }
    .btn-back {
      background-color: #0b626b;
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 6px;
      text-decoration: none;
      margin-bottom: 1.5rem;
      display: inline-block;
    }
    .btn-back:hover {
      background-color: #094d52;
      color: white;
      text-decoration: none;
    }
  </style>

  <header>
    <h1 style="color: #F1F2DC; font-size: 40px;">Perfil do Utilizador</h1>
  </header>

  <div class="container">
    <h2>Bem-vindo, {{ $user->name }}</h2>

    <section class="user-info">
      <h3>Informações Pessoais</h3>
      <p><strong>Nome:</strong> {{ $user->name }}</p>
      <p><strong>Email:</strong> {{ $user->email }}</p>
      <p><strong>Registado a:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
      <p><strong>Função:</strong> {{ ucfirst($user->role) }}</p>
    </section>

    <section>
      <h3>Os meus Anúncios ({{ $posts->count() }})</h3>
      @if ($posts->isEmpty())
        <p class="no-posts">Você ainda não publicou nenhum anúncio.</p>
      @else
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Título</th>
              <th>Descrição</th>
              <th>Data de Criação</th>
              <th>Disponível até</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $post)
              <tr>
                <td>{{ $post->title }}</td>
                <td>{{ Str::limit($post->description, 50) }}</td>
                <td>{{ $post->created_at->format('d/m/Y') }}</td>
                <td>{{ $post->expires_at ? $post->expires_at->format('d/m/Y') : 'Sem limite' }}</td>
                <td>
                  @if($post->is_deleted)
                    <span class="text-danger">Removido</span>
                  @elseif(!$post->is_approved)
                    <span class="text-danger">Pendente</span>
                  @else
                    <span class="text-success">Ativo</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </section>
  </div>
@endsection
