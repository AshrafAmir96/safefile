<?php
namespace App\Traits;

use Illuminate\Support\Facades\Request;

trait SelectionTrait{

    public function getSelectionArray($name,$translate = false) {

        $selection = config('global.'.$name);

        if($translate){
            foreach($selection as $key => $value){
                $selection[$key] = __($value);
            }
        }

        return $selection;
    }

}
