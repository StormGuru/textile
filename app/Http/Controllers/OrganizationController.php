<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Image;
use App\Http\Requests\OrganizationRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class OrganizationController extends Controller
{
     public function add(OrganizationRequest $request)
    {
       $data = $request->validated();
     
     
       // print_r($_FILES['image']['tmp_name']);
       if($_FILES){
      
         if($_FILES['image']['size'][0] === '' || $_FILES['image']['size'][0] === 0){
          die('Размер изображение большой!');
       };

       $types = ["image/jpeg", "image/png","image/gif"];
       if(!in_array($_FILES['image']['type'][0], $types)){
         exit('Формат неправильный!');
        }

       if($_FILES['image']['size'][0] > 2*1024*1023){
       exit('Размер изображение большой!');
        }

        $img_name = $_FILES['image']['name'][0];
        $img_path = '/storage/image/'.$_FILES['image']['name'][0];
        
      if(move_uploaded_file($_FILES['image']['tmp_name'][0], 'storage/image/'.$_FILES['image']['name'][0])){
          $organization = Organization::create([
            'name' => $data['name'],
            'adress' => $data['adress'],
            'tel' => $data['tel'],
            'site' => $data['site'],
            'description' => $data['description'],
            'published' => 1,
            'user_id' => auth()->user()->id,
            'category_id' => $data['category_id']
          ]);

          Image::create([
            'name' => $img_name,
            'url'  => $img_path,
            'organization_id' => $organization->id
          ]);
        } else{
           return 'ошибка';
        }
      

      

     
       
      //  $image = $data['image'];
      //  foreach($image as $img){
      //      $name = Carbon::now().'_'.$img->getClientOriginalName().'.'.$img->getClientOriginalExtension();
      //      $filePath = Storage::disk('public')->move('/image', $img, $name);
      //      dd($filePath);
      //  }
    }else{
      $organization = Organization::create([
        'name' => $data['name'],
        'adress' => $data['adress'],
        'tel' => $data['tel'],
        'site' => $data['site'],
        'description' => $data['description'],
        'published' => 1,
        'user_id' => auth()->user()->id,
        'category_id' => $data['category_id']
      ]);
    }
     

    
}

    public function userShow()
    {
      $user_orgs = auth()->user()->organizations()->get();
      
      if($user_orgs != null){
      foreach($user_orgs as $uo){
     
         $uo2 = [
           'id' => $uo->id,
           'name' => $uo->name,
           'adress' => $uo->adress,
           'tel' => $uo->tel,
           'site' => $uo->site,
           'description' => $uo->description,
           'published' => $uo->published,
           'created_at' => $uo->created_at,
           'created_at' => $uo->updated_at,
           'category' => $uo->category->name,
           'images' => $uo->images
         ];
         $uo3[] = $uo2;
      }

     return $uo3;

    } else{
      return 'У вас пока нет организаций';
    }

    }

    public function allOrganizations(Request $request)
    {
      $allOrganizations = Organization::paginate(20, ['*'], 'page', $request['page']);

      foreach($allOrganizations as $ao){
     
        $ao2 = [
          'name' => $ao->name,
          'adress' => $ao->adress,
          'tel' => $ao->tel,
          'site' => $ao->site,
          'description' => $ao->description,
          'published' => $ao->published,
          'created_at' => $ao->created_at,
          'created_at' => $ao->updated_at,
          'category' => $ao->category->name,
          'images' => $ao->images
        ];
        $ao3[] = $ao2;
      return $allOrganizations;
    }
   
}

  public function single(Organization $organization)
  {
    $organization['category'] = $organization->category;
    $organization['images'] = $organization->images;
      return $organization;
  }

  public function update(OrganizationRequest $request, Organization $organization)
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

      
     $organization -> update([
      'name' => $data['name'],
      'adress' => $data['adress'],
      'tel' => $data['tel'],
      'site' => $data['site'],
      'description' => $data['description'],
      'category_id' => $data['category_id']
     ]);
     $image = Image::where('organization_id', $organization->id)->first();

     if($image === null){
      Image::create([
        'name' => $img_name,
        'url'  => $img_url,
        'organization_id' => $organization->id
      ]);
     }
      
   if($image){
    $image->update([
      'name' => $img_name,
      'url'  => $img_url,
      'organization_id' => $organization->id
     ]);
   } 

   
     return $organization;

    } else {
      $organization->update($data);
      return $organization;
    }
  }

  public function count(Organization $organization)
  {
      if($organization->view === null){
          $organization->update(['view' => 1]);
      } else {
          $organization->increment('view', 1);
      }
     
  }

  public function delete(Organization $organization)
  {
     
      $organization->delete();
      
      return response([]);
     
  }

  public function liders()
  {
    $liders = Organization::orderBy('view', 'desc');
     return $liders;
  }
}