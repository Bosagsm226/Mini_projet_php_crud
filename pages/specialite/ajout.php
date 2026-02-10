<div class="card border-0 shadow-sm">
    <div class="card-header bg-info text-white py-3">
        <h5 class="mb-0"><i class="fas fa-graduation-cap me-2"></i>Nouvelle Spécialité (BTS)</h5>
    </div>
    <div class="card-body">
        <form action="/php/Ibrahim/Mini_projet/traitements/ajout_specialite.php" method="POST" class="needs-validation" novalidate>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Code Spécialité</label>
                    <input type="text" name="code_spec" class="form-control" placeholder="Ex: INF0705 " required>
                    <div class="invalid-feedback">Ce champ est Obligatoire</div>
                </div>
                <div class="col-md-8">
                    <label class="form-label fw-bold">Désignation</label>
                    <input type="text" name="design_spec" class="form-control" placeholder="Ex: Informatique de Gestion" required>
                    <div class="invalid-feedback">Ce champ est Obligatoire</div>
                </div>
                <div class="col-12 text-end mt-4">
                    <button type="submit" name="btn_ajout_spec" class="btn btn-info px-4">
                        <i class="fas fa-save me-1"></i> Enregistrer la spécialité
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>