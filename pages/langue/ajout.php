<div class="card border-0 shadow-sm">
    <div class="card-header bg-success text-white py-3">
        <h5 class="mb-0"><i class="fas fa-graduation-cap me-2"></i>Nouvelle Langue (BTS)</h5>
    </div>
    <div class="card-body">
        <form action="/php/Ibrahim/Mini_projet/traitements/ajout_langue.php" method="POST" class="needs-validation" novalidate>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Code Spécialité</label>
                    <input type="text" name="code_langue" class="form-control" placeholder="Ex: Ar" required>
                    <div class="invalid-feedback">Ce champ est Obligatoire</div>
                </div>
                <div class="col-md-8">
                    <label class="form-label fw-bold">Désignation</label>
                    <input type="text" name="design_langue" class="form-control" placeholder="Ex: Arabe" required>
                    <div class="invalid-feedback">Ce champ est Obligatoire</div>
                </div>
                <div class="col-12 text-end mt-4">
                    <button type="submit" name="btn_ajout_langue" class="btn btn-success px-4">
                        <i class="fas fa-check me-1"></i> Enregistrer la Langue
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>