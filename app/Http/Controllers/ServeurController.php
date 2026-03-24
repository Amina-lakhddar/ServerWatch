<?php
namespace App\Http\Controllers;

use App\Models\Serveur;
use Illuminate\Http\Request;

class ServeurController extends Controller
{
    public function index()
    {
        $serveurs = Serveur::withCount(['metrics', 'alerts'])->get();
        return view('serveurs.index', compact('serveurs'));
    }

    public function create()
    {
        return view('serveurs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'      => 'required|string|max:255',
            'adressIP' => 'required|string|max:255',
            'statut'   => 'required|in:actif,inactif',
        ]);

        Serveur::create($request->all());

        return redirect()->route('serveurs.index')
                         ->with('success', 'Serveur ajouté!');
    }

    public function show(Serveur $serveur)
    {
        $metrics = $serveur->metrics()->latest()->take(20)->get();
        $alerts  = $serveur->alerts()->latest()->take(10)->get();
        return view('serveurs.show', compact('serveur', 'metrics', 'alerts'));
    }

    public function edit(Serveur $serveur)
    {
        return view('serveurs.edit', compact('serveur'));
    }

    public function update(Request $request, Serveur $serveur)
    {
        $request->validate([
            'nom'      => 'required|string|max:255',
            'adressIP' => 'required|string|max:255',
            'statut'   => 'required|in:actif,inactif',
        ]);

        $serveur->update($request->all());

        return redirect()->route('serveurs.index')
                         ->with('success', 'Serveur modifié!');
    }

    public function destroy(Serveur $serveur)
    {
        $serveur->delete();
        return redirect()->route('serveurs.index')
                         ->with('success', 'Serveur supprimé!');
    }
}