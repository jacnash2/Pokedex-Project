<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     //require log in
     
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function store()
    {
        //if the database already contains data, redirect to display
        if(\App\Pokedex::all()->isNotEmpty()) return redirect('p');

        //else add the data
        request()->validate(['csvfile' => 'required']);

        //saves uploaded file in folder "Data" with name "pokedex.csv"
        $filePath = request('csvfile')->storeAs('Data','pokedex.csv');

        $thisFile = fopen(Storage::path($filePath),"r") or die("Unable to open file!");

        //skip the header row
        fgets($thisFile);
        $thisRow = fgets($thisFile);

        while(!feof($thisFile)){
            $row_data = explode('[', $thisRow);
            $id = explode(',', $row_data[0]);//id is index 0
            $name = explode('"', $id[1]);//name is index 1
            $types_height_weight = explode(']', $row_data[1]);

            $getTypes = explode(',', $types_height_weight[0]);
            $types = "";
            foreach($getTypes as $key => $val)
            {
                $temp = explode('"', $val);
                if($key != count($getTypes)-1)$types = $types . '"' . $temp[2] . '",';
                else $types = "[" . $types . '"' . $temp[2] . '"' . "]";//last entry
            }

            //height is index 1, weight is index 2
            $height_weight = explode(',', $types_height_weight[1]);

            $abilities_arr = explode(']', $row_data[2]);
            $getAbilities = explode(',', $abilities_arr[0]);
            $abilities = "";
            foreach($getAbilities as $key => $val)
            {
                $temp = explode('"', $val);
                if($key != count($getAbilities)-1)$abilities = $abilities . '"' . $temp[2] . '",';
                else $abilities = "[" . $abilities . '"' . $temp[2] . '"' . "]";//last entry
            }

            $theRest = explode(']', $row_data[3]);
            $getEggGroups = explode(',', $theRest[0]);
            $egg_groups = "";
            foreach($getEggGroups as $key => $val)
            {
                $temp = explode('"', $val);
                if($key != count($getEggGroups)-1)$egg_groups = $egg_groups . '"' . $temp[2] . '",';
                else $egg_groups = "[" . $egg_groups . '"' . $temp[2] . '"' . "]";//last entry
            }

            $stats_description = explode('}', $theRest[1]);
            $stats_arr = explode('{', $stats_description[0]);
            $getStats = explode(',', $stats_arr[1]);
            $stats = "";
            foreach($getStats as $key => $val)
            {
                $temp = explode('"', $val);
                if($key != count($getStats)-1)$stats = $stats . '"' . $temp[2] . '"' . $temp[4] . ', ';
                else $stats = "{" . $stats . '"' . $temp[2] . '"' . $temp[4] . "}";//last entry
            }

            //genus is index 2, description is index 4
            $genus_description = explode('"', $stats_description[1]);

            $thisRow = fgets($thisFile);
            while(strlen($thisRow) < 127)//this gets the new lines in the description
            {
                $genus_description[4] = $genus_description[4] . $thisRow;
                $thisRow = fgets($thisFile);
                if(feof($thisFile))
                {
                    $description = explode('"',$genus_description[4]);
                    \App\Pokedex::create([
                        'id' => $id[0],
                        'name' => $name[1],
                        'types' => $types,
                        'height' => $height_weight[1],
                        'weight' => $height_weight[2],
                        'abilities' => $abilities,
                        'egg_groups' => $egg_groups,
                        'stats' => $stats,
                        'genus' => $genus_description[2],
                        'description' => $description[0]
                    ]);
                    fclose($thisFile);
                    return redirect('p');
                }
            }
            $description = explode('"',$genus_description[4]);
            \App\Pokedex::create([
                'id' => $id[0],
                'name' => $name[1],
                'types' => $types,
                'height' => $height_weight[1],
                'weight' => $height_weight[2],
                'abilities' => $abilities,
                'egg_groups' => $egg_groups,
                'stats' => $stats,
                'genus' => $genus_description[2],
                'description' => $description[0]
            ]);
        }
        fclose($thisFile);
        return redirect('p');
    }

}
