<dialog class="changerQteBout">
    <form action="{{ route('cellier_quantite_bouteille.update', 0)}}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <span class="plus">&#43;</span>
            <input  name="nouvelleQuantite" class="inputQuantite" type="number" value="" min="1">
            <span class="moins">&#8722;</span>
        </div>
        <button class="boutonCellier espace" type="submit">Appliquer</button>
        <button class="boutonCellier espace">Annuler</button>
    </form>
</dialog>