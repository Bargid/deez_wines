@extends('layout.app')
@section('title', $cellier->nom)
@push('styles')
    <link href=" {{ asset('css/carte-vin-lr.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/cellier-show.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/modal.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/auth.css') }}" rel="stylesheet">
@endpush
@section('content')
<main>
    @if (session('edit-cellier'))
        <div class="alert-success" role="alert">{{ session('edit-cellier') }}</div>
    @endif
    <div class="header-nom-cellier">
        <form class="form-modifier" action="{{ route('celliers.update', $cellier->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input class="input-edit-nom" type="text" name="nom" id="nom" value="{{ $cellier->nom }}">
            <div class="crayon-edit-icon"><img src="{{ asset('icons/edit_pen.svg') }}" alt="crayon modification"></div>
            <button type="submit" class="bouton-annuler">@lang('messages.cancel')</button>
            <button type="submit" class="bouton-enregistrer">@lang('messages.save')</button>
        </form>
        <form class="formulaireDel" action="{{ route('celliers.destroy', $cellier->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="x-icon boutonSupp" type="submit" onclick="openModal()"><img src="{{ asset('icons/x.svg') }}" alt=""></button>
        </form>
    </div>
    <div>
        <h2>@lang('messages.your_bottles')</h2>
        <a class="boutonCellier espace" href="{{ route('bouteilles.create', Auth::id()) }}">@lang('messages.add_custom_bottle')</a>
    
        @if (session('success'))
            <div class="alert-success" role="alert">{{ session('success') }}</div>
        @endif

        @foreach($cellierQuantiteBouteille as $quantiteBouteille)
        <div class="carte-vin-container">

            {{-- nouvelle version, mais ça sert à quoi? --}}
            @php
                $pastilleMap = [
                    "Pastille de goût : Fruité et vif" => ["class" => "bande-de-gout-fv", "text" => "Fruité et Vif"],
                    "Pastille de goût : Aromatique et charnu" => ["class" => "bande-de-gout-ac", "text" => "Aromatique et Charnu"],
                    "Pastille de goût : Aromatique et rond" => ["class" => "bande-de-gout-ar", "text" => "Aromatique et Rond"],
                    "Pastille de goût : Aromatique et souple" => ["class" => "bande-de-gout-as", "text" => "Aromatique et Souple"],
                    "Pastille de goût : Délicat et léger" => ["class" => "bande-de-gout-dl", "text" => "Délicat et Léger"],
                    "Pastille de goût : Fruité et doux" => ["class" => "bande-de-gout-fd", "text" => "Fruité et Doux"],
                    "Pastille de goût : Fruité et généreux" => ["class" => "bande-de-gout-fg", "text" => "Fruité et Généreux"],
                    "Pastille de goût : Fruité et léger" => ["class" => "bande-de-gout-fl", "text" => "Fruité et Léger"],
                    "Pastille de goût : Fruité et extra-doux" => ["class" => "bande-de-gout-fed", "text" => "Fruité et Extra-Doux"],
                ];
            @endphp

            @if(array_key_exists($quantiteBouteille->bouteille->image_pastille_alt, $pastilleMap))
                <div class="{{ $pastilleMap[$quantiteBouteille->bouteille->image_pastille_alt]['class'] }}">
                    <span>{{ $pastilleMap[$quantiteBouteille->bouteille->image_pastille_alt]['text'] }}</span>
                </div>
            @endif

            <div class="carte-vin @if(!$quantiteBouteille->bouteille->image_pastille_alt) no-pastille-cellier @endif">
                <picture class="protruding">
                    {{--* Ici j'utilise le glide, le chemin est img/glide/images car c'est l'origine de l'image des bouteilles --}}
                    {{--* Pour une pastille, ce serait img/glide/pastilles/ $image_pastille, environ --}}
                @if($quantiteBouteille->bouteille->est_personnalisee)
                    <img src="{{ url('glide/imagesPersonnalisees/'. $quantiteBouteille->bouteille->image_bouteille . '?p=maquette') }}" alt="{{ $quantiteBouteille->bouteille->nom }}">
                @else
                        <img src="{{ url('glide/images/'. $quantiteBouteille->bouteille->image_bouteille . '?p=maquette') }}" alt="{{ $quantiteBouteille->bouteille->image_bouteille_alt }}">
                @endif
                </picture>
                <section>
                    <a href="{{ route('bouteilles.show', $quantiteBouteille->bouteille->id) }}"><h2>{{ $quantiteBouteille->bouteille->nom }}</h2></a>
                    <div class="info-multiples-cellier">
                        {{--* Comme ca on ne voit pas les "|" si il n'y a pas de couleur ou de format --}} 
                        <p>
                            {{ $quantiteBouteille->bouteille->couleur_fr ? $quantiteBouteille->bouteille->couleur_fr . " | " : $quantiteBouteille->bouteille->couleur_fr }}
                            {{ $quantiteBouteille->bouteille->format ? $quantiteBouteille->bouteille->format . " | " : $quantiteBouteille->bouteille->format }}
                            {{ $quantiteBouteille->bouteille->pays_fr . " | "}}
                            {{ $quantiteBouteille->bouteille->prix }} $
                        </p>
                        <p>@lang('messages.qty') : <span class="nombreBouteilles">{{ $quantiteBouteille->quantite }}</span></p>
                    </div>
                    <div class="sectionBoutons">
                        <div>
                            <button class="modifierQuantite overlap-cellier-modifier espace" data-id="{{ $quantiteBouteille->id }}" data-nombre="{{ $quantiteBouteille->quantite }}">@lang('messages.modify')<span class="material-symbols-outlined">edit_note</span></button>
                        </div>
                        <form action="{{ route('cellier_quantite_bouteille.destroy', $quantiteBouteille->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden"  name="cellier_id" value="{{ $cellier->id }}">
                            <button class="overlap-cellier-supprimer espace" type="submit">@lang('messages.delete')<span class="material-symbols-outlined">close</span></button>
                        </form>
                    </div>
                </section>
            </div>
            </div>
        @endforeach
    </div>
</main>
@include('components.modals.modale-changer-qte-bouteille')
@include('components.modals.modale-confirmer-suppression')
@endsection
@push('scripts')
    <script src="{{ asset('js/changerQuantiteBouteille.js') }}"></script>
    <script src="{{ asset('js/messages.js')}}"></script>
    <script src="{{ asset('js/modifierCellier.js')}}"></script>
    <script src="{{ asset('js/confirmerSupp.js')}}"></script>
@endpush