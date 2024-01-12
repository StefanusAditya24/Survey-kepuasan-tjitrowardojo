<section>
    <div class="card">
        <div class="card-header">
            <h4>Form</h4>
        </div>
        <form class="card-body" method="POST" wire:submit="save">
            <div class="form-group">
                <label>Umur</label>
                <input type="text" class="form-control" wire:model="name">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</section>
