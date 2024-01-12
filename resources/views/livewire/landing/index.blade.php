<div class="container" style="margin:4rem">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title" style="text-align:center">Survei Kepuasan RS Tjitrowardojo Kabupaten Purworejo
            </h5>
            <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin: 2rem -1rem">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                        type="button" role="tab" aria-controls="home-tab-pane"
                        aria-selected="true">Identitas</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane"
                        aria-selected="false">Pertanyaan</button>
                </li>
            </ul>
            <form class="tab-content" id="myTabContent" wire:submit="save" method="POST">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0" x-data="{ job: '' }">
                    <div class="form-group mb-3">
                        <b>Nama Anda :</b>
                        <input type="text" class="form-control" wire:model="name">
                    </div>
                    <div class="form-group mb-3">
                        <b>Nomor Hp :</b>
                        <input type="text" class="form-control" wire:model="phoneNumber">
                    </div>
                    <div class="form-group mb-3">
                        <b>Jenis Kelamin:</b>
                        <select wire:model="gender" id="" class="form-select">
                            <option value="" disabled="" selected="">Pilih Jenis Kelamin Anda...</option>
                            <option value="male">Laki-Laki</option>
                            <option value="female">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <b>Usia Anda:</b>
                        <select id="usia" wire:model="ageId" class="form-select">
                            <option value="" disabled="" selected="">Pilih Usia Anda...</option>
                            @foreach ($ageDatas as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <b>Pendidikan:</b>
                        <select id="pendidikan" wire:model="educationId" class="form-select">
                            <option value="" disabled="" selected="">Pilih Pendidikan Terakhir
                                Anda...</option>
                            @foreach ($educationDatas as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <b>Pekerjaan:</b>
                        <select id="pendidikan" wire:model="job" x-model="job" class="form-select">
                            <option value="" disabled="" selected="">Pilih Pekerjaan Anda...
                            </option>
                            @foreach ($jobDatas as $data)
                                <option value="{{ $data->name }}">
                                    {{ $data->name }}</option>
                            @endforeach
                            <option value="etc">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group mb-3" x-show="job == 'etc'">
                        <b>Masukkan Pekerjaan Lainnya</b>
                        <input type="text" class="form-control" wire:model="job">
                    </div>
                    <div class="form-group ">
                        <b>Jenis Layanan:</b>
                        <select id="pendidikan" wire:model="serviceTypeId" class="form-select">
                            <option value="" disabled="" selected="">Pilih Jenis Layanan...
                            </option>
                            @foreach ($serviceTypeDatas as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0">
                    @foreach ($questionDatas as $key => $data)
                        <div class="form-group mb-3">
                            <p>{{ $key + 1 . '. ' . $data->name }}</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio[{{ $key }}]"
                                    value="Tidak Sesuai" wire:model="answers.{{ $key }}.answer" required>
                                <label class="form-check-label" for="exampleRadios1">
                                    Tidak Sesuai
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio[{{ $key }}]"
                                    value="Kurang Sesuai" wire:model="answers.{{ $key }}.answer" required>
                                <label class="form-check-label" for="exampleRadios2">
                                    Kurang Sesuai
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio[{{ $key }}]"
                                    value="Sesuai" wire:model="answers.{{ $key }}.answer" required>
                                <label class="form-check-label" for="exampleRadios2">
                                    Sesuai
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio[{{ $key }}]"
                                    value="Sangat Sesuai" wire:model="answers.{{ $key }}.answer" required>
                                <label class="form-check-label" for="exampleRadios2">
                                    Sangat Sesuai
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio[{{ $key }}]"
                                    value="lainnya" required>
                                <input type="text" placeholder="Lainnya"
                                    wire:model="answers.{{ $key }}.answer">
                            </div>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
