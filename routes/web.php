<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ClassController;
use App\Http\Controllers\admin\GradeController;
use App\Http\Controllers\admin\GroupController;
use App\Http\Controllers\admin\StudentController;
use App\Http\Controllers\admin\TeacherController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\assistant\BookIssuanceController;
use App\Http\Controllers\Dep\ApplicationController;
use App\Http\Controllers\Dep\DepController;
use App\Http\Controllers\Dep\DocumentController;
use App\Http\Controllers\Dep\FeeController;
use App\Http\Controllers\Dep\GroupController as DepGroupController;
use App\Http\Controllers\Dep\ObjectionController;
use App\Http\Controllers\Dep\PdfController as DepPdfController;
use App\Http\Controllers\Dep\PrintController as DepPrintCotroller;
use App\Http\Controllers\Dep\RaiseObjectionController;
use App\Http\Controllers\Dep\RecommendationController;
use App\Http\Controllers\Dep\TodayActivityController;
use App\Http\Controllers\Dep\UnderProcessController;
use App\Http\Controllers\assistant\BookController;
use App\Http\Controllers\assistant\BookRackController;
use App\Http\Controllers\assistant\BookReturnController;
use App\Http\Controllers\assistant\ClassController as AssistantClassController;
use App\Http\Controllers\assistant\LibrayAssistantController;
use App\Http\Controllers\assistant\QRCodeController;
use App\Http\Controllers\librarian\BookController as LibrarianBookController;
use App\Http\Controllers\librarian\BookDomainController;
use App\Http\Controllers\librarian\BookRackController as LibrarianBookRackController;
use App\Http\Controllers\librarian\BookReturnPolicyController;
use App\Http\Controllers\librarian\LibrayInchargeController;
use App\Http\Controllers\librarian\QrCodeController as LibrarianQrCodeController;
use App\Http\Controllers\librarian\LibraryRuleController;
use App\Http\Controllers\principal\PrincipalController;
use App\Http\Controllers\principal\TeacherEvaluationController;
use App\Models\BookRack;
use FontLib\Table\Type\cmap;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect(session('role'));
    } else {
        return view('index');
    }
});

Route::view('about', 'about');
Route::view('services', 'services');
Route::view('team', 'team');
Route::view('blogs', 'blogs');
Route::view('login', 'login');

Route::get('login/as', function () {
    $year = date('Y');
    return view('login_as', compact('year'));
});

Route::post('login', [AuthController::class, 'login']);
Route::post('login/as', [AuthController::class, 'loginAs'])->name('login.as');
Route::get('signout', [AuthController::class, 'signout'])->name('signout');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['role:admin']], function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::resource('grades', GradeController::class)->only('index');
    Route::resource('classes', ClassController::class);
    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);

    Route::get('more/teachers/import', [TeacherController::class, 'import'])->name('teachers.import');
    Route::post('more/teachers/import', [TeacherController::class, 'postImport'])->name('teachers.import.post');

    Route::get('students/import/{clas}', [StudentController::class, 'import']);
    Route::post('students/import', [StudentController::class, 'postImport']);

    Route::view('change/password', 'admin.change_password');
    Route::post('change/password', [AuthController::class, 'changePassword'])->name('change.password');

    Route::resource('groups', GroupController::class);
});

Route::group(['prefix' => 'principal', 'as' => 'principal.', 'middleware' => ['role:principal']], function () {
    Route::get('/', [PrincipalController::class, 'index']);
    Route::resource('teacher-evaluation', TeacherEvaluationController::class);
    Route::get('teacher-evaluation-add/{teacher}', [TeacherEvaluationController::class, 'add'])->name('teacher-evaluation.add');
});

Route::group(['prefix' => 'dep', 'as' => 'dep.', 'middleware' => ['role:dep']], function () {
    Route::get('/', [DepController::class, 'index']);
    Route::view('change/password', 'dep.change_password');
    Route::post('change/password', [AuthController::class, 'changePassword'])->name('change.password');
    Route::resource('applications', ApplicationController::class);
    Route::get('change/group/{app}', [ApplicationController::class, 'viewChangeGroup']);
    Route::patch('change/group/{app}', [ApplicationController::class, 'postChangeGroup']);

    Route::resource('objections', ObjectionController::class);
    Route::resource('documents', DocumentController::class);
    Route::resource('fee', FeeController::class);
    Route::resource('underprocess', UnderProcessController::class);
    Route::resource('groups', DepGroupController::class)->only('show');
    Route::get('groups/{group}/print', [DepGroupController::class, 'print'])->name('groups.print');
    Route::get('today/activity', [TodayActivityController::class, 'index']);
    Route::get('print', [DepPrintCotroller::class, 'index']);
    Route::get('pdf/recommended', [DepPdfController::class, 'recommended']);
    Route::get('pdf/objectioned', [DepPdfController::class, 'objectioned']);
    Route::get('pdf/underprocess', [DepPdfController::class, 'underprocess']);
    Route::get('pdf/feepaid', [DepPdfController::class, 'feepaid']);
    Route::get('pdf/finalized', [DepPdfController::class, 'finalized']);
});

Route::group(['prefix' => 'librarian', 'as' => 'librarian.', 'middleware' => ['role:librarian']], function () {
    Route::get('/', [LibrayInchargeController::class, 'index']);
    Route::resource('books', LibrarianBookController::class);
    Route::resource('book-domains', BookDomainController::class);
    Route::resource('book-racks', LibrarianBookRackController::class);
    Route::get('book-racks/print/{rack}', [LibrarianBookRackController::class, 'print'])->name('book-racks.print');
    Route::resource('library-rules', LibraryRuleController::class);
    Route::get('book/search', [LibrarianBookController::class, 'search'])->name('books.search');
    Route::resource('qrcodes', LibrarianQrCodeController::class);

    Route::get('qrcodes/books/preview/{rack}', [LibrarianQrCodeController::class, 'previewBooksQrByRack'])->name('qrcodes.books.preview');

    Route::post('qr/range/create', [LibrarianQrCodeController::class, 'createRangeQr'])->name('qr.range.create');
    Route::get('qr/range/preview', [LibrarianQrCodeController::class, 'previewRangeQr'])->name('qr.range.preview');

    Route::post('qr/specific/create', [LibrarianQrCodeController::class, 'createSpecificQr'])->name('qr.specific.create');
    Route::get('qr/specific/preview', [LibrarianQrCodeController::class, 'previewSpecificQr'])->name('qr.specific.preview');
});

Route::group(['prefix' => 'assistant', 'as' => 'library.assistant.', 'middleware' => ['role:assistant']], function () {
    Route::get('/', [LibrayAssistantController::class, 'index']);
    Route::resource('books', BookController::class)->except('delete');
    Route::resource('book-racks', BookRackController::class)->only('show');

    Route::get('book/search', [BookController::class, 'search'])->name('book.search');
    Route::post('book/search', [BookController::class, 'postSearch'])->name('book.search.post');
    Route::resource('classes', AssistantClassController::class)->only('show');
    Route::get('qrcodes', [QRCodeController::class, 'index'])->name('qrcodes.index');

    Route::get('book-issuance/scan', [BookIssuanceController::class, 'scan'])->name('book-issuance.scan');
    Route::post('book-issuance/scan', [BookIssuanceController::class, 'postScan'])->name('book-issuance.scan.post');
    Route::get('book-issuance/confirm', [BookIssuanceController::class, 'confirm'])->name('book-issuance.confirm');
    Route::post('book-issuance/confirm', [BookIssuanceController::class, 'postConfirm'])->name('book-issuance.confirm.post');
    Route::get('book-issuance/issued', [BookIssuanceController::class, 'issued'])->name('book-issuance.issued');
    Route::get('book-issuance/delayed', [BookIssuanceController::class, 'delayed'])->name('book-issuance.delayed');
    Route::get('book-issuance/default', [BookIssuanceController::class, 'default'])->name('book-issuance.default');

    Route::get('book-return/scan', [BookReturnController::class, 'scan'])->name('book-return.scan');
    Route::post('book-return/scan', [BookReturnController::class, 'postScan'])->name('book-return.scan.post');
    Route::get('book-return/confirm', [BookReturnController::class, 'confirm'])->name('book-return.confirm');
    Route::patch('book-return/confirm/{book_issuance}', [BookReturnController::class, 'postConfirm'])->name('book-return.confirm.post');

    Route::get('qrcodes/books/preview/{rack}', [QRCodeController::class, 'previewBooksQR'])->name('qrcodes.books.preview');
    Route::get('qrcodes/teachers/preview', [QRCodeController::class, 'previewTeachersQR'])->name('qrcodes.teachers.preview');
    Route::get('qrcodes/students/preview/{clas}', [QRCodeController::class, 'previewStudentsQR'])->name('qrcodes.students.preview');
});
