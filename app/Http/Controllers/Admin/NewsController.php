<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\News;
use App\Http\Requests\NewsRequest;

class NewsController extends Controller
{
    public function show()
    {
        $news = News::all();

        return $news;
    }

    public function getNews(News $news)
    {
        return $news;
    }

    public function add(NewsRequest $request)
    {
      $data = $request->validated();

      if($_FILES){
      
    
       move_uploaded_file($_FILES['image']['tmp_name'][0], 'storage/image/'.$_FILES['image']['name'][0]);
        
       if($_FILES['image']['size'][0] === '' || $_FILES['image']['size'][0] === 0){
          return 'Размер изображение большой!';
       };

       $types = ["image/jpeg", "image/png","image/gif"];
       if(!in_array($_FILES['image']['type'][0], $types)){
         exit('Формат неправильный!');
        }

       if($_FILES['image']['size'][0] > 2*1024*1023){
       exit('Размер изображение большой!');
        }
     
       
       $img_name = $_FILES['image']['name'][0];
       $img_url = '/storage/image/'.$_FILES['image']['name'][0];
       $news= News::create([
        'title' => $data['title'],
        'news_text' => $data['news_text'],
        'img_url'  => $img_url
      ]);
   }else{
    $news= News::create([
      'title' => $data['title'],
      'news_text' => $data['news_text']
    ]);
   }


      

      return $news;
    }


    public function update(NewsRequest $request, News $news)
    {
      $data  = $request->validated();

     

      if($_FILES){
        move_uploaded_file($_FILES['image']['tmp_name'][0], 'storage/image/'.$_FILES['image']['name'][0]);
        
        if($_FILES['image']['size'][0] === '' || $_FILES['image']['size'][0] === 0){
          return 'Размер изображение большой!';
       };

       $types = ["image/jpeg", "image/png","image/gif"];
       if(!in_array($_FILES['image']['type'][0], $types)){
         exit('Формат неправильный!');
        }

       if($_FILES['image']['size'][0] > 2*1024*1023){
       exit('Размер изображение большой!');
        }

        $img_name = $_FILES['image']['name'][0];
        $img_url = '/storage/image/'.$_FILES['image']['name'][0];

        

       $news -> update([
        'title' => $data['title'],
        'news_text' => $data['news_text'],
        'img_url' => $img_url
       ]);

       return $news;

      } else {
        $news->update($data);
        return $news;
      }
 
    }

    public function delete(News $news)
    {
       
        $news->delete();
        
        return response('deleted');
       
    }

    public function last()
    {
        $last_news = News::latest()->limit(1)->get();
         
        return $last_news;
    }
}
