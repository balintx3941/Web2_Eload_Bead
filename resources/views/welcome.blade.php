<x-layout>
  <div class="container my-5">

    <!-- 1. SZEKCIÓ: HERO KÁRTYA -->
    <div class="rentiz-card p-4 p-lg-5 mb-5 shadow-lg">
      <div class="row align-items-center g-4">
        
        <!-- Bal oszlop -->
        <div class="col-lg-7">
          <div class="d-inline-block text-white fw-semibold small px-3 py-1 rounded-2 mb-3" style="background-color: var(--teal-primary); font-size: 0.8rem;">
            Web-programozás II. – Projektmunka
          </div>

          <h1 class="display-5 fw-bold text-white mb-2" style="line-height: 1.15; letter-spacing: -0.5px;">
            Laptop &amp; Hardver<br>
            <span style="color: var(--teal-light);">Nyilvántartó Rendszer</span>
          </h1>

          <p class="mt-3 mb-4" style="color: var(--text-muted); line-height: 1.6; max-width: 530px; font-size: 0.98rem;">
            Üdvözöljük a LaptopDB felületén! Alkalmazásunk modern notebookok, processzor-architektúrák és operációs rendszerek strukturált, 3 táblás adatbázis-katalogizálását és vizuális elemzését valósítja meg.
          </p>

          <div class="d-flex flex-wrap gap-3">
            <a href="{{ url('/teszt') }}" class="btn btn-teal d-inline-flex align-items-center gap-2">
              <span>🧮</span> Kalkulátor indítása
            </a>
            
            <a href="{{ url('/react') }}" class="btn btn-teal-outline d-inline-flex align-items-center gap-2">
              <span>⚖️</span> Laptop Összehasonlító (React)
            </a>
          </div>
        </div>

        <!-- Jobb oszlop: Pontos lila neon laptop fotó -->
        <div class="col-lg-5 text-center">
          <img src="https://i.scdn.co/image/ab6775700000ee851183b0fc756b20a07b7d15b5" 
               alt="Laptop & Hardver Rendszer" 
               class="img-fluid rounded-4 shadow-lg" 
               style="max-height: 330px; width: 100%; object-fit: cover; border: 1px solid rgba(255,255,255,0.06);">
        </div>

      </div>
    </div>


    <!-- 2. SZEKCIÓ: KATALOGIZÁLT LAPTOP KATEGÓRIÁK -->
    <div class="d-flex justify-content-between align-items-end mb-4">
      <div>
        <h3 class="fw-bold text-white mb-1" style="letter-spacing: -0.3px;">Katalogizált Laptop Kategóriák</h3>
        <p class="small mb-0" style="color: var(--text-muted);">
          A rendszerünkben nyilvántartott főbb hardverprofilok és konfigurációk
        </p>
      </div>
      <a href="{{ url('/react') }}" class="text-decoration-none fw-semibold small" style="color: var(--teal-light);">
        Összes gép listázása &rarr;
      </a>
    </div>

    <div class="row g-4 mb-5">
      
      <!-- Kártya 1: Üzleti széria -->
      <div class="col-md-4">
        <div class="rentiz-card h-100 overflow-hidden d-flex flex-column">
          <div style="height: 185px; overflow: hidden;">
            <img src="https://cdn.mos.cms.futurecdn.net/48MNXEuwtScbho3Sd4KatR.jpg" 
                 class="w-100 h-100" style="object-fit: cover;" alt="Üzleti & Ultrabook">
          </div>
          <div class="p-4 d-flex flex-column flex-grow-1">
            <div class="d-flex gap-2 mb-3">
              <span class="category-tag">Intel Core i5 / i7</span>
              <span class="category-tag">Windows 11 Pro</span>
            </div>
            <h5 class="fw-bold text-white mb-2">Üzleti &amp; Ultrabook Széria</h5>
            <p class="small mb-0 flex-grow-1" style="color: var(--text-muted); line-height: 1.55;">
              Könnyű, hosszú üzemidejű Dell, HP és Lenovo konfigurációk irodai munkára, SSD meghajtóval és alacsony fogyasztású processzorokkal.
            </p>
          </div>
        </div>
      </div>

      <!-- Kártya 2: Gamer gépek -->
      <div class="col-md-4">
        <div class="rentiz-card h-100 overflow-hidden d-flex flex-column">
          <div style="height: 185px; overflow: hidden;">
            <img src="https://images.unsplash.com/photo-1587614382346-4ec70e388b28?auto=format&fit=crop&w=600&q=80" 
                 class="w-100 h-100" style="object-fit: cover;" alt="Gamer & Workstation">
          </div>
          <div class="p-4 d-flex flex-column flex-grow-1">
            <div class="d-flex gap-2 mb-3">
              <span class="category-tag">AMD Ryzen 7 / i9</span>
              <span class="category-tag">Dedikált GPU</span>
            </div>
            <h5 class="fw-bold text-white mb-2">Gamer &amp; Workstation Gépek</h5>
            <p class="small mb-0 flex-grow-1" style="color: var(--text-muted); line-height: 1.55;">
              Nagy számítási teljesítményű ASUS ROG, MSI és Acer Predator modellek 3D tervezéshez, fejlesztéshez és modern játékokhoz.
            </p>
          </div>
        </div>
      </div>

      <!-- Kártya 3: Multimédiás gépek -->
      <div class="col-md-4">
        <div class="rentiz-card h-100 overflow-hidden d-flex flex-column">
          <div style="height: 185px; overflow: hidden;">
            <img src="https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?auto=format&fit=crop&w=600&q=80" 
                 class="w-100 h-100" style="object-fit: cover;" alt="Oktatási & Multimédia">
          </div>
          <div class="p-4 d-flex flex-column flex-grow-1">
            <div class="d-flex gap-2 mb-3">
              <span class="category-tag">14" - 15.6" FHD</span>
              <span class="category-tag">Linux / Windows</span>
            </div>
            <h5 class="fw-bold text-white mb-2">Oktatási &amp; Multimédiás Modellek</h5>
            <p class="small mb-0 flex-grow-1" style="color: var(--text-muted); line-height: 1.55;">
              Kiváló ár-érték arányú mindennapi laptopok egyetemi tanulmányokhoz, programozáshoz és otthoni multimédiás felhasználásra.
            </p>
          </div>
        </div>
      </div>

    </div>


    <!-- 3. SZEKCIÓ: A RENDSZER FELÉPÍTÉSE ÉS MODULJAI -->
    <h3 class="fw-bold text-white mb-4" style="letter-spacing: -0.3px;">A Rendszer Felépítése és Moduljai</h3>

    <div class="row g-4 mb-4">
      
      <!-- Modul 1: Adatbázis -->
      <div class="col-md-4">
        <div class="rentiz-card p-4 h-100">
          <div class="mb-3">
            <i class="bi bi-diagram-3 text-white" style="font-size: 2rem;"></i>
          </div>
          <h5 class="fw-bold text-white mb-3">3 Táblás Adatbázis &amp; ORM</h5>
          <p class="small mb-0" style="color: var(--text-muted); line-height: 1.6;">
            Relációsan összekapcsolt Gépek (Laptopok), Processzorok és Operációs rendszerek adattáblák Eloquent ORM modellekkel és automatikus Seeding feltöltéssel.
          </p>
        </div>
      </div>

      <!-- Modul 2: Diagram -->
      <div class="col-md-4">
        <div class="rentiz-card p-4 h-100">
          <div class="mb-3">
            <i class="bi bi-pie-chart text-white" style="font-size: 2rem;"></i>
          </div>
          <h5 class="fw-bold text-white mb-3">Chart.js Vizualizáció</h5>
          <p class="small mb-0" style="color: var(--text-muted); line-height: 1.6;">
            Az adatbázisban tárolt laptopok gyártói és operációs rendszer szerinti megoszlását élő, interaktív diagramok szemléltetik a Diagram menüpont alatt.
          </p>
        </div>
      </div>

      <!-- Modul 3: Jogosultság -->
      <div class="col-md-4">
        <div class="rentiz-card p-4 h-100">
          <div class="mb-3">
            <i class="bi bi-shield-lock text-white" style="font-size: 2rem;"></i>
          </div>
          <h5 class="fw-bold text-white mb-3">Jogosultság &amp; Üzenetküldés</h5>
          <p class="small mb-0" style="color: var(--text-muted); line-height: 1.6;">
            Szerveroldali validációval védett Kapcsolat űrlap, bejelentkezett felhasználóknak időrendi Üzenetek táblázat, Adminoknak pedig teljes CRUD adatkezelő.
          </p>
        </div>
      </div>

    </div>

  </div>
</x-layout>
