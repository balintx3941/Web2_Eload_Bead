<x-mainpage>
    <x-slot:title>Notebook Lista</x-slot:title>
    
    <div>
        <h1>Felújított Notebookok Raktáron</h1>

        @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('gepek.create') }}" style="background: green; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; display: inline-block; margin-bottom: 10px;">Új notebook felvétele</a>
        @endif

        @if(session('success'))
            <div style="color: green; margin: 10px 0;">{{ session('success') }}</div>
        @endif
        @if(session('failed'))
            <div style="color: red; margin: 10px 0;">{{ session('failed') }}</div>
        @endif

        <table border="1" cellpadding="8" style="width: 100%; margin-top: 15px; border-collapse: collapse;">
            <thead>
                <tr style="background: #f2f2f2;">
                    <th>ID</th>
                    <th>Gyártó / Típus</th>
                    <th>Kijelző</th>
                    <th>Memória</th>
                    <th>HDD</th>
                    <th>Ár</th>
                    <th>Mennyiség</th>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <th>Műveletek</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($gepek as $gep)
                <tr>
                    <td>{{ $gep->id }}</td>
                    <td>{{ $gep->gyarto }} {{ $gep->tipus }}</td>
                    <td>{{ $gep->kijelzo }}"</td>
                    <td>{{ $gep->memoria }} MiB</td>
                    <td>{{ $gep->merevlemez }} GB</td>
                    <td>{{ $gep->ar }} Ft</td>
                    <td>{{ $gep->db }} db</td>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <td>
                            <a href="{{ route('gepek.edit', $gep->id) }}">Szerkesztés</a>
                            <form action="{{ route('gepek.destroy', $gep->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Biztosan törlöd?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: red; color: white; border: none; cursor: pointer; padding: 2px 6px;">Törlés</button>
                            </form>
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-mainpage>