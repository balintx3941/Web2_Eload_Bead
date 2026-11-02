<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GepController extends Controller
{
    // GET: Gépek listázása
    public function index()
    {
        try {
            $gepek = DB::table('geps')->orderBy('id', 'desc')->get()->map(function ($g) {
                if (isset($g->tipus) && !isset($g->modell)) {
                    $g->modell = $g->tipus;
                }
                return $g;
            });
            return response()->json($gepek);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Lekérési hiba: ' . $e->getMessage()], 500);
        }
    }

    // POST: Új gép mentése
    public function store(Request $request)
    {
        try {
            $columns = Schema::getColumnListing('geps');

            $data = [];
            if (in_array('gyarto', $columns))        $data['gyarto'] = $request->input('gyarto') ?: 'Egyéb';
            if (in_array('tipus', $columns))         $data['tipus'] = $request->input('modell') ?: ($request->input('tipus') ?: 'Alapmodell');
            if (in_array('modell', $columns))        $data['modell'] = $request->input('modell') ?: ($request->input('tipus') ?: 'Alapmodell');
            if (in_array('kijelzo', $columns))       $data['kijelzo'] = (float)($request->input('kijelzo') ?: 15.6);
            if (in_array('memoria', $columns))       $data['memoria'] = (int)($request->input('memoria') ?: 8);
            if (in_array('merevlemez', $columns))    $data['merevlemez'] = (int)($request->input('merevlemez') ?: 256);
            if (in_array('videovezerlo', $columns))  $data['videovezerlo'] = $request->input('videovezerlo') ?: 'Integrált / Dedikált';
            if (in_array('ar', $columns))            $data['ar'] = (int)($request->input('ar') ?: 150000);
            if (in_array('db', $columns))            $data['db'] = (int)($request->input('db') ?: 1);

            // Külső kulcsok beállítása
            if (in_array('processzor_id', $columns) || in_array('processzorid', $columns)) {
                $col = in_array('processzor_id', $columns) ? 'processzor_id' : 'processzorid';
                $data[$col] = DB::table('processzors')->value('id') ?? 1;
            }

            if (in_array('oprendszer_id', $columns) || in_array('oprendszerid', $columns)) {
                $col = in_array('oprendszer_id', $columns) ? 'oprendszer_id' : 'oprendszerid';
                $data[$col] = DB::table('oprendszers')->value('id') ?? 1;
            }

            // Időbélyegek, ha a táblában léteznek
            if (in_array('created_at', $columns)) $data['created_at'] = now();
            if (in_array('updated_at', $columns)) $data['updated_at'] = now();

            $id = DB::table('geps')->insertGetId($data);
            $ujGep = DB::table('geps')->where('id', $id)->first();

            if (isset($ujGep->tipus) && !isset($ujGep->modell)) {
                $ujGep->modell = $ujGep->tipus;
            }

            return response()->json($ujGep, 201);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Mentési hiba: ' . $e->getMessage()], 500);
        }
    }

    // PUT: Meglévő gép módosítása
    public function update(Request $request, $id)
    {
        try {
            $columns = Schema::getColumnListing('geps');

            $data = [];
            if (in_array('gyarto', $columns))        $data['gyarto'] = $request->input('gyarto');
            if (in_array('tipus', $columns))         $data['tipus'] = $request->input('modell') ?: $request->input('tipus');
            if (in_array('modell', $columns))        $data['modell'] = $request->input('modell') ?: $request->input('tipus');
            if (in_array('kijelzo', $columns))       $data['kijelzo'] = $request->input('kijelzo');
            if (in_array('memoria', $columns))       $data['memoria'] = $request->input('memoria');
            if (in_array('merevlemez', $columns))    $data['merevlemez'] = $request->input('merevlemez');
            if (in_array('videovezerlo', $columns) && $request->has('videovezerlo')) {
                $data['videovezerlo'] = $request->input('videovezerlo');
            }
            if (in_array('ar', $columns))            $data['ar'] = $request->input('ar');
            if (in_array('updated_at', $columns))    $data['updated_at'] = now();

            DB::table('geps')->where('id', $id)->update(array_filter($data, fn($v) => !is_null($v)));

            $frissitett = DB::table('geps')->where('id', $id)->first();
            if (isset($frissitett->tipus) && !isset($frissitett->modell)) {
                $frissitett->modell = $frissitett->tipus;
            }

            return response()->json($frissitett);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Módosítási hiba: ' . $e->getMessage()], 500);
        }
    }

    // DELETE: Gép törlése
    public function destroy($id)
    {
        try {
            DB::table('geps')->where('id', $id)->delete();
            return response()->json(['message' => 'Sikeresen törölve!']);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Törlési hiba: ' . $e->getMessage()], 500);
        }
    }
}