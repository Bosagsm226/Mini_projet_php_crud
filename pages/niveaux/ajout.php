<div class="card border-0 shadow-sm">
    <div class="card-header bg-warning text-white py-3">
        <h5 class="mb-0"><i class="fas fa-layer-group me-2"></i>Nouveau Niveau Scolaire</h5>
    </div>
    <div class="card-body">
        <form action="/php/Ibrahim/Mini_projet/traitements/ajout_niveaux.php" method="POST" class="needs-validation" novalidate>
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label fw-bold">Désignation du Niveau</label>
                    <input type="text" name="design_niveaux" class="form-control" placeholder="Ex: 2AS " required>
                    <div class="invalid-feedback">Ce champ est Obligatoire</div>
                </div>
                <div class="col-12 text-end mt-4">
                    <button type="submit" name="btn_ajout_niveau" class="btn btn-warning text-white px-4">
                        <i class="fas fa-plus-circle me-1"></i> Ajouter le niveau
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>