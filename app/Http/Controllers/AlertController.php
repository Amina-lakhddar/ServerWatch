<?php
namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Serveur;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function index()
    {
        $alerts   = Alert::with('serveur')->latest()->paginate(15);
        $serveurs = Serveur::all();
        return view('alerts.index', compact('alerts', 'serveurs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'message'    => 'required|string',
            'seuil'      => 'required|numeric',
            'statut'     => 'required|in:lue,non_lue',
            'date'       => 'required|date',
            'serveur_id' => 'required|exists:serveurs,id',
        ]);

        Alert::create($request->all());

        return redirect()->route('alerts.index')
                         ->with('success', 'Alerte créée!');
    }

    public function markAsRead(Alert $alert)
    {
        $alert->update(['statut' => 'lue']);
        return redirect()->back()->with('success', 'Alerte marquée comme lue!');
    }

    public function destroy(Alert $alert)
    {
        $alert->delete();
        return redirect()->route('alerts.index')
                         ->with('success', 'Alerte supprimée!');
    }
}