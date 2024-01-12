<?php

use App\Livewire\Landing\Index as LandingIndex;

use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Login;
use App\Livewire\Admin\Respondent\Index as RespondentIndex;
use App\Livewire\Admin\Respondent\Detail as RespondentDetail;
use App\Livewire\Admin\Question\Index as QuestionIndex;
use App\Livewire\Admin\Question\Form as QuestionForm;
use App\Livewire\Admin\Age\Index as AgeIndex;
use App\Livewire\Admin\Age\Form as AgeForm;
use App\Livewire\Admin\Education\Index as EducationIndex;
use App\Livewire\Admin\Education\Form as EducationForm;
use App\Livewire\Admin\Job\Index as JobIndex;
use App\Livewire\Admin\Job\Form as JobForm;
use App\Livewire\Admin\ServiceType\Index as ServiceTypeIndex;
use App\Livewire\Admin\ServiceType\Form as ServiceTypeForm;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', LandingIndex::class)->name('home');

Route::prefix('admin')->group(function () {
    Route::get('login', Login::class)->name('login')->middleware('guest');
    Route::middleware('auth')->group(function () {
        Route::get('', Dashboard::class)->name('dashboard');
        Route::get('logout', function () {
            auth()->logout();
            return redirect(route('login'));
        })->name('logout');

        Route::prefix('respondent')->name('respondent.')->group(function () {
            Route::get('', RespondentIndex::class)->name('index');
            Route::get('detail/{respondentId?}', RespondentDetail::class)->name('detail');
        });

        Route::prefix('question')->name('question.')->group(function () {
            Route::get('', QuestionIndex::class)->name('index');
            Route::get('form/{questionId?}', QuestionForm::class)->name('form');
        });

        Route::prefix('age')->name('age.')->group(function () {
            Route::get('', AgeIndex::class)->name('index');
            Route::get('form/{ageId?}', AgeForm::class)->name('form');
        });

        Route::prefix('education')->name('education.')->group(function () {
            Route::get('', EducationIndex::class)->name('index');
            Route::get('form/{educationId?}', EducationForm::class)->name('form');
        });

        Route::prefix('job')->name('job.')->group(function () {
            Route::get('', JobIndex::class)->name('index');
            Route::get('form/{jobId?}', JobForm::class)->name('form');
        });

        Route::prefix('service-type')->name('service-type.')->group(function () {
            Route::get('', ServiceTypeIndex::class)->name('index');
            Route::get('form/{serviceTypeId?}', ServiceTypeForm::class)->name('form');
        });
    });
});
