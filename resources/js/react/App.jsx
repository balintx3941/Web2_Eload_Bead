import React, { useState, useEffect, useMemo } from 'react';
import axios from 'axios';

// Megbízható magyar forint formázó (pl. 8 800 Ft)
const formatFt = (num) => {
    return String(Math.round(Number(num) || 0)).replace(/\B(?=(\d{3})+(?!\d))/g, " ") + " Ft";
};

export default function App() {
    const [gepek, setGepek] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    const [gepAId, setGepAId] = useState('');
    const [gepBId, setGepBId] = useState('');

    useEffect(() => {
        axios.get('/api/gepek')
            .then(res => {
                const data = Array.isArray(res.data) ? res.data : [];
                setGepek(data);
                if (data.length >= 2) {
                    setGepAId(data[0].id);
                    setGepBId(data[1].id);
                } else if (data.length === 1) {
                    setGepAId(data[0].id);
                }
                setLoading(false);
            })
            .catch(err => {
                setError('Nem sikerült betölteni a gépek adatait az API-ról.');
                setLoading(false);
            });
    }, []);

    const gepA = useMemo(() => gepek.find(g => String(g.id) === String(gepAId)) || null, [gepek, gepAId]);
    const gepB = useMemo(() => gepek.find(g => String(g.id) === String(gepBId)) || null, [gepek, gepBId]);

    const swapGepek = () => {
        const temp = gepAId;
        setGepAId(gepBId);
        setGepBId(temp);
    };

    const randomCompare = () => {
        if (gepek.length < 2) return;
        const idxA = Math.floor(Math.random() * gepek.length);
        let idxB = Math.floor(Math.random() * gepek.length);
        while (idxB === idxA && gepek.length > 1) {
            idxB = Math.floor(Math.random() * gepek.length);
        }
        setGepAId(gepek[idxA].id);
        setGepBId(gepek[idxB].id);
    };

    const getWinStatus = (valA, valB, higherIsBetter = true) => {
        const numA = Number(valA) || 0;
        const numB = Number(valB) || 0;
        if (numA === numB) return { aWin: false, bWin: false, draw: true };
        if (higherIsBetter) {
            return { aWin: numA > numB, bWin: numB > numA, draw: false };
        } else {
            return { aWin: numA < numB, bWin: numB < numA, draw: false };
        }
    };

    if (loading) {
        return (
            <div className="text-center py-5">
                <div className="spinner-border text-teal mb-3" style={{ color: '#14b8a6' }} role="status"></div>
                <p className="small mb-0" style={{ color: '#94a3b8' }}>Gépek betöltése az adatbázisból...</p>
            </div>
        );
    }

    if (error) {
        return (
            <div className="alert alert-danger py-3">
                <i className="bi bi-exclamation-triangle-fill me-2"></i> {error}
            </div>
        );
    }

    const priceDiff = gepA && gepB ? Math.abs(Number(gepA.ar) - Number(gepB.ar)) : 0;
    const cheaperName = gepA && gepB ? (Number(gepA.ar) < Number(gepB.ar) ? (gepA.tipus || gepA.modell) : (gepB.tipus || gepB.modell)) : '';

    return (
        <div>
            {/* Fejléc és vezérlőgombok */}
            <div className="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h2 className="fw-bold text-white mb-1">
                        <span style={{ color: '#2dd4bf' }}>⚖️</span> Laptop Összehasonlító
                    </h2>
                    <p className="small mb-0" style={{ color: '#94a3b8' }}>
                        Reaktív, kliensoldali specifikáció- és árelemző modul (React SPA)
                    </p>
                </div>
                <div className="d-flex gap-2">
                    <button onClick={randomCompare} className="btn btn-teal-outline btn-sm">
                        🎲 Véletlenszerű pár
                    </button>
                    <button onClick={swapGepek} className="btn btn-teal btn-sm">
                        🔄 Csere (A ↔ B)
                    </button>
                </div>
            </div>

            {/* Kiválasztó kártya */}
            <div className="rentiz-card p-4 shadow-lg mb-4" style={{ backgroundColor: '#151e2e', border: '1px solid #1e2c42' }}>
                <div className="row g-4 align-items-center">
                    <div className="col-md-5">
                        <label className="form-label small fw-semibold" style={{ color: '#2dd4bf' }}>
                            🔵 "A" Gép kiválasztása:
                        </label>
                        <select
                            className="form-select text-white"
                            value={gepAId}
                            onChange={(e) => setGepAId(e.target.value)}
                            style={{ backgroundColor: '#0c131f', border: '1px solid #23334d', borderRadius: '8px' }}
                        >
                            {gepek.map(g => (
                                <option key={g.id} value={g.id}>
                                    #{g.id} - {g.gyarto} {g.tipus || g.modell} ({formatFt(g.ar)})
                                </option>
                            ))}
                        </select>
                    </div>

                    <div className="col-md-2 text-center fw-bold fs-5">
                        <span className="badge rounded-circle p-3" style={{ backgroundColor: '#0d141f', border: '1px solid #202d3f', color: '#14b8a6' }}>
                            VS
                        </span>
                    </div>

                    <div className="col-md-5">
                        <label className="form-label small fw-semibold" style={{ color: '#38bdf8' }}>
                            🟣 "B" Gép kiválasztása:
                        </label>
                        <select
                            className="form-select text-white"
                            value={gepBId}
                            onChange={(e) => setGepBId(e.target.value)}
                            style={{ backgroundColor: '#0c131f', border: '1px solid #23334d', borderRadius: '8px' }}
                        >
                            {gepek.map(g => (
                                <option key={g.id} value={g.id}>
                                    #{g.id} - {g.gyarto} {g.tipus || g.modell} ({formatFt(g.ar)})
                                </option>
                            ))}
                        </select>
                    </div>
                </div>
            </div>

            {/* Két gép kártyás összegző */}
            {gepA && gepB && (
                <>
                    <div className="row g-4 mb-4">
                        {/* Gép A kártya */}
                        <div className="col-md-6">
                            <div className="p-4 rounded-4 shadow-lg h-100 position-relative" style={{ backgroundColor: '#151e2e', border: '2px solid rgba(45, 212, 191, 0.4)' }}>
                                <span className="badge position-absolute top-0 end-0 m-3" style={{ backgroundColor: '#12222d', border: '1px solid #14b8a6', color: '#2dd4bf' }}>
                                    "A" Gép
                                </span>
                                <span className="small text-uppercase fw-bold" style={{ color: '#94a3b8' }}>{gepA.gyarto}</span>
                                <h4 className="fw-bold text-white mb-2">{gepA.tipus || gepA.modell}</h4>
                                <div className="display-6 fw-bold mb-3" style={{ color: '#2dd4bf' }}>
                                    {formatFt(gepA.ar)}
                                </div>
                                <div className="d-flex flex-wrap gap-2">
                                    <span className="badge bg-dark border border-secondary text-light">
                                        📺 {gepA.kijelzo}" kijelző
                                    </span>
                                    <span className="badge bg-dark border border-secondary text-light">
                                        🧠 {gepA.memoria} MB RAM
                                    </span>
                                    <span className="badge bg-dark border border-secondary text-light">
                                        💾 {gepA.merevlemez} GB Tárhely
                                    </span>
                                    <span className={`badge ${gepA.db > 0 ? 'bg-success bg-opacity-25 text-success border border-success' : 'bg-danger bg-opacity-25 text-danger border border-danger'}`}>
                                        📦 Készlet: {gepA.db} db
                                    </span>
                                </div>
                            </div>
                        </div>

                        {/* Gép B kártya */}
                        <div className="col-md-6">
                            <div className="p-4 rounded-4 shadow-lg h-100 position-relative" style={{ backgroundColor: '#151e2e', border: '2px solid rgba(56, 189, 248, 0.4)' }}>
                                <span className="badge position-absolute top-0 end-0 m-3" style={{ backgroundColor: '#0f172a', border: '1px solid #38bdf8', color: '#38bdf8' }}>
                                    "B" Gép
                                </span>
                                <span className="small text-uppercase fw-bold" style={{ color: '#94a3b8' }}>{gepB.gyarto}</span>
                                <h4 className="fw-bold text-white mb-2">{gepB.tipus || gepB.modell}</h4>
                                <div className="display-6 fw-bold mb-3" style={{ color: '#38bdf8' }}>
                                    {formatFt(gepB.ar)}
                                </div>
                                <div className="d-flex flex-wrap gap-2">
                                    <span className="badge bg-dark border border-secondary text-light">
                                        📺 {gepB.kijelzo}" kijelző
                                    </span>
                                    <span className="badge bg-dark border border-secondary text-light">
                                        🧠 {gepB.memoria} MB RAM
                                    </span>
                                    <span className="badge bg-dark border border-secondary text-light">
                                        💾 {gepB.merevlemez} GB Tárhely
                                    </span>
                                    <span className={`badge ${gepB.db > 0 ? 'bg-success bg-opacity-25 text-success border border-success' : 'bg-danger bg-opacity-25 text-danger'}`}>
                                        📦 Készlet: {gepB.db} db
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Részletes összehasonlító táblázat */}
                    <div className="p-3 p-md-4 rounded-4 shadow-lg mb-4" style={{ backgroundColor: '#151e2e', border: '1px solid #1e2c42' }}>
                        <h5 className="fw-bold text-white mb-3">
                            <i className="bi bi-bar-chart-line me-2" style={{ color: '#2dd4bf' }}></i>
                            Részletes Technikai Összevetés
                        </h5>

                        <div className="table-responsive">
                            <table className="table table-dark table-hover align-middle mb-0" style={{ backgroundColor: 'transparent' }}>
                                <thead>
                                    <tr style={{ borderBottom: '2px solid #23334d', color: '#94a3b8', fontSize: '0.85rem' }}>
                                        <th style={{ width: '25%' }}>PARAMÉTER</th>
                                        <th style={{ width: '37.5%', color: '#2dd4bf' }}>"A" GÉP: {gepA.tipus || gepA.modell}</th>
                                        <th style={{ width: '37.5%', color: '#38bdf8' }}>"B" GÉP: {gepB.tipus || gepB.modell}</th>
                                    </tr>
                                </thead>
                                <tbody style={{ fontSize: '0.9rem' }}>
                                    <tr style={{ borderBottom: '1px solid #1e2c42' }}>
                                        <td style={{ color: '#94a3b8' }} className="fw-semibold">Gyártó</td>
                                        <td className="text-white fw-bold">{gepA.gyarto}</td>
                                        <td className="text-white fw-bold">{gepB.gyarto}</td>
                                    </tr>

                                    {(() => {
                                        const win = getWinStatus(gepA.kijelzo, gepB.kijelzo, true);
                                        return (
                                            <tr style={{ borderBottom: '1px solid #1e2c42' }}>
                                                <td style={{ color: '#94a3b8' }} className="fw-semibold">Kijelző méret</td>
                                                <td className={win.aWin ? 'fw-bold' : ''} style={win.aWin ? { color: '#2dd4bf', backgroundColor: 'rgba(20,184,166,0.08)' } : { color: '#cbd5e1' }}>
                                                    {gepA.kijelzo}" {win.aWin && '🏆 Nagyobb'}
                                                </td>
                                                <td className={win.bWin ? 'fw-bold' : ''} style={win.bWin ? { color: '#38bdf8', backgroundColor: 'rgba(56,189,248,0.08)' } : { color: '#cbd5e1' }}>
                                                    {gepB.kijelzo}" {win.bWin && '🏆 Nagyobb'}
                                                </td>
                                            </tr>
                                        );
                                    })()}

                                    {(() => {
                                        const win = getWinStatus(gepA.memoria, gepB.memoria, true);
                                        return (
                                            <tr style={{ borderBottom: '1px solid #1e2c42' }}>
                                                <td style={{ color: '#94a3b8' }} className="fw-semibold">Memória (RAM)</td>
                                                <td className={win.aWin ? 'fw-bold' : ''} style={win.aWin ? { color: '#2dd4bf', backgroundColor: 'rgba(20,184,166,0.08)' } : { color: '#cbd5e1' }}>
                                                    {gepA.memoria} MB ({Math.round(gepA.memoria / 1024)} GB) {win.aWin && '🏆 Több RAM'}
                                                </td>
                                                <td className={win.bWin ? 'fw-bold' : ''} style={win.bWin ? { color: '#38bdf8', backgroundColor: 'rgba(56,189,248,0.08)' } : { color: '#cbd5e1' }}>
                                                    {gepB.memoria} MB ({Math.round(gepB.memoria / 1024)} GB) {win.bWin && '🏆 Több RAM'}
                                                </td>
                                            </tr>
                                        );
                                    })()}

                                    {(() => {
                                        const win = getWinStatus(gepA.merevlemez, gepB.merevlemez, true);
                                        return (
                                            <tr style={{ borderBottom: '1px solid #1e2c42' }}>
                                                <td style={{ color: '#94a3b8' }} className="fw-semibold">Háttértár (HDD / SSD)</td>
                                                <td className={win.aWin ? 'fw-bold' : ''} style={win.aWin ? { color: '#2dd4bf', backgroundColor: 'rgba(20,184,166,0.08)' } : { color: '#cbd5e1' }}>
                                                    {gepA.merevlemez} GB {win.aWin && '🏆 Nagyobb tárhely'}
                                                </td>
                                                <td className={win.bWin ? 'fw-bold' : ''} style={win.bWin ? { color: '#38bdf8', backgroundColor: 'rgba(56,189,248,0.08)' } : { color: '#cbd5e1' }}>
                                                    {gepB.merevlemez} GB {win.bWin && '🏆 Nagyobb tárhely'}
                                                </td>
                                            </tr>
                                        );
                                    })()}

                                    <tr style={{ borderBottom: '1px solid #1e2c42' }}>
                                        <td style={{ color: '#94a3b8' }} className="fw-semibold">Videovezérlő</td>
                                        <td style={{ color: '#cbd5e1' }}>{gepA.videovezerlo || '-'}</td>
                                        <td style={{ color: '#cbd5e1' }}>{gepB.videovezerlo || '-'}</td>
                                    </tr>

                                    {(() => {
                                        const win = getWinStatus(gepA.ar, gepB.ar, false);
                                        return (
                                            <tr style={{ borderBottom: '1px solid #1e2c42' }}>
                                                <td style={{ color: '#94a3b8' }} className="fw-semibold">Vételár</td>
                                                <td className={win.aWin ? 'fw-bold' : ''} style={win.aWin ? { color: '#2dd4bf', backgroundColor: 'rgba(20,184,166,0.08)' } : { color: '#cbd5e1' }}>
                                                    {formatFt(gepA.ar)} {win.aWin && '⭐ Kedvezőbb ár'}
                                                </td>
                                                <td className={win.bWin ? 'fw-bold' : ''} style={win.bWin ? { color: '#38bdf8', backgroundColor: 'rgba(56,189,248,0.08)' } : { color: '#cbd5e1' }}>
                                                    {formatFt(gepB.ar)} {win.bWin && '⭐ Kedvezőbb ár'}
                                                </td>
                                            </tr>
                                        );
                                    })()}

                                    <tr style={{ borderBottom: '1px solid #1e2c42' }}>
                                        <td style={{ color: '#94a3b8' }} className="fw-semibold">Elérhetőség</td>
                                        <td>
                                            <span className={`badge ${gepA.db > 0 ? 'bg-success bg-opacity-25 text-success' : 'bg-danger bg-opacity-25 text-danger'}`}>
                                                {gepA.db > 0 ? `${gepA.db} db raktáron` : 'Nincs készleten'}
                                            </span>
                                        </td>
                                        <td>
                                            <span className={`badge ${gepB.db > 0 ? 'bg-success bg-opacity-25 text-success' : 'bg-danger bg-opacity-25 text-danger'}`}>
                                                {gepB.db > 0 ? `${gepB.db} db raktáron` : 'Nincs készleten'}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {/* Értékelő és összefoglaló kártya tiszta, jól olvasható szöveggel */}
                    <div className="p-4 rounded-4 shadow-lg" style={{ backgroundColor: '#151e2e', border: '1px solid #1e2c42' }}>
                        <div className="d-flex align-items-center gap-3">
                            <div className="fs-2" style={{ color: '#2dd4bf' }}>💡</div>
                            <div>
                                <h6 className="fw-bold text-white mb-2">Rendszerértékelés &amp; Árelemzés</h6>
                                <p className="mb-0" style={{ color: '#e2e8f0', fontSize: '0.95rem', lineHeight: '1.6' }}>
                                    {priceDiff > 0 ? (
                                        <>
                                            A két laptop közötti árkülönbség:{' '}
                                            <strong className="text-white px-2 py-0.5 rounded" style={{ backgroundColor: 'rgba(255,255,255,0.08)' }}>
                                                {formatFt(priceDiff)}
                                            </strong>.{' '}
                                            A kedvezőbb árú választás a(z):{' '}
                                            <strong style={{ color: '#2dd4bf', fontWeight: 'bold' }}>{cheaperName}</strong>.
                                        </>
                                    ) : (
                                        'A két kiválasztott készülék azonos áron érhető el a kínálatban.'
                                    )}
                                </p>
                            </div>
                        </div>
                    </div>
                </>
            )}
        </div>
    );
}