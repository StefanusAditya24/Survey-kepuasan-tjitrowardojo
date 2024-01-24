<section>
    <div class="card">
        <div class="card-header">
            <h4>Form</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6" wire:key="questionForm">
                    <form method="POST" wire:submit="save">
                        <div class="form-group">
                            <label for="name">Pertanyaan</label>
                            <input id="name" type="text" class="form-control" wire:model="name">
                        </div>
                        <div class="form-group">
                            <label id="category">Kategori</label>
                            <select id="category" wire:model="questionCategory" class="form-control">
                                <option value="" disabled="" selected="">Pilih Jenis Kategori...
                                </option>
                                @foreach ($questionCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label id="type">Pertanyaan</label>
                            <select id="type" wire:change="selectQuestionType($event.target.value)"
                                    class="form-control">
                                <option value="" disabled="" selected="">Pilih Jenis Pertanyaan...
                                </option>
                                @foreach ($questionTypes as $type)
                                    <option value="{{ json_encode(['id' => $type->id, 'type' => $type->type]) }}">{{ $type->type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
                @if($selectedQuestionType && $selectedQuestionType !== "Open Ended Question")
                    <div class="col-md-6" wire:key="weightTable">
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
                            @foreach ($weightedAnswers as $key => $answer)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $answer['answer'] }}</td>
                                    <td>{{ $answer['answer_value'] }}</td>
{{--                                    <td class="align-middle">--}}
{{--                                        <button--}}
{{--                                                class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit--}}
{{--                                        </button>--}}
{{--                                        <button class="btn btn-danger" data-confirm="Realy?|Do you want to continue?" data-confirm-yes="alert('Deleted :)');">Delete</button>--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach
                            {{--                            <td colspan="4">No answers available</td>--}}
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>This is the content of the modal. You can put any HTML content here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</section>
