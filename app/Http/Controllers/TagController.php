<?php

namespace App\Http\Controllers;


use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;

class TagController extends Controller
{
    /**
     * Affiche la liste des tags.
     */
    public function index()
    {
        $tags = Tag::paginate(5);
        return view('tags.index', compact('tags'));
    }

    /**
     * Affiche le formulaire de création d'un tag.
     */
    public function create()
    {
        return view('tags.create');
    }


    /**
     * Enregistre un nouveau tag dans la base de données.
     */

    public function store(TagRequest $request)
    {



        Tag::create($request->validated());

        return redirect()->route('tags.index')->with('success', 'Tag crée avec succes.');
    }

    /**
     * Affiche le formulaire de modification d'un tag.
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    /**
     * Met à jour un tag dans la base de données.
     */

    public function update(TagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());

        return redirect()->route('tags.index')->with('success', 'Tag mis a jour avec succes.');
    }

    /**
     * Supprime un tag de la base de données.
     *
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Tag supprimé avec succes.');
    }



}

