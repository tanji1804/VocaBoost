<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Card;
use App\Models\Book;
use App\Http\Requests\CardRequest;

class CardController extends Controller
{
    // card.create
    public function create(CardRequest $request)
    {
        $book = Book::find($request->book_id);
        
        $form = $request->all();
        $book_id = intval($form['book_id']);
        $user_id = Auth::id();
        unset($form['_token']);
        
        $counter = count($form['front']);
        for($i = 0; $i < $counter; $i++){
            $input = [
                'front' => $form['front'][$i],
                'back' => $form['back'][$i],
                'book_id' => $book_id,
                'user_id' => $user_id,
            ];
            
            $card = new Card;
            $card->fill($input);
            $card->save();
        }
        
        
        return redirect(route('book.index', ['id' => $book->id]));
    }
    
    //  card.edit
    public function edit(Request $request)
    {
        $card = Card::find($request->id);
        $form = $request->all();
        
        if($form['front'] === null){
            $card->front = 'untitled';
        }else{
            $card->front = $form['front'];
        }
        if($form['back'] === null){
            $card->back = 'untitled';
        }else{
            $card->back = $form['back'];
        }
        
        $card->update();
        
        return redirect(route('book.index', ['id' => $request->book_id]));
    }

    // card.delete
    public function delete(Request $request)
    {
        $card = Card::find($request->card_id);
        $card->delete();
        return redirect(route('book.index', ['id' => $request->book_id]));
    }
    
    public function processImage(Request $request)
    {
        $img_type = $request->img_data->getMimeType();
        $img_contents = $request->img_data->get();
        $img_data = base64_encode($img_contents);
        
        [$access_token] = $this->getAccessToken();
        
        // CURLリクエストを実行してJSONレスポンスを取得
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
            'Content-Type' => 'application/json; charset=utf-8',
        ])->post('https://vision.googleapis.com/v1/images:annotate', [
                "requests" => [
                    [
                        "features" => [
                            [
                                "type" => "TEXT_DETECTION"
                            ]
                        ],
                        "image" => [
                            "content" => $img_data
                        ]
                    ]
                ]
            ]);

        // レスポンスのJSONデータを取得
        $data = $response->json();
        $text_annotaions = $data['responses'][0]["textAnnotations"];
        $coordinates = [];
        
        $coordinates = array_slice($text_annotaions, 1);
        
        $coordinates = array_filter($coordinates, function($c) {
            return isset($c['boundingPoly']['vertices'][0]['y']);
        });
        
        $book_id = $request->book_id;
        
        return view('card.image_create', [
            'coordinates' => $coordinates,
            'img_data' => $img_data,
            'img_type' => $img_type,
            'book_id' => $book_id,
        ]);
    }
    
    private function getAccessToken()
    {
        $output = [];
        $command = '/home/ec2-user//google-cloud-sdk/bin/gcloud auth print-access-token';
        $code = 0;
        
        exec($command, $output);
        
        return $output;
    }
}
