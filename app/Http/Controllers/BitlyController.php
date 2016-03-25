<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class BitlyController extends Controller {
    public function postBitly() {

    $longUrl = $_POST['longUrl'];

    $my_bitly = new \Hpatoio\Bitly\Client("d28d2149f4f3417f7c6ef56d860415580e736f74");

    $response = $my_bitly->Shorten(array('longUrl' => $longUrl));
    $url = $response['url'];

    return $url;
    }
}
