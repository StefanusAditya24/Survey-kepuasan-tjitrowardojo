<section>
    <div class="card">
        <div class="card-header">
            <h4>Form</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form method="POST" wire:submit="save">
                        <div class="form-group">
                            <label>Jenis Pelayanan</label>
                            <input type="text" class="form-control" wire:model="name">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
