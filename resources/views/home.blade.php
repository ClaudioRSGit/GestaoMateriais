@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center mb-4">
        <h2 class="mb-4">Painel de Administração</h2>
        <div class="alert alert-info">
            Total de visitas ao site: <strong>{{ $visitCount }}</strong>
        </div>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs" id="dashboardTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Anúncios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Mensagens</a>
        </li>
    </ul>

    <!-- Tab Contents -->
    <div class="tab-content mt-3" id="dashboardTabsContent">
        <!-- POSTS TAB -->
        <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
            <div class="mb-3">
                <a class="btn btn-primary" href="{{ route('posts.create') }}">Criar Novo Anúncio</a>
            </div>
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Estado</th>
                        <th>Data limite</th>
                        <th>Aprovado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td class="text-center">
                            @if ($post->is_deleted)
                                <i class="bi bi-x-circle-fill text-danger" title="Inativo"></i> Inativo
                            @else
                                <i class="bi bi-check-circle-fill text-success" title="Ativo"></i> Ativo
                            @endif
                        </td>
                        <td>{{ $post->expires_at ? $post->expires_at->format('d/m/Y') : 'Sem data limite' }}</td>
                        <td class="text-center">
                            @if ($post->is_approved)
                                <i class="bi bi-patch-check-fill text-success" title="Aprovado"></i> Aprovado
                            @else
                                <i class="bi bi-patch-exclamation-fill text-warning" title="Por Aprovar"></i> Por Aprovar
                            @endif
                        </td>
                        <td class="text-center">
                            @if (!$post->is_approved)
                                <form method="POST" action="{{ route('posts.approve', $post->id) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success" title="Aprovar">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                </form>
                            @endif

                            @if (!$post->is_deleted)
                                <form method="POST" action="{{ route('posts.destroy', $post->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Apagar">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('posts.restore', $post->id) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-warning" title="Recuperar">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- MESSAGES TAB -->
        <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Mensagem</th>
                        <th>Estado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $message)
                        <tr class="{{ $message->is_read ? '' : 'fw-bold' }}">
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->message }}</td>
                            <td class="text-center">
                                @if ($message->is_read)
                                    <i class="bi bi-envelope-open-fill text-success" title="Lida"></i> Lida
                                @else
                                    <i class="bi bi-envelope-fill text-primary" title="Por ler"></i> Por ler
                                @endif
                            </td>
                            <td class="text-center">
                                <form method="POST" action="{{ route('messages.toggle', $message->id) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-primary" title="Marcar como lida/não lida">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('messages.destroy', $message->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Apagar">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
