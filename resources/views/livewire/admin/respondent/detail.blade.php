<section>
    <div class="card">
        <div class="card-header">
            <h4>Data Respondent</h4>
        </div>
        <form class="card-body">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" wire:model="name" disabled>
            </div>
            <div class="form-group">
                <label>Nomor Telpon</label>
                <input type="text" class="form-control" wire:model="phoneNumber" disabled>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <input type="text" class="form-control" wire:model="gender" disabled>
            </div>
            <div class="form-group">
                <label>Umur</label>
                <input type="text" class="form-control" wire:model="age" disabled>
            </div>
            <div class="form-group">
                <label>Pendidikan</label>
                <input type="text" class="form-control" wire:model="education" disabled>
            </div>
            <div class="form-group">
                <label>Pekerjaan</label>
                <input type="text" class="form-control" wire:model="job" disabled>
            </div>
            <div class="form-group">
                <label>Jenis Layanan</label>
                <input type="text" class="form-control" wire:model="serviceType" disabled>
            </div>
            <div class="form-group">
                <a class="btn btn-warning" href="{{ route('respondent.index') }}">Back</a>
            </div>
        </form>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Jawaban</h4>
        </div>
        <form class="card-body">
            @foreach ($questions as $key => $question)
                <div class="form-group">
                    <label>{{ $key + 1 . ". {$question->name}" }}</label>
                    <input type="text" class="form-control" wire:model="answers.{{ $key }}" disabled>
                </div>
            @endforeach
        </form>
    </div>
</section>
