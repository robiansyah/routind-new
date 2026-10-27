<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CaptchaServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SptController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\BupotController;
use App\Http\Controllers\EformController;
use App\Http\Controllers\Eform1770Controller;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FakturController;
use App\Http\Controllers\PPh21Controller;
use App\Http\Controllers\TripayCallbackController;
use App\Http\Controllers\RuangKelasController;
use App\Http\Controllers\AcademyController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\QrcodeController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\ReferralController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\SendEmailController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\PartnershipController;
use App\Http\Controllers\Admin\HeaderController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\PerformanceController;
use App\Http\Controllers\Admin\AdvertisementController;

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

//QRCODE CEK
Route::get('/qrcode/{type}', [QrcodeController::class, 'check'])->name('qrcode.check');

Route::group(['middleware' => 'guest'], function(){
    Route::get('/', [AcademyController::class, 'index']);
//    Route::get('/', function () {
//        return view('auth.login');
//    });
});

Auth::routes(['verify' => true]);
/**
 * socialite auth
 */
Route::get('/auth/{provider}', [App\Http\Controllers\Auth\SocialiteController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [App\Http\Controllers\Auth\SocialiteController::class, 'handleProvideCallback']);

Route::get('/reload-captcha', [CaptchaServiceController::class, 'reloadCaptcha'])->name('reload');

Route::get('/approval', [HomeController::class, 'approval'])->name('approval');
Route::post('/callback', [TripayCallbackController::class, 'handle']);

Route::get('/academy', [AcademyController::class, 'index'])->name('academy');
Route::get('/events/{category?}', [AcademyController::class, 'event'])->name('event');
Route::get('/events/{slug}/detail', [AcademyController::class, 'eventNew'])->name('event.show');
Route::get('/events/{slug}/new', [AcademyController::class, 'eventNew'])->name('event.new');
Route::get('/events/{slug}/checkout', [AcademyController::class, 'eventCheckout'])->name('event.checkout');
//Route::get('/events/{id}/payment', [AcademyController::class, 'eventCheckoutId'])->name('event.payment.id');
Route::get('/events/{id}/payment', [AcademyController::class, 'eventCheckoutDoku'])->name('event.payment.id');
Route::post('/events/payment', [AcademyController::class, 'eventCheckoutNew'])->name('event.payment');
Route::post('/discount', [AcademyController::class, 'discount'])->name('event.discount');
Route::post('/cost', [AcademyController::class, 'cost'])->name('event.cost');
//Route::post('/checkout', [AcademyController::class, 'checkout'])->name('event.checkout.store');
Route::post('/checkout', [AcademyController::class, 'checkoutDoku'])->name('event.checkout.store');
Route::get('/order', [AcademyController::class, 'order'])->name('order.index');
Route::post('/order', [AcademyController::class, 'orderCheck'])->name('order.check');
Route::get('/order/{order}', [AcademyController::class, 'orderDetail'])->name('order.show');
Route::get('/partnership', [AcademyController::class, 'partnership'])->name('partnership');
Route::post('/partnership', [AcademyController::class, 'partnershipStore'])->name('partnership.store');
Route::get('/certificates/{code}', [AcademyController::class, 'certificates'])->name('certificate');
Route::get('/coursecertificate/{code}', [AcademyController::class, 'certificate'])->name('print.certificate');
//Route::get('/certificate', [AcademyController::class, 'certificateForm'])->name('certificate.form');
//Route::post('/certificate', [AcademyController::class, 'certificateCheck'])->name('certificate.check');
Route::get('/brevetcertificate/{code}', [PrintController::class, 'brevet'])->name('brevet.certificate');
Route::get('/brevetblank/{code}', [PrintController::class, 'brevet_blank'])->name('blank.certificate');

Route::get('/xendit', [AcademyController::class, 'xendit'])->name('xendit');
Route::get('/alumni', [AcademyController::class, 'alumni'])->name('alumni');

Route::get('/terms', [AcademyController::class, 'terms'])->name('terms');

Route::post('/coXendit', [AcademyController::class, 'coXendit'])->name('coXendit');
Route::get('/doku/callback', [AcademyController::class, 'dokuReturn'])->name('doku.callback.web');

//Route::any('{catchall}', [App\Http\Controllers\PageController::class, 'notfound'])->where('catchall', '.*');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/informasi', [UserController::class, 'index'])->name('pelajar.index');
    Route::get('/profil', [UserController::class, 'profile'])->name('pelajar.profil');
    Route::put('/profil', [UserController::class, 'profileUpdate'])->name('pelajar.profil.update');
    Route::get('/profil/password', [UserController::class, 'changePassword'])->name('pelajar.password');
    Route::post('/profil/password', [UserController::class, 'updatePassword'])->name('pelajar.password.update');
    Route::get('/pengaturan', [UserController::class, 'setting'])->name('pelajar.setting');
    Route::get('/pengaturan/kelas', [UserController::class, 'kelas'])->name('pelajar.setting.kelas');
    Route::post('/pengaturan/{type}', [UserController::class, 'updateSetting'])->name('pelajar.setting.update');
    Route::get('/paket', [UserController::class, 'paket'])->name('pelajar.paket');
    Route::get('/paket/{type}/checkout', [UserController::class, 'paketCheckout'])->name('pelajar.paket.checkout');
    Route::post('/paket/checkout', [UserController::class, 'checkout'])->name('pelajar.checkout');
    Route::post('/paket/discount', [UserController::class, 'discount'])->name('pelajar.discount');
    Route::post('/paket/cost', [UserController::class, 'cost'])->name('pelajar.cost');

    Route::get('/invoice', [UserController::class, 'invoice'])->name('pelajar.invoice');
    Route::get('/invoice/{code}', [UserController::class, 'invoiceDetail'])->name('pelajar.invoice.detail');
    Route::get('/invoice/{code}/batal', [UserController::class, 'invoiceCancel'])->name('pelajar.invoice.cancel');
    Route::get('/bayar', [UserController::class, 'pay'])->name('pelajar.bayar');
    Route::get('/lapor', [UserController::class, 'report'])->name('pelajar.lapor');
    Route::get('/pralapor', [UserController::class, 'praReport'])->name('pelajar.pralapor');
    Route::post('/kartu-npwp', [UserController::class, 'getNpwp'])->name('pelajar.kartu');


    Route::get('/coba', [BillingController::class, 'coba'])->name('pelajar.coba');
    Route::get('/billing', [BillingController::class, 'createPay'])->name('pelajar.billing');
    Route::get('/billing/{id}/show', [BillingController::class, 'showPay'])->name('pelajar.billing.show');
    Route::get('/billing/belum', [BillingController::class, 'index'])->name('pelajar.billing.index');
    Route::get('/billing/bayar/{id}', [BillingController::class, 'bayar'])->name('pelajar.billing.bayar');
    Route::get('/billing/getKdMap', [BillingController::class, 'getType'])->name('pelajar.billing.kode.tipe');
    Route::get('/billing/getNominal', [BillingController::class, 'getNominal'])->name('pelajar.billing.tahun');
    Route::post('/billing/getBillingCode', [BillingController::class, 'getBillingCode'])->name('pelajar.billing.kode');
    Route::post('/billing/cetakBilling', [BillingController::class, 'cetakBilling'])->name('pelajar.billing.cetak');
    Route::post('/billing/code', [BillingController::class, 'codeBilling'])->name('pelajar.billing.code');
    Route::get('/billing/payment', [BillingController::class, 'payment'])->name('pelajar.billing.payment');
    Route::post('/billing/inquiry', [BillingController::class, 'inquiry'])->name('pelajar.billing.inquiry');
    Route::get('/billing/inquiry/{bill}', [BillingController::class, 'inquiryDetail'])->name('pelajar.billing.inquiryDetail');
    Route::post('/billing/verify/{id}', [BillingController::class, 'verify'])->name('pelajar.billing.verify');


    Route::get('/spt/arsip', [SptController::class, 'index'])->name('pelajar.spt.arsip');
    Route::get('/spt/buat', [SptController::class, 'create'])->name('pelajar.spt.buat');
    Route::get('/spt/draf', [SptController::class, 'draft'])->name('pelajar.spt.draf');
    Route::get('/spt/bantuan', [SptController::class, 'help'])->name('pelajar.spt.bantuan');
    Route::get('/spt/rev', [SptController::class, 'rev'])->name('pelajar.spt.rev');
    Route::post('/spt/pbyrn', [SptController::class, 'ntpn'])->name('pelajar.spt.ntpn');
    Route::post('/spt/data', [SptController::class, 'data'])->name('pelajar.spt.data');
    Route::post('/spt/simpan', [SptController::class, 'store'])->name('pelajar.spt.simpan');
    Route::post('/spt/draft', [SptController::class, 'store'])->name('pelajar.spt.draft');
    Route::get('/spt/preview/{id}', [SptController::class, 'preview'])->name('pelajar.spt.preview');
    Route::get('/spt/{id}/detail', [SptController::class, 'detail'])->name('pelajar.spt.detail');
    Route::delete('/spt/{id}', [SptController::class, 'destroy'])->name('pelajar.spt.destroy');
    Route::get('/efile/{type}/{spt?}', [SptController::class, 'efile'])->name('pelajar.spt.efile');
    Route::post('/spt/dashboard/{type}', [SptController::class, 'dashboard'])->name('pelajar.spt.dashboard');

    Route::get('/eform', [EformController::class, 'index'])->name('pelajar.eform.index');
    Route::get('/eform/arsip', [EformController::class, 'index'])->name('pelajar.eform.arsip');
    Route::get('/eform/buat', [EformController::class, 'create'])->name('pelajar.eform.buat');
    Route::post('/eform/{type}', [EformController::class, 'store'])->name('pelajar.eform.store');
    Route::get('/eform/draf', [EformController::class, 'draft'])->name('pelajar.eform.draf');
    Route::get('/eform/1771/{id}', [EformController::class, 'corporate'])->name('pelajar.eform.1771');
    Route::get('/eform/1771/{id}/detail', [EformController::class, 'detail'])->name('pelajar.eform.1771.detail');
    Route::get('/eform/view/{type}/{spt_id}', [EformController::class, 'datatableView'])->name('eform.view');
    Route::post('/eform/store/{type}/{spt_id}', [EformController::class, 'storeAjax'])->name('eform.store');
    Route::get('/eform/{type}/{id}/edit', [EformController::class, 'editAjax'])->name('eform.edit');
    Route::delete('/eform/{type}/{id}', [EformController::class, 'destroyAjax'])->name('eform.destroy');
    Route::post('/eform/update/{type}', [EformController::class, 'editableUpdate'])->name('eform.editable.update');
    Route::post('/eform/1771/{id}', [EformController::class, 'submit'])->name('eform.submit');

    Route::get('/eform/1770/{id}', [Eform1770Controller::class, 'business'])->name('pelajar.eform.1770');
    Route::get('/eform/1770/{id}/detail', [Eform1770Controller::class, 'detail'])->name('pelajar.eform.1770.detail');
    Route::get('/eform/1770/view/{type}/{spt_id}', [Eform1770Controller::class, 'datatableView'])->name('eform.1770.view');
    Route::post('/eform/1770/store/{type}/{spt_id}', [Eform1770Controller::class, 'storeAjax'])->name('eform.1770.store');
    Route::get('/eform/1770/{type}/{id}/edit', [Eform1770Controller::class, 'editAjax'])->name('eform.1770.edit');
    Route::delete('/eform/1770/{type}/{id}', [Eform1770Controller::class, 'destroyAjax'])->name('eform.1770.destroy');
    Route::post('/eform/1770/update/{type}', [Eform1770Controller::class, 'editableUpdate'])->name('eform.1770.editable.update');
    Route::post('/eform/1770/{id}', [Eform1770Controller::class, 'submit'])->name('eform.1770.submit');


    Route::post('/ajax/{type}', [EformController::class, 'commonAjax'])->name('pelajar.eform.ajax');

    Route::get('/ref/ptkp', [SptController::class, 'rev'])->name('pelajar.ref.ptkp');
    Route::post('/ref/npwp', [SptController::class, 'refNpwp'])->name('pelajar.ref.npwp');
    Route::get('/ref/trfpph', [SptController::class, 'refpph'])->name('pelajar.ref.pph');

    Route::post('/submit/token', [VerificationController::class, 'sendCode'])->name('pelajar.token.kirim');
    Route::post('/submit/spt', [VerificationController::class, 'verifyCode'])->name('pelajar.token.verif');
    Route::post('/submit/feedback', [VerificationController::class, 'feedback'])->name('pelajar.feddback');
    Route::post('/sendbpe', [VerificationController::class, 'sendBpe'])->name('pelajar.bpe');

    Route::get('/ebupot/dashboard', [BupotController::class, 'index'])->name('ebupot.index');
    Route::get('/ebupot/pph/{type}', [BupotController::class, 'pph'])->name('ebupot.pph.index');
    Route::post('/ebupot/pph/{type}', [BupotController::class, 'pph'])->name('ebupot.pph');
    Route::get('/ebupot/spt', [BupotController::class, 'spt'])->name('ebupot.spt');
    Route::post('/ebupot/spt', [BupotController::class, 'storeSpt'])->name('ebupot.spt.store');
    Route::get('/ebupot/spt/{id}/detail', [BupotController::class, 'detailSpt'])->name('ebupot.spt.detail');
    Route::get('/ebupot/spt/{id}', [BupotController::class, 'setorSpt'])->name('ebupot.spt.setor');
//    Route::get('/ebupot/spt/{id}/{status}', [BupotController::class, 'statusSpt'])->name('ebupot.spt.status');
    Route::post('/ebupot/spt/{id}/{status}', [BupotController::class, 'statusSpt'])->name('ebupot.spt.status');
    Route::get('/ebupot/pengaturan/{type}', [BupotController::class, 'setting'])->name('ebupot.setting');

    Route::get('/ebupot/print', [BupotController::class, 'cetak'])->name('ebupot.print');
    Route::get('/ebupot/cetak/{id}/spt', [BupotController::class, 'cetakSpt'])->name('ebupot.spt.cetak');

    Route::post('/api/pph/{type}', [BupotController::class, 'pphApi'])->name('ebupot.pph.api');
    Route::post('/api/common/{type}', [BupotController::class, 'commonApi'])->name('ebupot.common.api');
    Route::post('/api/spt/{type}', [BupotController::class, 'sptApi'])->name('ebupot.spt.api');

    Route::get('/faktur/nsfp', [FakturController::class, 'nsfp'])->name('faktur.nsfp');
    Route::post('/faktur/nsfp', [FakturController::class, 'storeNsfp'])->name('faktur.nsfp.store');
    Route::get('/faktur/pajak/{type}', [FakturController::class, 'pajak'])->name('faktur.pajak');
    Route::post('/faktur/pajak/keluaran/tambah', [FakturController::class, 'createPajak'])->name('faktur.pajak.tambah');
    Route::post('/faktur/pajak/{type}', [FakturController::class, 'storePajak'])->name('faktur.pajak.store');
    Route::get('/faktur/pajak/{type}/{id}/edit', [FakturController::class, 'editPajak'])->name('faktur.pajak.edit');
    Route::get('/faktur/pajak/{type}/{id}/detail', [FakturController::class, 'detailPajak'])->name('faktur.pajak.detail');
    Route::get('/faktur/pajak/{type}/{id}/pengganti', [FakturController::class, 'changePajak'])->name('faktur.pajak.pengganti');
    Route::put('/faktur/pajak/{type}/{id}', [FakturController::class, 'updatePajak'])->name('faktur.pajak.update');
    Route::get('/faktur/pajak/{type}/{id}', [FakturController::class, 'destroyPajak'])->name('faktur.pajak.destroy');
//    Route::get('/faktur/pajak/{type}/{id}/{status}', [FakturController::class, 'statusPajak'])->name('faktur.pajak.status');
    Route::post('/faktur/pajak/{type}/{id}/{status}', [FakturController::class, 'statusPajak'])->name('faktur.pajak.status');

    Route::get('/faktur/retur/{type}', [FakturController::class, 'retur'])->name('faktur.retur');
    Route::post('/faktur/retur/{type}', [FakturController::class, 'storeRetur'])->name('faktur.retur.store');
    Route::get('/faktur/retur/{type}/{id}/edit', [FakturController::class, 'editRetur'])->name('faktur.retur.edit');
    Route::get('/faktur/retur/{type}/{id}', [FakturController::class, 'destroyRetur'])->name('faktur.retur.destroy');
    Route::get('/faktur/retur/{type}/{id}/{status}', [FakturController::class, 'statusRetur'])->name('faktur.retur.status');

    Route::get('/faktur/other/{type}', [FakturController::class, 'other'])->name('faktur.other');
    Route::post('/faktur/other/{type}', [FakturController::class, 'storeOther'])->name('faktur.other.store');
    Route::get('/faktur/other/{type}/{id}/edit', [FakturController::class, 'editOther'])->name('faktur.other.edit');
    Route::get('/faktur/other/{type}/{id}', [FakturController::class, 'destroyOther'])->name('faktur.other.destroy');
//    Route::get('/faktur/other/{type}/{id}/{status}', [FakturController::class, 'statusOther'])->name('faktur.other.status');
    Route::post('/faktur/other/{type}/{id}/{status}', [FakturController::class, 'statusOther'])->name('faktur.other.status');

    Route::get('/faktur/spt', [FakturController::class, 'spt'])->name('faktur.spt');
    Route::post('/faktur/spt', [FakturController::class, 'storeSpt'])->name('faktur.spt.store');
    Route::get('/faktur/spt/{id}/detail', [FakturController::class, 'detailSpt'])->name('faktur.spt.detail');
    Route::put('/faktur/spt/{id}', [FakturController::class, 'updateSpt'])->name('faktur.spt.update');
//    Route::get('/faktur/spt/{id}/{status}', [FakturController::class, 'statusSpt'])->name('faktur.spt.status');
    Route::post('/faktur/spt/{id}/{status}', [FakturController::class, 'statusSpt'])->name('faktur.spt.status');


    Route::get('/faktur/produk/view/{invoice_id}', [FakturController::class, 'viewProduk'])->name('faktur.produk.view');
    Route::post('/faktur/produk/store/{invoice_id}', [FakturController::class, 'storeProduk'])->name('faktur.produk.store');
    Route::get('/faktur/produk/{id}/edit', [FakturController::class, 'editProduk'])->name('faktur.produk.edit');
    Route::delete('/faktur/produk/{id}', [FakturController::class, 'destroyProduk'])->name('faktur.produk.destroy');

    Route::get('/faktur/referensi/{type}', [FakturController::class, 'referensi'])->name('faktur.referensi');
    Route::post('/faktur/referensi/{type}', [FakturController::class, 'storeReferensi'])->name('faktur.referensi.store');
    Route::get('/faktur/referensi/{type}/{id}/edit', [FakturController::class, 'editReferensi'])->name('faktur.referensi.edit');
    Route::put('/faktur/referensi/{type}/{id}', [FakturController::class, 'updateReferensi'])->name('faktur.referensi.update');
    Route::get('/faktur/referensi/{type}/{id}', [FakturController::class, 'destroyReferensi'])->name('faktur.referensi.destroy');

    Route::get('/faktur/cetak/{id}', [FakturController::class, 'cetakPajak'])->name('faktur.pajak.cetak');
    Route::get('/faktur/cetak/spt/{id}', [FakturController::class, 'cetakSpt'])->name('faktur.pajak.spt.cetak');
    Route::get('/faktur/cetak/induk/{id}', [FakturController::class, 'cetakInduk'])->name('faktur.pajak.induk.cetak');

    Route::get('/pph21/personalia', [PPh21Controller::class, 'personalia'])->name('pph21.personalia');
    Route::post('/pph21/personalia', [PPh21Controller::class, 'storePersonalia'])->name('pph21.personalia.store');
    Route::get('/pph21/personalia/{id}/edit', [PPh21Controller::class, 'editPersonalia'])->name('pph21.personalia.edit');
    Route::get('/pph21/personalia/{id}', [PPh21Controller::class, 'destroyPersonalia'])->name('pph21.personalia.destroy');
    Route::get('/pph21/personalia/{id}/{status}', [PPh21Controller::class, 'statusPersonalia'])->name('pph21.personalia.status');
//    Route::post('/pph21/personalia/{id}/{status}', [PPh21Controller::class, 'statusPersonalia'])->name('pph21.personalia.status');
    Route::post('/pph21/personalia/import', [PPh21Controller::class, 'importPersonalia'])->name('pph21.personalia.import');

    Route::get('/pph21/gaji', [PPh21Controller::class, 'income'])->name('pph21.gaji');
    Route::get('/pph21/gaji/{period}/{year}/tambah', [PPh21Controller::class, 'createIncome'])->name('pph21.gaji.create');
    Route::post('/pph21/gaji', [PPh21Controller::class, 'storeIncome'])->name('pph21.gaji.store');
    Route::get('/pph21/gaji/{id}/edit', [PPh21Controller::class, 'editIncome'])->name('pph21.gaji.edit');
    Route::get('/pph21/gaji/{id}', [PPh21Controller::class, 'destroyIncome'])->name('pph21.gaji.destroy');
    Route::get('/pph21/gaji/{id}/export', [PPh21Controller::class, 'exportIncome'])->name('pph21.gaji.export');
    Route::get('/pph21/gaji/{id}/{status}', [PPh21Controller::class, 'statusIncome'])->name('pph21.gaji.status');
//    Route::post('/pph21/gaji/{id}/{status}', [PPh21Controller::class, 'statusIncome'])->name('pph21.gaji.status');

    Route::get('/pph21/bupot/{type}', [PPh21Controller::class, 'bupot'])->name('pph21.bupot');
    Route::post('/pph21/bupot/{type}', [PPh21Controller::class, 'storeBupot'])->name('pph21.bupot.store');
    Route::get('/pph21/bupot/{type}/{id}/edit', [PPh21Controller::class, 'editBupot'])->name('pph21.bupot.edit');
    Route::put('/pph21/bupot/{type}/{id}', [PPh21Controller::class, 'updateBupot'])->name('pph21.bupot.update');
    Route::get('/pph21/bupot/{type}/{id}', [PPh21Controller::class, 'destroyBupot'])->name('pph21.bupot.destroy');

    Route::get('/pph21/a1/{id?}', [PPh21Controller::class, 'a1Form'])->name('pph21.a1.form');
    Route::post('/pph21/a1/', [PPh21Controller::class, 'a1Store'])->name('pph21.a1.store');

    Route::get('/pph21/spt', [PPh21Controller::class, 'spt'])->name('pph21.spt');
    Route::post('/pph21/spt', [PPh21Controller::class, 'storeSpt'])->name('pph21.spt.store');
    Route::get('/pph21/spt/{id}/detail', [PPh21Controller::class, 'detailSpt'])->name('pph21.spt.detail');
    Route::get('/pph21/spt/{id}', [PPh21Controller::class, 'setorSpt'])->name('pph21.spt.setor');
//    Route::get('/pph21/spt/{id}/{status}', [PPh21Controller::class, 'statusSpt'])->name('pph21.spt.status');
    Route::post('/pph21/spt/{id}/{status}', [PPh21Controller::class, 'statusSpt'])->name('pph21.spt.status');

    Route::get('/pph21/cetak/{id}/{year}/bupot', [PPh21Controller::class, 'cetakBupot'])->name('pph21.bupot.cetak');
    Route::get('/pph21/cetak/{id}/spt', [PPh21Controller::class, 'cetakSpt'])->name('pph21.spt.cetak');
    Route::get('/pph21/cetak/{id}/final', [PPh21Controller::class, 'cetakFinal'])->name('pph21.final.cetak');
    Route::get('/pph21/cetak/{id}/ter', [PPh21Controller::class, 'cetakTer'])->name('pph21.ter.cetak');

    Route::get('/ruang/kelas/{code}', [RuangKelasController::class, 'index'])->name('ruang.kelas');
    Route::post('/ruang/kelas/{code}', [RuangKelasController::class, 'question'])->name('ruang.kelas.question');
    Route::get('/ruang/kelas/{code}/peringkat', [RuangKelasController::class, 'leaderboard'])->name('ruang.kelas.leaderboard');
    Route::get('/ruang/kelas/{code}/peringkat/{id}', [RuangKelasController::class, 'leaderboardShow'])->name('ruang.kelas.leaderboard.show');
    Route::get('/ruang/kelas/{code}/sertifikat', [RuangKelasController::class, 'achievement'])->name('ruang.kelas.achievement');
    Route::get('/ruang/kelas/{code}/materi', [RuangKelasController::class, 'material'])->name('ruang.kelas.material');
    Route::get('/ruang/kelas/{code}/hasil', [RuangKelasController::class, 'winner'])->name('ruang.kelas.winner');
    Route::post('/ruang/kelas/{code}/{type}', [RuangKelasController::class, 'list'])->name('ruang.kelas.list');
//    Route::get('/ruang/kelas/{code}/{type}', [RuangKelasController::class, 'list'])->name('ruang.kelas.list');

    Route::get('/pengajar', [TeacherController::class, 'index'])->name('pengajar.index');
    Route::get('/pengajar/kelas', [TeacherController::class, 'kelas'])->name('pengajar.kelas');
    Route::get('/pengajar/kelas/{id}/detail', [TeacherController::class, 'kelasDetail'])->name('pengajar.kelas.detail');
    Route::get('/pengajar/kelas/{id}/kode', [TeacherController::class, 'kelasCode'])->name('pengajar.kelas.kode');
    Route::get('/pengajar/kelas/{id}/duplikat', [TeacherController::class, 'kelasDuplicate'])->name('pengajar.kelas.duplicate');
    Route::post('/pengajar/kelas', [TeacherController::class, 'kelasStore'])->name('pengajar.kelas.store');
    Route::put('/pengajar/kelas/{id}', [TeacherController::class, 'kelasUpdate'])->name('pengajar.kelas.update');
    Route::delete('/pengajar/kelas/{id}', [TeacherController::class, 'kelasDestroy'])->name('pengajar.kelas.destroy');
    Route::post('/pengajar/kelas/{id}', [TeacherController::class, 'kelasChampion'])->name('pengajar.kelas.champion');

    Route::get('/pengajar/kelas/{id}/sertifikat', [TeacherController::class, 'sertifikat'])->name('pengajar.certificate');
    Route::get('/pengajar/kelas/{id}/sertifikat/tambah', [TeacherController::class, 'sertifikatCreate'])->name('pengajar.certificate.create');
    Route::post('pengajar/kelas/{id}/sertifikat', [TeacherController::class, 'sertifikatStore'])->name('pengajar.certificate.store');

    Route::resource('/pengajar/materi', MaterialController::class, ['as' => 'pengajar']);
    Route::post('pengajar/materi/status/{id}', [MaterialController::class, 'status'])->name('pengajar.materi.status');

    Route::get('pengajar/kelas/{id}/enrolle/tambah', [TeacherController::class, 'kelasStudentEnrolle'])->name('pengajar.createEnrolle');
    Route::post('pengajar/kelas/{id}/enrolle', [TeacherController::class, 'kelasStudentStore'])->name('pengajar.storeEnrolle');
    Route::delete('pengajar/enrolle', [TeacherController::class, 'kelasStudentDestroy'])->name('pengajar.destroyEnrolle');

    Route::get('pengajar/kelas/{kelas_id}/soal/tambah', [TeacherController::class, 'soalCreate'])->name('pengajar.soal.create');
    Route::post('pengajar/kelas/{kelas_id}/soal', [TeacherController::class, 'soalStore'])->name('pengajar.soal.store');
    Route::get('pengajar/kelas/{kelas_id}/soal/template', [TeacherController::class, 'soalTemplate'])->name('pengajar.soal.template');
    Route::post('pengajar/kelas/{kelas_id}/soal/tempalte', [TeacherController::class, 'soalTemplateStore'])->name('pengajar.soal.template.store');
    Route::get('pengajar/kelas/{kelas_id}/soal/{id}/edit', [TeacherController::class, 'soalEdit'])->name('pengajar.soal.edit');
    Route::put('pengajar/kelas/{kelas_id}/soal/{id}', [TeacherController::class, 'soalUpdate'])->name('pengajar.soal.update');
    Route::get('pengajar/kelas/{kelas_id}/soal/{id}/detail', [TeacherController::class, 'soalDetail'])->name('pengajar.soal.detail');
    Route::delete('pengajar/kelas/{kelas_id}/soal/{id}', [TeacherController::class, 'soalDestroy'])->name('pengajar.soal.destroy');
    Route::post('pengajar/kelas/{kelas_id}/soal/{id}', [TeacherController::class, 'soalStatus'])->name('pengajar.soal.status');
    Route::get('pengajar/template/{id}', [TeacherController::class, 'template'])->name('pengajar.soal.template.edit');

    Route::get('pengajar/soal/{soal_id}/penilaian/tambah', [TeacherController::class, 'penilaianCreate'])->name('pengajar.penilaian.create');
    Route::post('pengajar/soal/{soal_id}/penilaian', [TeacherController::class, 'penilaianStore'])->name('pengajar.penilaian.store');
    Route::get('pengajar/soal/{soal_id}/penilaian/{id}/edit', [TeacherController::class, 'penilaianEdit'])->name('pengajar.penilaian.edit');
    Route::put('pengajar/soal/{soal_id}/penilaian/{id}', [TeacherController::class, 'penilaianUpdate'])->name('pengajar.penilaian.update');
    Route::delete('pengajar/soal/{soal_id}/penilaian/{id}', [TeacherController::class, 'penilaianDestroy'])->name('pengajar.penilaian.destroy');
    Route::delete('pengajar/soal/hapus', [TeacherController::class, 'penilaianPelajarDestroy'])->name('pengajar.penilaian.pelajar.destroy');

    Route::post('penilaian', [TeacherController::class, 'penilaianList'])->name('pengajar.penilaian');

    Route::get('/pengajar/pelajar/{id}', [TeacherController::class, 'pelajarDetail'])->name('pengajar.pelajar.detail');
    Route::get('/pengajar/pelajar/{spt_id}/spt', [TeacherController::class, 'pelajarSpt'])->name('pengajar.pelajar.spt');
    Route::POST('/pengajar/pelajar/{spt_id}/nilai', [TeacherController::class, 'pelajarNilai'])->name('pengajar.pelajar.nilai');
    Route::get('/pengajar/pelajar/{id}/eform', [TeacherController::class, 'pelajarEform'])->name('pengajar.pelajar.eform');
    Route::delete('pengajar/pelajar/{type}/{id}', [TeacherController::class, 'pelajarDestroy'])->name('pengajar.pelajar.destroy');

    //faktur masukan pengajar
    Route::post('/pengajar/masukan', [TeacherController::class, 'masukanStore'])->name('pengajar.masukan.store');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/pengguna/{type}', [AdminController::class, 'pengguna'])->name('admin.pengguna');
    Route::post('/admin/pengguna', [AdminController::class, 'penggunaStore'])->name('admin.pengguna.store');
    Route::get('/admin/pengguna/{id}/edit', [AdminController::class, 'penggunaEdit'])->name('admin.pengguna.edit');
    Route::put('/admin/pengguna/{id}', [AdminController::class, 'penggunaUpdate'])->name('admin.pengguna.update');
    Route::get('/admin/pengguna/{id}/paket', [AdminController::class, 'penggunaPaket'])->name('admin.pengguna.paket');
    Route::get('/admin/pengguna/{id}/email', [AdminController::class, 'penggunaEmail'])->name('admin.pengguna.email');
    Route::get('/admin/pengguna/{id}/password', [AdminController::class, 'penggunaPassword'])->name('admin.pengguna.password');
    Route::delete('/admin/pengguna/{id}/destroy', [AdminController::class, 'penggunaDestroy'])->name('admin.pengguna.destroy');
    Route::post('/admin/pengguna/import', [AdminController::class, 'penggunaImport'])->name('admin.pengguna.import');
    Route::get('/admin/approved/{id}', [AdminController::class, 'approved'])->name('admin.approved');
    Route::get('/admin/transaksi', [AdminController::class, 'transaction'])->name('admin.transaction');
    Route::get('/admin/registrasi', [AdminController::class, 'registration'])->name('admin.registration');
    Route::get('/admin/log', [AdminController::class, 'log'])->name('admin.log');
    Route::get('/admin/pesan', [AdminController::class, 'message'])->name('admin.message');
    Route::get('/admin/pesan/{id}/reply', [AdminController::class, 'messageReply'])->name('admin.message.reply');
    Route::put('/admin/pesan/{id}', [AdminController::class, 'messageUpdate'])->name('admin.message.update');
    Route::delete('/admin/pesan/{id}/destroy', [AdminController::class, 'messageDestroy'])->name('admin.message.destroy');
    Route::resource('/admin/category', CategoryController::class, ['as' => 'admin']);
    Route::resource('/admin/performance', PerformanceController::class, ['as' => 'admin']);
    Route::resource('/admin/advertisement', AdvertisementController::class, ['as' => 'admin']);
    Route::resource('/admin/event', EventController::class, ['as' => 'admin']);
    Route::resource('/admin/batch', BatchController::class, ['as' => 'admin']);
    Route::resource('/admin/gallery', GalleryController::class, ['as' => 'admin']);
    Route::resource('/admin/discount', DiscountController::class, ['as' => 'admin']);
    Route::resource('/admin/invoice', InvoiceController::class, ['as' => 'admin']);
    Route::resource('/admin/referral', ReferralController::class, ['as' => 'admin']);
    Route::resource('/admin/partnership', PartnershipController::class, ['as' => 'admin']);
    Route::resource('/admin/header', HeaderController::class, ['as' => 'admin']);
    Route::resource('/admin/faq', FaqController::class, ['as' => 'admin']);
    Route::get('/admin/sertifikat/ttd', [CertificateController::class, 'sign'])->name('admin.certificate.sign');
    Route::post('/admin/sertifikat/ttd', [CertificateController::class, 'signStore'])->name('admin.certificate.sign.store');
    Route::get('/admin/sertifikat/ttd/{id}/edit', [CertificateController::class, 'signEdit'])->name('admin.certificate.sign.edit');
    Route::put('/admin/sertifikat/ttd/{id}', [CertificateController::class, 'signUpdate'])->name('admin.certificate.sign.update');
    Route::delete('/admin/sertifikat/ttd/{id}/destroy', [CertificateController::class, 'signDestroy'])->name('admin.certificate.sign.destroy');
    Route::get('/admin/sertifikat/desain', [CertificateController::class, 'design'])->name('admin.certificate.design');
    Route::post('/admin/sertifikat/desain', [CertificateController::class, 'designStore'])->name('admin.certificate.design.store');
    Route::get('/admin/sertifikat/desain/{id}/edit', [CertificateController::class, 'designEdit'])->name('admin.certificate.design.edit');
    Route::put('/admin/sertifikat/desain/{id}', [CertificateController::class, 'designUpdate'])->name('admin.certificate.design.update');
    Route::delete('/admin/sertifikat/desain/{id}/destroy', [CertificateController::class, 'designDestroy'])->name('admin.certificate.design.destroy');
    Route::get('/admin/invoice/{invoice}/print', [InvoiceController::class, 'print'])->name('admin.invoice.print');
    Route::get('/admin/invoice/{invoice}/status', [InvoiceController::class, 'status'])->name('admin.invoice.status');
    Route::get('/admin/sertifikat/brevet', [CertificateController::class, 'brevet'])->name('admin.certificate.brevet');
    Route::post('/admin/sertifikat/brevet', [CertificateController::class, 'brevetStore'])->name('admin.certificate.brevet.store');
    Route::get('/admin/sertifikat/brevet/{id}/edit', [CertificateController::class, 'brevetEdit'])->name('admin.certificate.brevet.edit');
    Route::put('/admin/sertifikat/brevet/{id}', [CertificateController::class, 'brevetUpdate'])->name('admin.certificate.brevet.update');
    Route::delete('/admin/sertifikat/brevet/{id}/destroy', [CertificateController::class, 'brevetDestroy'])->name('admin.certificate.brevet.destroy');
    Route::post('/admin/sertifikat/brevet', [CertificateController::class, 'brevetImport'])->name('admin.certificate.brevet.import');
    Route::get('/admin/sertifikat/lain', [CertificateController::class, 'lain'])->name('admin.certificate.lain');
    Route::post('/admin/sertifikat/lain', [CertificateController::class, 'lainStore'])->name('admin.certificate.lain.store');
    Route::get('/admin/sertifikat/lain/{id}/edit', [CertificateController::class, 'lainEdit'])->name('admin.certificate.lain.edit');
    Route::put('/admin/sertifikat/lain/{id}', [CertificateController::class, 'lainUpdate'])->name('admin.certificate.lain.update');
    Route::delete('/admin/sertifikat/lain/{id}/destroy', [CertificateController::class, 'lainDestroy'])->name('admin.certificate.lain.destroy');
    Route::post('/admin/sertifikat/lain', [CertificateController::class, 'lainImport'])->name('admin.certificate.lain.import');
    Route::get('/admin/wablas', [CertificateController::class, 'wablas'])->name('wablas');

    Route::get('/admin/send-email', [SendEmailController::class, 'index'])->name('kirim-email');
    Route::post('/admin/post-email', [SendEmailController::class, 'store'])->name('post-email');


    Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi.index');
    Route::get('/prodi/pengguna/{type}', [ProdiController::class, 'pengguna'])->name('prodi.pengguna');
    Route::get('/prodi/pengguna/{id}/password', [ProdiController::class, 'penggunaPassword'])->name('prodi.pengguna.password');
    Route::get('/prodi/kelas', [ProdiController::class, 'kelas'])->name('prodi.kelas');

    Route::get('/afiliasi', [AffiliateController::class, 'index'])->name('affiliate.index');

    Route::get('/returnsheets/{status}', [App\Http\Controllers\SptNewController::class, 'index'])->name('spt.index');
    Route::post('/returnsheets', [App\Http\Controllers\SptNewController::class, 'store'])->name('spt.store');
    Route::get('/returnsheets/{id}/detail', [App\Http\Controllers\SptNewController::class, 'show'])->name('spt.show');
    Route::put('/returnsheets/{id}', [App\Http\Controllers\SptNewController::class, 'update'])->name('spt.update');
    Route::delete('/returnsheets/{id}/destroy', [App\Http\Controllers\SptNewController::class, 'destroy'])->name('spt.destroy');

});

