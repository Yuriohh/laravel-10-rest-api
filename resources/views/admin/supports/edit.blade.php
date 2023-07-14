<h1>Editar Dúvida</h1>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif

<form action="{{ route('supports.update', $support->id) }}" method="POST">
    @csrf()
    @method('PUT')
    <input type="text" name="subject" placeholder="assunto" value="{{ $support->subject }}">
    <textarea name="body" cols="30" rows="10">{{ $support->body }}</textarea>
    <button type="submit">Enviar</button>
</form>