<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisModel;
use App\Models\GejalaModel;
use App\Models\HdiagnosasModel;
use App\Models\GdiagnosasModel;
use App\Models\CiriCiriKerusakan;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;


class DashboardController extends Controller
{
    public function dashboard(){
        return view('pages.dashboard');
    }  
      public function halamanlogin(){
        return view ('layouts.login');
    } 
      public function ceklogin(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if(Auth::attempt($request->only('email','password'))){ 
            if (auth()->user()->role == 'Admin') {
                return redirect()->route('Dashboard');
            }
        } 
        else {
            Log::warning('Login attempt failed.', [
                'email' => $request->email,
            ]);
    
            // Tambahkan pesan error ke session
            return redirect()->route('HalamanLogin')->with('error', 'Email atau Password Salah');
        }
    }
  public function user_logout(Request $request)
    {
       
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }  
      public function halamanjenis(){
        $jenis = JenisModel::get();
        return view('pages.jenis', compact('jenis'));
    }

      public function halamanciri(){
        $ciri = CiriCiriKerusakan::get();
           $jenis = JenisModel::get();
           $jenips = JenisModel::get();
        return view('pages.ciri', compact('ciri','jenis','jenips'));
    }


     public function halamangejala(){
        $gejala = GejalaModel::get();
     
        return view('pages.gejala', compact('gejala'));
    }

    public function admin_tambah_jenis(Request $request){
        // dd($request->all());
        $tambah_jenis = new JenisModel();
        $tambah_jenis->nama_kerusakan = $request->nama_kerusakan; 
        $tambah_jenis->solusi = $request->solusi; 
        $tambah_jenis->save();

        return redirect()->back()->with('success');
    }
    
    public function admin_edit_jenis(Request $request, $id){
        $edit_jenis = JenisModel::find($id);
          $edit_jenis->nama_kerusakan = $request->nama_kerusakan; 
           $edit_jenis->solusi = $request->solusi; 
      
        $edit_jenis->save();
        return redirect()->back()->with('success');
    }

    public function jenis_destroy(JenisModel $id)
    {
        $id->delete();

        return redirect()->back()->with('success');
    }
       public function admin_tambah_gejala(Request $request){
        // dd($request->all());
        $tambah_gejala = new GejalaModel();
        $tambah_gejala->kode = $request->kode;
        $tambah_gejala->nama_gejala = $request->nama_gejala; 
        $tambah_gejala->bobot = $request->bobot; 
        $tambah_gejala->save();

        return redirect()->back()->with('success');
    }
   public function admin_edit_gejala(Request $request, $id){
        $edit_gejala = GejalaModel::find($id);
        $edit_gejala->kode = $request->kode;
        $edit_gejala->nama_gejala = $request->nama_gejala; 
        $edit_gejala->bobot = $request->bobot;  
        $edit_gejala->save();
        return redirect()->back()->with('success');
    }
    public function gejala_destroy(GejalaModel $id)
    {
        $id->delete();

        return redirect()->back()->with('success');
    }
    public function admin_tambah_ciri(Request $request){
        // dd($request->all());
        $tambah_ciri = new CiriCiriKerusakan();
        $tambah_ciri->kode = $request->kode;
        $tambah_ciri->id_kerusakan = $request->id_kerusakan; 
        $tambah_ciri->ciri_ciri = $request->ciri_ciri; 
        $tambah_ciri->bobot = $request->bobot; 
        $tambah_ciri->save();

        return redirect()->back()->with('success');
    }
     public function admin_edit_ciri(Request $request, $id){
        $edit_jenis = CiriCiriKerusakan::find($id);
        $edit_jenis->kode = $request->kode;
        $edit_jenis->id_kerusakan = $request->id_kerusakan; 
        $edit_jenis->ciri_ciri = $request->ciri_ciri; 
        $edit_jenis->bobot = $request->bobot;  
        $edit_jenis->save();
        return redirect()->back()->with('success');
    }
        public function ciri_destroy(CiriCiriKerusakan $id)
    {
        $id->delete();

        return redirect()->back()->with('success');
    }

    public function halaman_prediksi(){
        $gejala = GejalaModel::get();
        return view('pages.prediksi', compact('gejala'));
    }
    public function predict(Request $request)
{
   
    // Ambil gejala yang dikirimkan oleh user
    $inputGejala = $request->input('gejala'); // Misalnya [G-01, G-02, ...]
    // $getGdiagnosas = GdiagnosasModel::get();
    $gejalas = GejalaModel::whereIn('id', $inputGejala)->get();
    $bgejalas = $gejalas->pluck('bobot')->toArray();
    // dd($bgejalas);

    $gdiagnosas = GdiagnosasModel::whereIn('gejala_id', $inputGejala)->get();
    $diagnosasIds = $gdiagnosas->pluck('diagnosas_id')->toArray();
    $hdiagnosas = HdiagnosasModel::whereIn('id', $diagnosasIds)->get();
    $dJenisIds = $hdiagnosas->pluck('id_kerusakan')->toArray();
    $dJenis = JenisModel::whereIn('id', $dJenisIds)->get();
    $ciriJenis = CiriCiriKerusakan::where('id_kerusakan',$dJenisIds)->get();
    $bJenis = $ciriJenis->pluck('bobot')->toArray();
    // dd($ciriJenis);
    $bmatched = count($ciriJenis);  
    $totalWeightSimilarityScore = 0;
    $bestMatch = null;
    $highestScore = 0;
    $bestScoreDetails = [];
    foreach ($bgejalas as $gejalaBobot) {
        // dd( $gejalaBobot);
        //  var_dump($gejalaBobot);
        foreach ($bJenis as $jenisBobot) {
            // var_dump($jenisBobot);
            $totalWeightSimilarityScore += $gejalaBobot * $jenisBobot;
        }
    }
    $similarityScore =  $totalWeightSimilarityScore /  $bmatched;
    $bestMatch = $dJenis;

                //   dd(($bestMatch);
        $namaKerusakan = $bestMatch[0]['nama_kerusakan'];
        $solusi = $bestMatch[0]['solusi'];
        //    dd($namaKerusakan, $solusi);

        

        if ($similarityScore > $highestScore) {
            $highestScore = $similarityScore;
            $bestMatch = $dJenis;
            $bestScoreDetails = [
                'score' => $similarityScore,
                'kerusakan' => $namaKerusakan,
                'solusi' => $solusi,
            ];
            // dd('hh',$bestMatch);
            //  dd('bs',$bestScoreDetails);
        }

        // if($bestScoreDetails){
        //     HdiagnosasModel::create(
        //         'id_kerusakan'=>$bestScoreDetails['kerusakan'];
        //         'solusi' => $bestScoreDetails['solusi']
        //     )
        // }
        
    // Ambil data ciri-ciri yang terkait dengan semua jenis kerusakan
    // $kerusakanData = JenisModel::with('ciriCiri')->get();
    // Menampilkan hasil
    return response()->json([
        // 'message' => 'Diagnosis completed.',
        'kerusakan' => $bestScoreDetails['kerusakan'],
        'solusi' => $bestScoreDetails['solusi'],
        'similarity' => $bestScoreDetails['score'],
    ]);
}

    // predict
    //   public function predict(Request $request)
    // {
       
    //     $inputGejala = $request->input('gejala'); // Array ID gejala
    //     $kerusakanData = JenisModel::with('ciriCiri')->get();
    //     // $kerusakanData = JenisModel::select('nama_kerusakan', 'solusi')->with('ciriCiri')->get();
    //     $bestMatch = null;
    //     // $highestScore = 0;
    //      $highestScore = 0;
    // $bestScoreDetails = [];
        
    //     foreach ($kerusakanData as $kerusakan) {
    //         dd($kerusakan->ciriCiri);
    //         $ciriCiriids = $kerusakan->ciriCiri->pluck('id')->toArray();
    //         dd( $ciriCiri);
    //         $matched = array_intersect($inputGejala, $ciriCiri);
    //         dd($matched);
    //         $score = count($matched) / count($ciriCiri);
            
    //         if ($score > $highestScore) {
    //                 foreach ($matched as $gejalaId) {
    //                 // Ambil bobot dari gejala yang cocok
    //                 $gejala = Gejala::find($gejalaId);
    //                 $ciriCiri = CiriCiri::find($gejala->id); // Sesuaikan relasi tabel

    //                 // Kalikan bobot gejala dengan bobot ciri-ciri yang cocok
    //                 $totalScore += ($gejala->bobot * $ciriCiri->bobot);
    //             }
    //               $similarityScore = $totalScore / $matchedCount;
    //               // Simpan nilai terbaik
    //             if ($similarityScore > $highestScore) {
    //                 $highestScore = $similarityScore;
    //                 $bestMatch = $kerusakan;
    //                 $bestScoreDetails = [
    //                     'score' => $similarityScore,
    //                     'kerusakan' => $kerusakan->nama_kerusakan,
    //                     'solusi' => $kerusakan->solusi,
    //                 ];
    //             }
    //         }
    //     }
        
    //     if ($bestMatch) {
    //         return response()->json([
    //             'kerusakan' => $bestMatch->nama_kerusakan,
    //             'solusi' => $bestMatch->solusi,
    //             'similarity' => $highestScore
    //         ]);
    //     } else {
    //         return response()->json(['message' => 'Tidak ditemukan kerusakan yang sesuai.']);
    //     }
    // }


}
