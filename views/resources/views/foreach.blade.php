<h1>Loop FOREACH - Arrays Associativos</h1>



@foreach ($produtos as $produto)
<p>ID: {{$produto['id']}}</p>
<p>Nome: {{$produto['nome']}}</p>
<br>
@endforeach

<hr>

@foreach ($produtos as $produto)
<p>
  ID: {{$produto['id']}} Nome: {{$produto['nome']}}
  @if ($loop->first)
    (primeiro)
  @endif
  @if ($loop->last)
    (ultimo)
  @endif

<span class="badge badge-secundary">{{$loop->index}} / {{$loop->count-1}} / {{$loop->remaining}}</span>
<span class="badge badge-secundary">{{$loop->iteration}} / {{$loop->count}}</span>
</p>
<br>


@endforeach


{{-- @forelse ($produtos as $produto)
<p>ID: {{$produto['id']}}</p>
<p>Nome: {{$produto['nome']}}</p>
<br>   
@empty
<h1>Vazio</h1>
@endforelse --}}

