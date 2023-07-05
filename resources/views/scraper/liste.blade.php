@extends('layout.app')
@section('content')
{{-- @if(count($erreurs) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach($erreurs as $erreur)
                <li>{{ $erreur }}</li>
            @endforeach
        </ul>
    </div>
@endif
<p>Nombre de codes SAQ traités : {{ $codesTraites }}</p>
@if(empty($erreurs))
  <p>Aucune erreur détectée!</p>
@endif --}}
<main class="demo-liste">

  <h1 class="titre-principal"> INFOS SCRAPER</h1>
  @if(count($bouteilles) > 0)
  @php $bouteilles = $bouteilles->slice(-30) @endphp
  @foreach ($bouteilles as $bouteille)
  <div class="ensemble">
    <div class="info-row">
        <div class="pastilles-bouteilles-images">
          <div class="pastille-image">
            @if(empty($bouteille['image_pastille']))
            {{-- <p>cette bouteille n'a pas de pastille de goût</p> --}}
            @else
            {{-- <p>{{$bouteille['image_pastille_alt']}}</p> --}}
              <img src="{{asset('pastilles/' . $bouteille['image_pastille'])}}" alt="{{$bouteille['image_pastille_alt']}}" style="max-height: 65px">
            @endif
          </div>
          <div class="bouteille-image">
            <img src="{{ asset('images/' . $bouteille['image_bouteille']) }}" alt="{{ $bouteille['image_bouteille_alt'] }}" style="max-height: 350px;">
          </div>
        </div>
        <div class="title-desc">
          <div>
            <h1>{{$bouteille['nom']}}</h1>
          </div>
          <div class="localisation-box">
            @if($lang === "fr")
              <p>{{ $bouteille['couleur_fr'] }} | {{ $bouteille['pays_fr'] }}, {{ $bouteille['region_fr'] }}</p>
            @elseif($lang === "en")
              <p>{{ $bouteille['couleur_en'] }} | {{ $bouteille['pays_en'] }}, {{ $bouteille['region_en'] }}</p>
            @endif
          </div>
          <div>
            {{-- <h3>Informations pertinentes</h3> --}}
            @if($lang === "fr")
              @if(empty($bouteille['description_fr']))
                <p>cette bouteille n'a pas de texte descriptif</p>
              @else
                <p class="infos">{{$bouteille['description_fr']}}</p>
              @endif
            @else
              @if(empty($bouteille['description_en']))
                <p>this bottle has no descriptive text</p>
              @else
                <p class="infos">{{$bouteille['description_en']}}</p>
              @endif
            @endif
            </div>
          <div class="prix-box">
            <p>{{$bouteille['prix']}}</p>
          </div>
        </div>
      </div>
      <div class="infos">
        <div class="infos-title">
          <h3>infos Détaillées</h3>
        </div>
        <div class="infos-detailles">
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Pays </p>
            @if($lang === "fr")
              <p class="infos-detailles-text">{{ $bouteille['pays_fr'] }}</p>
            @else
              <p class="infos-detailles-text">{{ $bouteille['pays_en'] }}</p>
            @endif
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Couleur </p>
            @if($lang === "fr")
              <p class="infos-detailles-text">{{ $bouteille['couleur_fr'] }}</p>
            @else
              <p class="infos-detailles-text">{{ $bouteille['couleur_en'] }}</p>
            @endif
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Région </p>
            @if($lang === "fr")
              <p class="infos-detailles-text">{{ $bouteille['region_fr'] }}</p>
            @else
              <p class="infos-detailles-text">{{ $bouteille['region_en'] }}</p>
            @endif
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Format </p>
            <p class="infos-detailles-text">{{ $bouteille['format'] }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Désignation reglementée </p>
            @if($lang === "fr")
              <p class="infos-detailles-text">{{ $bouteille['designation_reglementee_fr'] }}</p>
            @else
              <p class="infos-detailles-text">{{ $bouteille['designation_reglementee_fr'] }}</p>
            @endif
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Producteur </p>
            <p class="infos-detailles-text">{{ $bouteille['producteur'] }}</p>
          </div>
          <div class="infos-detailles-carte">
            @if (isset($bouteille['cepage']))
              <p class="infos-detailles-title"> Cépage </p>
              <p class="infos-detailles-text">{{ $bouteille['cepage'] }}</p>
            @endif
          </div>
          <div class="infos-detailles-carte">
            @if (isset($bouteille['agent_promotionnel']))
              <p class="infos-detailles-title"> Agent Promotionnel </p>
              <p class="infos-detailles-text">{{ $bouteille['agent_promotionnel'] }}</p>
            @endif
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Degrée d'Alcool </p>
            <p class="infos-detailles-text">{{ $bouteille['degree_alcool'] }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Code SAQ </p>
            <p class="infos-detailles-text">{{ $bouteille['code_SAQ'] }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Taux de Sucre </p>
            <p class="infos-detailles-text">{{ isset($bouteille['taux_de_Sucre']) ? $bouteille['taux_de_sucre'] : 'Non Disponible' }}</p>
          </div>
          <div class="infos-detailles-carte">
            @if(isset($bouteille['code_CUP']))
              <p class="infos-detailles-title"> Code CUP </p>
              <p class="infos-detailles-text">{{ $bouteille['code_CUP'] }}</p>
            @endif
          </div>
        </div>
      </div>
    </div>
    
    <div class="custom-hr"></div>
    
    @endforeach
    @endif
    @endsection
  </main>