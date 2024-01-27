<?php

namespace App\Livewire\Landing;

use App\Repository\AgeRepository;
use App\Repository\EducationRepository;
use App\Repository\JobRepository;
use App\Repository\PatientRoomRepository;
use App\Repository\PolyclinicRepository;
use App\Repository\QuestionRepository;
use App\Repository\RespondentAnswerRepository;
use App\Repository\RespondentRepository;
use App\Repository\ServiceTypeRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    public Collection $ages;
    public Collection $educations;
    public Collection $jobs;
    public Collection $serviceTypes;
    public Collection $questions;
    public Collection $patientRooms;
    public Collection $polyclinics;

    public string $activeTab = "personal";
    public int $currentPage = 1;
    public string $name = "";
    public string $phoneNumber = "";
    public string $gender = "";
    public string $ageId = "";
    public string $educationId = "";
    public string $job = "";
    public string $serviceTypeId = "";
    public string $patientRoomId = "";
    public string $polyclinicId = "";
    public string $selectedService = "";
    public array $answers = [];

    public function __construct(
        protected AgeRepository $ageRepository = new AgeRepository(),
        protected EducationRepository $educationRepository = new EducationRepository(),
        protected JobRepository $jobRepository = new JobRepository(),
        protected ServiceTypeRepository $serviceTypeRepository = new ServiceTypeRepository(),
        protected QuestionRepository $questionRepository = new QuestionRepository(),
        protected RespondentRepository $respondentRepository = new RespondentRepository(),
        protected RespondentAnswerRepository $respondentAnswerRepository = new RespondentAnswerRepository(),
        protected PatientRoomRepository $patientRoomRepository = new PatientRoomRepository(),
        protected PolyclinicRepository $polyclinicRepository = new PolyclinicRepository()
    ) {
    }

    public function mount(): void
    {
        $this->ages = $this->ageRepository->getAges();
        $this->educations = $this->educationRepository->getEducations();
        $this->jobs = $this->jobRepository->getJobs();
        $this->serviceTypes = $this->serviceTypeRepository->getServiceTypes();
        $this->questions = $this->questionRepository->getQuestions();
        $this->patientRooms = $this->patientRoomRepository->getPatientRooms();
        $this->polyclinics = $this->polyclinicRepository->getPolyclinics();
        foreach ($this->questions as $key => $question) {
            $this->answers[] = [
                'id' => $question->id,
                'answer_id' => ($key === count($this->questions) - 1) ? optional($question->questionAnswers()->first())->id : '',
                'custom_answer' => '',
                'disabled_custom' => true
            ];
        }
    }

    public function save(): mixed
    {
        $respondentData = [
            'name' => $this->name,
            'phone_number' => $this->phoneNumber,
            'gender' => $this->gender,
            'age_id' => $this->ageId,
            'education_id' => $this->educationId,
            'job' => $this->job,
            'service_type_id' => $this->serviceTypeId,
            'patient_room_id' => empty($this->patientRoomId) ? null : $this->patientRoomId,
            'polyclinic_id' => empty($this->polyclinicId) ? null : $this->polyclinicId,
        ];

        $validator = Validator::make($respondentData, [
            'name' => 'required',
            'phone_number' => 'required',
            'gender' => 'required',
            'age_id' => 'required',
            'education_id' => 'required',
            'job' => 'required',
            'service_type_id' => 'required',
        ]);

        if ($validator->fails())
            return $this->dispatch('showError', $validator->errors());

        DB::beginTransaction();
        try {
            $respondent = $this->respondentRepository->addRespondent($respondentData);
            foreach ($this->answers as $answer) {
                $this->respondentAnswerRepository->addRespondentAnswer([
                    'respondent_id' => $respondent->id,
                    'question_id' => $answer['id'],
                    'answer_id' => $answer['answer_id'],
                    'custom_answer' => $answer['custom_answer']
                ]);
            }
            DB::commit();
            return redirect(route('home'))->with('status', 'Survei berhasil diinput');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect(route('home'))->with('error', 'Survei gagal diinput');
        }
    }

    public function setActiveTab($tab): void
    {
        $this->activeTab = $tab;
    }

    public function setAnswerId($key, $answerId): void
    {
        $this->answers[$key]['answer_id'] = $answerId;
    }

    public function selectService(string $serviceType): void
    {
        $data = json_decode($serviceType, true);
        if ($data) {
            $this->serviceTypeId = $data['id'];
            $this->selectedService = $data['name'];
        }
    }

    public function nextPage(): void
    {
        $this->currentPage++;
    }

    public function previousPage(): void
    {
        $this->currentPage--;
    }

    public function updateAnswer(string $key, string $value): void
    {
        if ($value === "Lainnya")
            $this->answers[$key]['disabled_custom'] = false;
        else
            $this->answers[$key]['disabled_custom'] = true;
    }

    #[Layout('layouts.landing.app')]
    public function render(): View
    {
        $page1Questions = $this->questions->where('questionType.id', 1);
        $page2Questions = $this->questions->where('questionType.id', '>', 1);

        return view('livewire.landing.index', [
            'page1Questions' => $page1Questions,
            'page2Questions' => $page2Questions,
        ]);
    }
}
