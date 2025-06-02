@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Painel de Administração</h2>

    <!-- Tabs -->
    <ul class="nav nav-tabs" id="dashboardTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab">Anúncios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab">Mensagens</a>
        </li>
    </ul>

    <!-- Tab Contents -->
    <div class="tab-content mt-3" id="dashboardTabsContent">
        <!-- POSTS TAB -->
        <div class="tab-pane fade show active" id="posts" role="tabpanel">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Contacto</th>
                        <th>Aprovado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->contact }}</td>
                            <td>{{ $post->is_approved ? 'Sim' : 'Não' }}</td>
                            <td>
                                @if (!$post->is_approved)
                                    <!-- Aprovar -->
                                    <form method="POST" action="{{ route('posts.approve', $post->id) }}" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-success" title="Aprovar">
                                            ✓
                                        </button>
                                    </form>
                                @endif

                                @if (!$post->is_deleted)
                                    <!-- Apagar -->
                                    <form method="POST" action="{{ route('posts.destroy', $post->id) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" title="Apagar">
                                            🗑️
                                        </button>
                                    </form>
                                @else
                                    <!-- Recuperar -->
                                    <form method="POST" action="{{ route('posts.restore', $post->id) }}" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-warning" title="Recuperar">
                                            ♻️
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
        <div class="tab-pane fade" id="messages" role="tabpanel">
            <table class="table table-bordered table-hover">
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
                        <tr class="{{ $message->is_read ? '' : 'font-weight-bold' }}">
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->message }}</td>
                            <td>{{ $message->is_read ? 'Lida' : 'Por ler' }}</td>
                            <td>
                                <!-- Toggle read -->
                                <form method="POST" action="{{ route('messages.toggle', $message->id) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-primary" title="Marcar como lida/não lida">
                                        👁
                                    </button>
                                </form>

                                <!-- Apagar -->
                                <form method="POST" action="{{ route('messages.destroy', $message->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Apagar">
                                        🗑️
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
