<x-mainpage>
    <x-slot:title>Új Notebook</x-slot:title>
    
    <div>
        <h1>Új Notebook Hozzáadása</h1>
        <form action="{{ route('gepek.store') }}" method="POST">
            @csrf
            <div><label>Gyártó:</label><input type="text" name="gyarto" value="{{ old('gyarto') }}" required></div>
            <div><label>Típus:</label><input type="text" name="tipus" value="{{ old('tipus') }}" required></div>
            <div><label>Kijelző méret:</label><input type="number" step="0.1" name="kijelzo" value="{{ old('kijelzo') }}" required></div>
            <div><label>Memória (MiB):</label><input type="number" name="memoria" value="{{ old('memoria') }}" required></div>
            <div><label>Merevlemez (GB):</label><input type="number" name="merevlemez" value="{{ old('merevlemez') }}" required></div>
            <div><label>Videóvezérlő:</label><input type="text" name="videovezerlo" value="{{ old('videovezerlo') }}" required></div>
            <div><label>Ár:</label><input type="number" name="ar" value="{{ old('ar') }}" required></div>
            
            <div>
                <label>Processzor:</label>
                <select name="processzorid">
                    @foreach($processzorok as $proc)
                        <option value="{{ $proc->id }}">{{ $proc->gyarto }} {{ $proc->tipus }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Operációs rendszer:</label>
                <select name="oprendszerid">
                    @foreach($oprendszerek as $op)
                        <option value="{{ $op->id }}">{{ $op->nev }}</option>
                    @endforeach
                </select>
            </div>

            <div><label>Darabszám:</label><input type="number" name="db" value="{{ old('db', 1) }}" required></div>

            <div style="margin-top: 15px;">
                <a href="{{ route('gepek.index') }}">Mégse</a>
                <button type="submit" style="background: blue; color: white;">Mentés</button>
            </div>
        </form>
    </div>
</x-mainpage>