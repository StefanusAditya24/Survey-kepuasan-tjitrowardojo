<div class="container" style="margin:4rem">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title" style="text-align:center">Survei Kepuasan RS Tjitrowardojo Kabupaten Purworejo
            </h5>
            <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin: 2rem -1rem">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                            type="button" role="tab" aria-controls="home-tab-pane"
                            aria-selected="true">Identitas
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                            type="button" role="tab" aria-controls="profile-tab-pane"
                            aria-selected="false">Pertanyaan
                    </button>
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
                            @foreach ($ages as $age)
                                <option value="{{ $age->id }}">{{ $age->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <b>Pendidikan:</b>
                        <select id="pendidikan" wire:model="educationId" class="form-select">
                            <option value="" disabled="" selected="">Pilih Pendidikan Terakhir
                                Anda...
                            </option>
                            @foreach ($educations as $education)
                                <option value="{{ $education->id }}">{{ $education->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <b>Pekerjaan:</b>
                        <select id="pendidikan" wire:model="job" x-model="job" class="form-select">
                            <option value="" disabled="" selected="">Pilih Pekerjaan Anda...
                            </option>
                            @foreach ($jobs as $job)
                                <option value="{{ $job->name }}">
                                    {{ $job->name }}</option>
                            @endforeach
                            <option value="etc">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group mb-3" x-show="job == 'etc'">
                        <b>Masukkan Pekerjaan Lainnya</b>
                        <input type="text" class="form-control" wire:model="job">
                    </div>
                    <div class="form-group mb-3">
                        <b>Jenis Layanan:</b>
                        <select id="pendidikan" wire:model="serviceTypeId" class="form-select">
                            <option value="" disabled="" selected="">Pilih Jenis Layanan...
                            </option>
                            @foreach ($serviceTypes as $serviceType)
                                <option value="{{ $serviceType->id }}">{{ $serviceType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <b>Ruangan Pasien :</b>
                        <select id="pendidikan" wire:model="patientRoomId" class="form-select">
                            <option value="" disabled="" selected="">Pilih Jenis Ruangan...
                            </option>
                            @foreach ($patientRooms as $patientRoom)
                                <option value="{{ $patientRoom->id }}">{{ $patientRoom->room_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                     tabindex="0">
                    @foreach ($questions as $key => $question)
                        <div class="form-group mb-3">
                            <p>{{ $key + 1 . '. ' . $question->name }}</p>
                            @if($question->questionType->id == 1)
                                @foreach($question->questionAnswers as $answer)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio[{{ $key }}]"
                                               value="{{ $answer->id }}"
                                               wire:model="answers.{{ $key }}.answer_id" required>
                                        <label class="form-check-label">
                                            {{ $answer->answer }}
                                        </label>
                                    </div>
                                @endforeach
                            @elseif($question->questionType->id == 2)
                                @foreach($question->questionAnswers as $answerKey => $answer)
                                    <div class="form-check">
                                        @if($answerKey <= 1)
                                            <input class="form-check-input" type="radio" name="radio[{{ $key }}]"
                                                   value="{{ $answer->id }}"
                                                   wire:model="answers.{{ $key }}.answer_id" required>
                                            <label class="form-check-label">
                                                {{ $answer->answer }}
                                            </label>
                                        @else
                                            <input class="form-check-input" type="radio" name="radio[{{ $key }}]"
                                                   value="{{ $answer->id }}"
                                                   wire:model="answers.{{ $key }}.answer_id" required>
                                            <input class="form-control" type="text" placeholder="Lainnya"
                                                   wire:model="answers.{{ $key }}.custom_answer">
                                        @endif
                                    </div>
                                @endforeach

                            @elseif($question->questionType->id == 3)
                                <div class="form-check">
                                    @foreach($question->questionAnswers as $answer)
                                        <input
                                                class="form-control"
                                                type="text"
                                                name="text{{ $key }}"
                                                placeholder="Jawaban Anda"
                                                wire:model="answers.{{ $key }}.custom_answer"
                                        >
                                    @endforeach
                                </div>
                            @endif
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
