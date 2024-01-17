<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>Data</h4>
                    <a href="{{ route('category.form') }}" class="btn btn-icon icon-left btn-primary"><i
                                class="far fa-edit"></i>
                        Tambah</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $key => $category)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td class="align-middle">
                                        <a href="{{ route('category.form', ['categoryId' => $category->id]) }}"
                                           class="btn btn-secondary">Edit</a>
                                        <button wire:click="delete({{ $category->id }})"
                                                class="btn btn-danger">Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
