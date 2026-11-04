<x-layout>
  <div class="container my-5">
    
    <!-- Vissza gomb -->
    <div class="mb-3">
      <a href="{{ url('/') }}" class="btn btn-teal-outline btn-sm">
        &larr; Vissza a főoldalra
      </a>
    </div>

    <!-- Ide rendereli le a React a teljes alkalmazást -->
    <div id="react-crud-root"></div>

  </div>

  @viteReactRefresh
  @vite(['resources/js/react/main.jsx'])
</x-layout>