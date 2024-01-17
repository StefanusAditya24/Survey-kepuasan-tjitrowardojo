<section>
    <div class="card">
        <div class="card-header">
            <h4>Form</h4>
        </div>
        <div class="card-body">
            <form method="POST" wire:submit="save">
                <div class="form-group">
                    <label for="name">Pertanyaan</label>
                    <input id="name" type="text" class="form-control" wire:model="name">
                </div>
                <div class="form-group">
                    <label id="category">Kategori</label>
                    <select id="category" wire:model="questionCategory" class="form-select">
                        <option value="" disabled="" selected="">Pilih Jenis Kategori...
                        </option>
                        @foreach ($questionCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label id="type">Pertanyaan</label>
                    <select id="type" wire:model="questionType" class="form-select">
                        <option value="" disabled="" selected="">Pilih Jenis Pertanyaan...
                        </option>
                        @foreach ($questionTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    <div class="table-responsive">
        <table class="table table-striped" id="table-1">
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Jawaban</th>
                <th>Bobot</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if($question && $question->questionAnswers)
                @foreach ($question->questionAnswers as $key => $answer)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $answer->answer }}</td>
                        <td>{{ $answer->answer_value }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">No answers available</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</section>
