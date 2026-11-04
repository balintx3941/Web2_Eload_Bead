<x-mainpage>
    <x-slot:title>Notebook Szerkesztése</x-slot:title>
    
    <div>
        <h1>Notebook Módosítása</h1>
        <form action="{{ route('gepek.update', $gep->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div><label>Gyártó:</label><input type="text" name="gyarto" value="{{ old('gyarto', $gep->gyarto) }}" required></div>
            <div><label>Típus:</label><input type="text" name="tipus" value="{{ old('tipus', $gep->tipus) }}" required></div>
            <div><label>Kijelző:</label><input type="number" step="0.1" name="kijelzo" value="{{ old('kijelzo', $gep->kijelzo) }}" required></div>
            <div><label>Memória:</label><input type="number" name="memoria" value="{{ old('memoria', $gep->memoria) }}" required></div>
            <div><label>Merevlemez:</label><input type="number" name="merevlemez" value="{{ old('merevlemez', $gep->merevlemez) }}" required></div>
            <div><label>Videóvezérlő:</label><input type="text" name="videovezerlo" value="{{ old('videovezerlo', $gep->videovezerlo) }}" required></div>
            <div><label>Ár:</label><input type="number" name="ar" value="{{ old('ar', $gep->ar) }}" required></div>
            
            <div>
                <label>Processzor:</label>
                <select name="processzorid">
                    @foreach($processzorok as $proc)
                        <option value="{{ $proc->id }}" {{ $gep->processzorid == $proc->id ? 'selected' : '' }}>{{ $proc->gyarto }} {{ $proc->tipus }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Operációs rendszer:</label>
                <select name="oprendszerid">
                    @foreach($oprendszerek as $op)
                        <option value="{{ $op->id }}" {{ $gep->oprendszerid == $op->id ? 'selected' : '' }}>{{ $op->nev }}</option>
                    @endforeach
                </select>
            </div>

            <div><label>Darabszám:</label><input type="number" name="db" value="{{ old('db', $gep->db) }}" required></div>

            <div style="margin-top: 15px;">
                <a href="{{ route('gepek.index') }}">Mégse</a>
                <button type="submit" style="background: orange; color: white;">Módosítás</button>
            </div>
        </form>
    </div>
</x-mainpage>