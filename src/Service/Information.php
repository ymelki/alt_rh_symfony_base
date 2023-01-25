<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
 

class Information {
    protected  $info;
    function __construct(Request $req) {   
        $this->info=$req; 
    }
    public function creertableauhtml(int $a){
        
    $montableau="<table class=table>
    <thead>
        <tr>
        <th scope=col>#</th>
        <th scope=col>".$this->info->query->get('bar', 'baz')."</th>
        <th scope=col>Last</th>
        <th scope=col>Handle</th>
        </tr>
    </thead>
    <tbody>";
    for ($i=0;$i<$a;$i++){
    $montableau=$montableau."<tr>
        <th scope=row>1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
        </tr>
        <tr> ";
    }
    $montableau=$montableau."</tbody>
    </table>";

    return $montableau;
    }


}