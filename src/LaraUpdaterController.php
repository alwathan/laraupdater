<?php

namespace Alwathan\LaraUpdater;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use ZipArchive;
use Symfony\Component\Process\Process;

class LaraUpdaterController extends Controller
{
    //
    public function get(){
        $token = config('laraupdater.github.personal_access_token');
        $vendor = config('laraupdater.github.vendor');
        $repo = config('laraupdater.github.repository');

    	$data = Http::withToken($token)->get('https://api.github.com/repos/'.$vendor.'/'.$repo.'/releases/latest');
        
        $versions = $data->json();

        //var_dump($versions);

        $latest_version = $versions['tag_name'];
        
        if(Storage::disk('local')->missing('version.txt')){
            if(Storage::disk('local')->put('version.txt',  config('laraupdater.app_version'))){
                $current_version = Storage::disk('local')->get('version.txt');
            }
        }else{
            $current_version = Storage::disk('local')->get('version.txt');
        }

        if($current_version < $latest_version){
            echo "Tersedia versi terbaru: ".$latest_version;
        }else{
            echo "Tidak ada versi terbaru";
        }

        $zzip = Http::withToken($token)->get($versions['zipball_url']);

        //var_dump($zip->body());

        //File::put($latest_version.".zip", $zzip->body());

        $zipname = $latest_version.".zip";

        //Storage::disk('local')->put($latest_version.".zip", $zzip->body());

        $ziplocation = storage_path('app/'.$zipname);
        $zip = new ZipArchive();
        if($zip->open($ziplocation)){
            //$zip->extractTo(storage_path('app'));
        }
        $zip->close();
        $directories = Storage::disk('local')->directories();

        $output = preg_grep('!^alwathan-pilbup!', $directories);

        //$directories = public_path()->directories();

        echo $output[0];

        //exec("perintah command", $output);
 
        $output = system("dir");
        echo $output;
        

    }

    public function test(){
        $token = config('laraupdater.github.personal_access_token');
        $vendor = config('laraupdater.github.vendor');
        $repo = config('laraupdater.github.repository');

    	$data = Http::withToken($token)->get('https://api.github.com/repos/'.$vendor.'/'.$repo.'/releases/latest');
        
        $versions = $data->json();

        if($data->status() != '200'){
            echo "Persoanl access token invalid!";
        }else{
            $latest_version = $versions['tag_name'];
            
            if(Storage::disk('local')->missing('version.txt')){
                if(Storage::disk('local')->put('version.txt',  config('laraupdater.app_version'))){
                    $current_version = Storage::disk('local')->get('version.txt');
                }
            }else{
                $current_version = Storage::disk('local')->get('version.txt');
            }

            if($current_version < $latest_version){
                $zzip = Http::withToken($token)->get($versions['zipball_url']);
                $zipname = $latest_version.".zip";

                if(Storage::disk('local')->put($zipname, $zzip->body())){
                    $ziplocation = storage_path('app/'.$zipname);
                    $zip = new ZipArchive();
                    if($zip->open($ziplocation)){
                        if($zip->extractTo(storage_path('app'))){
                            $zip->close();

                            $directories = Storage::disk('local')->directories();
                            $output = preg_grep('!^alwathan-pilbup!', $directories);
                            
                            if(File::copyDirectory(storage_path('app')."/".$output[0], base_path())){
                                Storage::disk('local')->put('version.txt',$latest_version);
                                Storage::disk('local')->deleteDirectory($output[0]);
                                Storage::disk('local')->delete($zipname);
                                echo "berhasil melakukan update dari versi: ".$current_version." ke versi terbaru: ".$latest_version;
                            }
                        }
                    }else{
                        echo "Gagal extract zip";
                    }
                }else{
                    echo "Gagal download zip";
                }
            }else{
                echo "Belum ada update terbaru";
            }
        }
    }
}

?>
