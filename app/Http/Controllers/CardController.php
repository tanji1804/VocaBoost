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
        $card = new Card;
        $book = Book::find($request->book_id);
        $form = $request->all();
        $form['user_id'] = Auth::id();
        
        unset($form['_token']);
        
        $card->fill($form);
        $card->save();
        
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
    
    public function processImage()
    {
        [$accessToken] = $this->getAccessToken();
        
        // CURLリクエストを実行してJSONレスポンスを取得
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
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
                            "source" => [
                                "imageUri" => "gs://bucket-warm-lane-387513/IMG_7507.img.PNG"
                            ]
                        ]
                    ]
                ]
            ]);

        // レスポンスのJSONデータを取得
        $data = $response->json();
        $textAnnotaions = $data['responses'][0]["textAnnotations"];
        $texts = [];
        for($i = 1; $i < count($textAnnotaions); $i++){
            $texts[] = $textAnnotaions[$i]["description"];
        }
        
        // Bladeテンプレートにデータを渡して表示
        return view('card.image_create', ['text' => $data['responses'][0]['fullTextAnnotation']['text']]);
    }
    
    private function getAccessToken()
    {
        $output = [];
        $command = '~/environment/google-cloud-sdk/bin/gcloud auth print-access-token';
        $code = 0;
        
        exec($command, $output);
        
        return $output;
    }
}
