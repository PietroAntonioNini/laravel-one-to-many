<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            // Se l'utente è autenticato, reindirizza alla dashboard dell'amministratore
            $projects = Project::all();
            return view('admin.index', compact('projects'));
        } else {
            // Altrimenti, reindirizza alla pagina degli elenchi dei progetti per gli ospiti
            $projects = Project::all();
            return view('index', compact('projects'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //prendo tutti i tipi dal db
        $types = Type::all();

        return view('admin.projects.create',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        //Validiamo la richiesta e otteniamo i dati validati
        $validatedData = $request->validated();

        //Creiamo un nuovo Progetto con i dati validati
        $newProject = new Project();
        
        //controlliamo se nella request è presente un file in arrivo
        if($request->hasFile('cover_image')) {
            //salviamo il perscorso dell'img in una variabile, e contemporaneamente nel server
            $path = Storage::disk('public')->put('projects_images', $request->cover_image);

            //salvo il nuovo percorso ottenuto dal salvataggio dell'immagine
            $newProject->cover_image = $path;
        }
        
        $newProject->fill($validatedData);

        $newProject->save();


        //Reindirizziamo alla pagina dei Progetti
        return redirect()->route('admin.index', $newProject->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();

        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProjectRequest $request, Project $project)
    {
        $request->validated();

        //Controllo se la cover image è stata inserita
        if($request->hasFile('cover_image')) {
            // la cartella che abbiamo indicato nel metodo put() se è già presente viene utilizzata, altrimenti viene creata vuota
            $path = Storage::disk('public')->put('projects_images', $request->cover_image);
    
            // salvo il nuovo percorso che ho ottenuto dal salvataggio dell'immagine (Laravel per privacy e sicurezza cambia il nome del file)
            $project->cover_image = $path;
        }

        $project->update($request->all());
        
        return redirect()->route('admin.index', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.index');
    }
}
