<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>Data</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <select id="filterDate" wire:key="selectedFilter" wire:model.live="selectedFilter" class="form-control">
                                <option value="" disabled selected="">Pilih Range Tanggal...</option>
                                <option value="all">Semua</option>
                                <option value="single">Bulan ini</option>
                                <option value="triple">3 Bulan</option>
                                <option value="year">Tahunan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <button wire:click="export" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Export</button>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Nama</th>
                                    <th>Nomor Telpon</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Umur</th>
                                    <th>Edukasi</th>
                                    <th>Pekerjaan</th>
                                    <th>Jenis Layanan</th>
                                    <th>Waktu</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($respondentDatas as $key => $data)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->phone_number }}</td>
                                        <td>{{ $data->gender }}</td>
                                        <td>{{ $data->age->name }}</td>
                                        <td>{{ $data->education->name }}</td>
                                        <td>{{ $data->job }}</td>
                                        <td>{{ $data->serviceType->name }}</td>
                                        <td>{{ $data->created_at }}</td>
                                        <td class="align-middle">
                                            <a href="{{ route('respondent.detail', ['respondentId' => $data->id]) }}"
                                                class="btn btn-secondary">Detail</a>
                                            <button wire:click="delete({{ $data->id }})"
                                                class="btn btn-danger">Delete</button>
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
