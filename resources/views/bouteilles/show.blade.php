@push('styles') 
<link href=" {{ asset('css/modal.css') }}" rel="stylesheet">
<link href=" {{ asset('css/detail-lr.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endpush
@push('scripts')
<script src="{{ asset('js/modal.js')}}"></script>
{{-- <script src="{{ asset('js/form-commentaire.js')}}"></script> --}}
<script src="{{ asset('js/note-etoile.js')}}"></script>
<script src="{{ asset('js/form-modification.js')}}" defer></script>
@endpush
@extends('layout.app')
@section('title', 'Bouteille')
@section('content')
    
    <main>
        <picture class="bouteille-container">
            @if($bouteille->est_personnalisee)
                <img src="{{ url('glide/imagesPersonnalisees/'. $bouteille->image_bouteille . '?p=detail') }}" alt="{{ $bouteille->image_bouteille_alt }}">
            @else
                <img src="{{ url('glide/images/'. $bouteille->image_bouteille . '?p=detail') }}" alt="{{ $bouteille->image_bouteille_alt }}">
            @endif
        </picture>

        <div class="description-container">
            <div class="carte-titre">
                <h2>{{ $bouteille->nom }}</h2>
                <p>
                    {{ $bouteille->couleur_fr ? $bouteille->couleur_fr . " | " : $bouteille->couleur_fr }}
                    {{ $bouteille->format ? $bouteille->format . " | " : $bouteille->format }}
                    {{ $bouteille->pays_fr }}
                </p>
            </div>
            <a class="bouton-ajouter" onclick="openModal('{{ $bouteille->nom }}', '{{ $bouteille->id }}')">
                Ajouter<img src="{{ asset('icons/cellier_icon_white.svg') }}" alt="Plus">
            </a>

            <div class="informations">
                <div class="info-double">
                    <div>
                        <h3>Région</h3>
                        <p>{{ $bouteille->region_fr }}</p>
                    </div>
                    <div>
                        <h3>Format</h3>
                        <p>{{ $bouteille->format }}</p>
                    </div>
                </div>
                <div class="info-double">
                    <div>
                        <h3>Degrée d'alcool</h3>
                        <p>{{ $bouteille->degree_alcool }}</p>
                    </div>
                    <div>
                        <h3>Taux de sucre</h3>
                        <p>{{ $bouteille->taux_de_sucre }}</p>
                    </div>
                </div>

                <div class="info-simple">
                    <h3>Température de service</h3>
                    <p>{{ $bouteille->temperature_fr }}</p>
                </div>
                <div class="info-simple">
                    <h3>Arômes</h3>
                    <p>{{ $bouteille->aromes_fr }}</p>
                </div>
                <div class="info-simple">
                    <h3>Désignation reglementée</h3>
                    <p>{{ $bouteille->designation_reglementee_fr }}</p>
                </div>
                <div class="info-simple">
                    <h3>Producteur</h3>
                    <p>{{ $bouteille->producteur }}</p>
                </div>
                <div class="info-simple">
                    <h3>Agent romotionnel</h3>
                    <p>{{ $bouteille->agent_promotionnel }}</p>
                </div>

                <div class="division"></div>

                @if($bouteille->description_fr)
                    <div class="info-detaillee">
                        <h3>Infos détaillées</h3>
                        <p>{{ $bouteille->description_fr }}</p>
                    </div>
                    
                    <div class="division"></div>
                @endif

                <section class="info-gouts-container">

                    @php
                        $valeurs = [$bouteille->acidite_fr, $bouteille->sucrosite_fr, $bouteille->corps_fr, $bouteille->bouche_fr, $bouteille->bois_fr];
                        $nom = ['Acidité', 'Sucrosité', 'Corps', 'Bouche', 'Bois'];
                        $un = ['discrète', 'demi-sec', 'léger', 'délicate', 'discret'];
                        $deux = ['présente','doux','mi-corsé','généreuse','équilibré'];
                        $trois = ['vive','extra-doux','corsé','enveloppante','marqué'];

                        $position = 0;
                    @endphp

                    @for($i = 0; $i < count($valeurs); $i++)
                        <div class="info-gouts">
                            @if($valeurs[$position] != null)
                                <div class="texte-gouts">
                                    <h3>{{ $nom[$position] }}</h3><p>{{ $valeurs[$position] }}</p>
                                </div>
                                <div class="ligne-container">
                                    <div class="ligne-gauche" @if(in_array($valeurs[$position], $un) || in_array($valeurs[$position], $deux) || in_array($valeurs[$position], $trois)) style="background-color: var(--ligne-gout);" @endif></div>
                                    <div class="ligne-centre" @if(in_array($valeurs[$position], $deux) || in_array($valeurs[$position], $trois)) style="background-color: var(--ligne-gout);" @endif></div>
                                    <div class="ligne-droite" @if(in_array($valeurs[$position], $trois)) style="background-color: var(--ligne-gout);" @endif></div>
                                </div>
                            @endif
                        </div>
                        @php $position++; @endphp
                    @endfor

                    @if($bouteille->acidite_fr != null)
                        <div class="division"></div>
                    @endif
                </section>
            </div>

            <div class="commentaire-note">

                <div class="commentaire-existant form-visible">
                    @if(!empty($commentaireBouteille->commentaire))
                        <div class="commentaire">
                            <h3>Commentaire : </h3>
                            <p>{{ $commentaireBouteille->commentaire }}</p>
                        </div>
                    @endif
                    
                    @if(!empty($commentaireBouteille->note))
                        <div class="note">
                            <h3>Note</h3>
                            <p>{{ $commentaireBouteille->note }}/5</p>
                        </div>
                    @endif
                    @if(!empty($commentaireBouteille->note) || !empty($commentaireBouteille->commentaire))
                        <div class="bouton-modifier">
                            <a id="btn-modifier-commentaire" type="button">
                                Modifer <span class="material-symbols-outlined exclure">edit_note</span>
                            </a>
                        </div>
                    @endif
                </div>
                    @if(empty($commentaireBouteille->commentaire) && empty($commentaireBouteille->note))
                            <form id="form-commentaire" class="{{ empty($commentaireBouteille) ? 'form-visible' : 'form-invisible' }}" action="{{ route('commentaire_bouteille.store') }}" method="POST">
                        @csrf
                    @else
                        <form id="form-commentaire" class="form-invisible" action="{{ route('commentaire_bouteille.update', $commentaireBouteille->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                    @endif

                        <label for="commentaire">Commentaire : </label>
                        <textarea name="commentaire" id="commentaire" cols="30" rows="10" data-commentaire="{{ $commentaireBouteille->commentaire ?? '' }}"></textarea>
                        <input type="hidden" name="bouteille_id" value="{{ $bouteille->id }}">
                        <label for="note">Note : </label>

                            <div class="note-etoile">
                            <span class="etoile material-symbols-outlined" data-note="1">wine_bar</span>
                            <span class="etoile material-symbols-outlined" data-note="2">wine_bar</span>
                            <span class="etoile material-symbols-outlined" data-note="3">wine_bar</span>
                            <span class="etoile material-symbols-outlined" data-note="4">wine_bar</span>
                            <span class="etoile material-symbols-outlined" data-note="5">wine_bar</span>
                            </div>
                            
                            <input type="hidden" name="note" id="note" value="0">

                            <div class="bouton-submit">
                                <button type="submit" class="invisible-385px">Ajouter</button><img src="{{ asset('icons/plus_icon.svg') }}" alt="Plus">
                            </div>
                        </form>
            </div>
        </div>
</main>
    
@include('components.modals.modale-ajout-bouteille')

@endsection