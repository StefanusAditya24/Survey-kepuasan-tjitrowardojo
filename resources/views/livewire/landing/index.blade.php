<div class="container mx-auto mt-5">
    <div class="card" style="background-color: rgba(255, 255, 255, 0.5);">
        <div class="card-body">
            <h5 class="card-title" style="text-align:center">Survei Kepuasan RS Tjitrowardojo Kabupaten Purworejo
            </h5>
            <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin: 2rem -1rem">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" wire:click="setActiveTab('personal')" role="tab"
                            aria-controls="home-tab-pane"
                            aria-selected="{{ $activeTab === 'personal' ? 'true' : 'false' }}">Identitas
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" wire:click="setActiveTab('questions')" role="tab"
                            aria-controls="profile-tab-pane"
                            aria-selected="{{ $activeTab === 'questions' ? 'true' : 'false' }}">Pertanyaan
                    </button>
                </li>
            </ul>
            <form class="tab-content" id="myTabContent" wire:submit.prevent="save" method="POST">
                <div class="tab-pane fade {{ $activeTab === 'personal' ? 'show active' : '' }}" id="home-tab-pane"
                     role="tabpanel" aria-labelledby="home-tab" tabindex="0" x-data="{ job: '' }">
                    <div wire:key="personalTab">
                        <div class="form-group mb-3">
                            <b>Nama Anda :</b>
                            <input type="text" class="form-control" wire:model="name" id="name">
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
                            <select id="age" wire:model="ageId" class="form-select">
                                <option value="" disabled="" selected="">Pilih Usia Anda...</option>
                                @foreach ($ages as $age)
                                    <option value="{{ $age->id }}">{{ $age->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <b>Pendidikan:</b>
                            <select id="education" wire:model="educationId" class="form-select">
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
                            <select id="job" wire:model="job" x-model="job" class="form-select">
                                <option value="" disabled="" selected="">Pilih Pekerjaan Anda...
                                </option>
                                @foreach ($jobs as $job)
                                    <option value="{{ $job->name }}">
                                        {{ $job->name }}</option>
                                @endforeach
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group mb-3" x-show="job == 'lainnya'">
                            <b>Masukkan Pekerjaan Lainnya</b>
                            <input type="text" class="form-control" wire:model="job">
                        </div>
                        <div class="form-group mb-3">
                            <b>Jenis Layanan:</b>
                            <select id="serviceType" wire:key="serviceType"
                                    wire:change="selectService($event.target.value)"
                                    class="form-select">
                                <option value="" disabled="" selected="">Pilih Jenis Layanan...</option>
                                @foreach ($serviceTypes as $type)
                                    <option value="{{ json_encode(['id' => $type->id, 'name' => $type->name]) }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($selectedService == "Rawat Inap")
                            <div class="form-group">
                                <b>Ruangan Pasien :</b>
                                <select id="patientRoom" wire:key="patientRoom" wire:model="patientRoomId"
                                        class="form-select">
                                    <option value="" disabled="" selected="">Pilih Jenis Ruangan...</option>

                                    @foreach ($patientRooms->sortBy('room_name') as $patientRoom)
                                        <option value="{{ $patientRoom->id }}">{{ $patientRoom->room_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        @endif
                        @if($selectedService == "Rawat Jalan")
                            <div class="form-group">
                                <b>Poliklinik :</b>
                                <select id="polyclinic" wire:key="polyclinic" wire:model="polyclinicId"
                                        class="form-select">
                                    <option value="" disabled="" selected="">Pilih Poliklinik...</option>

                                    @foreach ($polyclinics->sortBy('poly_name') as $polyclinic)
                                        <option value="{{ $polyclinic->id }}">{{ $polyclinic->poly_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        @endif
                    </div>
                </div>
                <div class="tab-pane fade {{ $activeTab === 'questions' ? 'show active' : '' }}" id="profile-tab-pane"
                     role="tabpanel">
                    <div wire:key="questionTab">
                        @if($currentPage === 1)
                            @foreach ($page1Questions as $key => $question)
                                <!-- Display questions for page 1 -->
                                <div class="form-group mb-3">
                                    <p>{{ $key + 1 . '. ' . $question->name }}</p>
                                    @foreach($question->questionAnswers as $answerKey => $answer)
                                        <div class="form-check" wire:key="{{ $key . '-' . $answerKey }}">
                                            <input class="form-check-input" type="radio" name="radio[{{ $key }}]"
                                                   value="{{ $answer->id }}"
                                                   wire:model="answers.{{ $key }}.answer_id" required>
                                            <label class="form-check-label">
                                                {{ $answer->answer }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                            <div class="text-right">
                                <button wire:click="nextPage" class="btn btn-primary" type="button">Next</button>
                            </div>
                        @elseif($currentPage === 2)
                            @foreach ($page2Questions as $key => $question)
                                <!-- Display questions for page 2 -->
                                <div class="form-group mb-3">
                                    <p>{{ $key + 1 . '. ' . $question->name }}</p>
                                    @if($question->questionType->id == 2)
                                        @foreach($question->questionAnswers as $answerKey => $answer)
                                            <div class="form-check" wire:key="{{ $key . '-' . $answerKey }}">
                                                @if($answerKey <= 1)
                                                    <input class="form-check-input" type="radio" name="radio[{{ $key }}]"
                                                           value="{{ $answer->id }}"
                                                           wire:change="updateAnswer('{{ $key }}', '{{ $answer->answer }}')"
                                                           wire:model="answers.{{ $key }}.answer_id" required>
                                                    <label class="form-check-label">
                                                        {{ $answer->answer }}
                                                    </label>
                                                @else
                                                    <input class="form-check-input" type="radio" name="radio[{{ $key }}]"
                                                           value="{{ $answer->id }}"
                                                           wire:change="updateAnswer('{{ $key }}', '{{ $answer->answer }}')"
                                                           wire:model="answers.{{ $key }}.answer_id" required>
                                                    <input class="form-control"
                                                           type="text"
                                                           placeholder="Lainnya"
                                                           wire:model.defer="answers.{{ $key }}.custom_answer"
                                                            {{ $answers[$key]['disabled_custom'] ? 'disabled' : '' }}>
                                                @endif
                                            </div>
                                        @endforeach
                                    @elseif($question->questionType->id == 3)
                                        <div class="form-check">
                                            @foreach($question->questionAnswers as $answerKey => $answer)
                                                <input class="form-control"
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
                            <div class="text-right">
                                <button wire:click="previousPage" class="btn btn-primary" type="button">Previous</button>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
