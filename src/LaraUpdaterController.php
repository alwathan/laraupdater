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
    	$data = Http::withToken('f3dc314525338b0c8ebce4e68d30235a1c203598')->get('https://api.github.com/repos/alwathan/pilbup/releases/latest');
        $versions = $data->json();
        var_dump($versions);
        $latest_version = $versions['tag_name'];
        $current_version = File::get(public_path('version.txt'));
        if($current_version < $latest_version){
            echo "Tersedia versi terbaru: ".$latest_version;
        }else{
            echo "Tidak ada versi terbaru";
        }

        $zzip = Http::withToken('f3dc314525338b0c8ebce4e68d30235a1c203598')->get($versions['zipball_url']);

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

    public function subtract($a, $b){
    	echo $a - $b;
    }
}

?>
