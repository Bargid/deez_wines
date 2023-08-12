@extends('layout.app')
@section('title', __('messages.admin'))
@push('styles')
    <link href=" {{ asset('css/modal.css') }}" rel="stylesheet">
@endpush
@section('content')
<main>
    @include('admin.partials.nav')
    {{-- <h2>Statistiques</h2>
    <p>Nombre total de bouteilles : {{ $totalBouteilles }}</p>
    <p>Nombre total d'usagers : {{ $totalUsagers }}</p>--}}

    <h1>Statistiques de l'administration</h1>

    <h2>Statistiques sur les usagers</h2>
    <p>Nombre total d'usagers : {{ $totalUsagers }}</p>
    <p>Nombre de nouveaux usagers dans les 30 derniers jours : {{ $nouveauxUsagers }}</p>

    <h2>Statistiques sur les celliers</h2>
    <p>Nombre total de celliers : {{ $totalCelliers }}</p>

    <h2>Statistiques par usager et par cellier</h2>
    <p>Nombre moyen de celliers par usager : {{ $moyenneCelliersParUsager }}</p>
    <p>Nombre moyen de bouteilles par cellier : {{ $moyenneBouteillesParCellier }}</p>
    <p>Nombre moyen de bouteilles par usager : {{ $moyenneBouteillesParUsager }}</p>

    <h2>Statistiques de consommation</h2>
    <p>Nombre de bouteilles bues dans les 30 derniers jours : {{ $totalBouteillesBues }}</p>
    <p>Nombre de nouvelles bouteilles ajoutées dans les 30 derniers jours : {{ $totalBouteillesAjoutees }}</p>



    <h2>Statistiques sur les bouteilles</h2>
    <p>Nombre total de bouteilles : {{ $totalBouteilles }}</p>
    <p>Valeur des bouteilles dans la DB : {{ $totalMontantBouteilles }} $</p>


    {{-- <h3>Usagers avec leurs celliers :</h3>
    @if (session('success'))
        <div class="alert-success" role="alert">{{ session('success') }}</div>
    @endif
    <table>
        <thead>
            <tr>
                <th>Nom de l'usager</th>
                <th>id de l'usager</th>
                <th>Nombre de celliers</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usagersAvecCelliers as $usager)
                <tr>
                    <td>{{ $usager->name }}</td>
                    <td>{{ $usager->id }}</td>
                    <td>{{ $usager->celliers_count }}</td>
                    <td>
                        @if($usager->role != 'admin')
                        <form class="formulaireDel" action="{{ route('admin.stats.destroy', $usager->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="boutonSupp" type="submit" onclick="openModal()">@lang('messages.delete_account')</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>--}}
</main>
@include('components.modals.modale-confirmer-suppression')
@endsection
@push('scripts')
    <script src="{{ asset('js/confirmerSupp.js')}}"></script>
@endpush