<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 6/13/16
 * Time: 2:51 PM
 */

namespace App\Http\Controllers;


use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EventController extends Controller {
    public function __construct()
    {
        //
    }

    public function getList(){
        $events = Post::where("type","=","event")->get();
        $country = DB::table("country")->lists('name');
        if(count($events)>0){
            $result['success']  ="true";
            $result['datum']     = $events;
            $result['countries'] =$country;
            $result['msg']      ="Data Updated";
            $result['code']     ="200";
        }else{
            $result['success']  ="false";
            $result['data']     ="null";
            $result['msg']      ="Invalid Query";
            $result['code']     ="401";
        }

        return response()->json($result);
    }

    public function getTopTenEvent(){
        $events = Post::where("id","!=","")->take(10)->get();
        if(count($events)>0){
            $result['success']  ="true";
            $result['datum']     = $events;
            $result['msg']      ="Data Updated";
            $result['code']     ="200";
        }else{
            $result['success']  ="false";
            $result['data']     ="null";
            $result['msg']      ="Invalid Query";
            $result['code']     ="401";
        }

        return response()->json($result);
    }

    public function getEventsByCategory($id){
        $events = Post::where("parent_id","=",$id)->take(10)->get();

        if(count($events)>0){
            $result['success']  ="true";
            $result['datum']     = $events;
            $result['msg']      ="Data Updated";
            $result['code']     ="200";
        }else{
            $result['success']  ="false";
            $result['data']     ="null";
            $result['msg']      ="Invalid Query";
            $result['code']     ="401";
        }

        return response()->json($result);
    }

    public function postEventCategory(){

    }

    public function updateEvent(Request $request,$id){
        $post = Post::where("id",$id)->first();
        $data = $request->all();
        //try{
            //$ticketing = json_decode($args['ticketing']);
            array_forget($data,"id");
            if(!empty($data)){
                foreach($data as $key=>$val){
                    $post->$key = $val;
                }

                $post->permalink = $request->input('url');
                $post->p_content = $request->input('description');
                $post->caption = $request->input('description');
                $post->updated_at =date("Y-m-d H:i:s");
            }
           /* $this->validate($request, [
                'title' => 'required',
                'country' => 'required',
                'longitude' => 'required',
                'latitude' => 'required',
                'start_time' => 'required',
                'start_date' => 'required'
            ],["title"=>"Event Title must be supplied","country"=>"Please specify event country","longitude"=>"please supply longitude","latitude"=>"please supply latitude","start_time"=>"Please supply time of start of event",
            "start_date"=>"please supply event start date"]);$post->update()*/
            //\DB::

            $post->title = $request->input('title');
            $post->description = $request->input('description');

            $post->latitude =$request->input('latitude');
            $post->longitude = $request->input('longitude');
            $post->start_time = $request->input('start_time');
            $post->end_time = $request->input('end_time');
            $post->start_date = $request->input('start_date');
            $post->end_date = $request->input('end_date');
            $post->zip_code = $request->input("zip_code");
            $post->country = $request->input('country');
            $post->address = $request->input('address');
            $post->parent_id = $request->input('parent_id');
            $post->url = $request->input('url');
            $post->permalink = $request->input('url');
            $post->p_content = $request->input('description');
            $post->caption = $request->input('description');
            $post->created_at =date("Y-m-d H:i:s");
            $post->type ="event";
            if(\DB::table('posts')->where('id', 1)->update(['title' => $request->input('title'),'description'=>$request->input('description'),
            "latitude"=>$request->input('latitude'),"longitude"=>$request->input('longitude'),"start_time"=>$request->input('start_time'),
            "end_time"=>$request->input('end_time'),"start_date"=>$request->input('start_date'),"end_date"=>$request->input('start_date'),
            "zip_code"=>$request->input('zip_code'),"country"=>$request->input('country'),"address"=>$request->input('address'),"parent_id"=>$request->input('parent_id'),
            "url"=>$request->input('url'),"permalink"=>$request->input('url'),"p_content"=>$request->input('p_content'),"caption"=>$request->input('description'),
            "type"=>"event","created_at"=>$request->input('created_at')])){
                $result['success']      =   true;
                $result['msg']          =   "Event Updated on server Successfully";
                $result['data']         =   $post->title;
                $result['code']         =   "200";
            }else{
                //$result               =   array();
                $result['success']      =   false;
                $result['msg']          =   " Unexpected Error! Event could not be updated. Please try again ";
                $result['data']         = null;
                $result['code']         =   "501";
                //throw new \Exception("Customer could not be created"); //return "error"; //unsuccessful
            }
        //}catch(Exception $e){
          //  $result['msg']          = $e->getMessage();
          //  $result['data']         = null;
          //  $result['success']      = false;
          //  $result['code']         =   "401";
        //}
        return response()->json($result);
    }

    public function postEvent(Request $request){
        //$data =  $request->all();


        $post = new Post();
        try{
            //$ticketing = json_decode($args['ticketing']);

                $post->title = $request->input('title');
                $post->description = $request->input('description');

                $post->latitude =$request->input('latitude');
                $post->longitude = $request->input('longitude');
                $post->start_time = $request->input('start_time');
                $post->end_time = $request->input('end_time');
                $post->start_date = $request->input('start_date');
                $post->end_date = $request->input('end_date');
                $post->zip_code = $request->input("zip_code");
                $post->country = $request->input('country');
                $post->address = $request->input('address');
                $post->parent_id = $request->input('parent_id');
                $post->url = $request->input('url');
                $post->permalink = $request->input('url');
                $post->p_content = $request->input('description');
                $post->caption = $request->input('description');
                $post->created_at =date("Y-m-d H:i:s");
                $post->type ="event";
           /* $this->validate($request, [
                'title' => 'required',
                'country' => 'required',
                'longitude' => 'required',
                'latitude' => 'required',
                'start_time' => 'required',
                'start_date' => 'required'
            ],["title"=>"Event Title must be supplied","country"=>"Please specify event country"]);*/


            if($post->save()){
                $result['success']      =   true;
                $result['msg']          =   "Event Created on server Successfully";
                $result['data']         =   $post->title;
                $result['code']         =   "200";
            }else{
                //$result               =   array();
                $result['success']      =   false;
                $result['msg']          =   " Unexpected Error! Event could not be created. Please try again ";
                $result['data']         = null;
                $result['code']         =   "501";
                //throw new \Exception("Customer could not be created"); //return "error"; //unsuccessful
            }
        }catch(Exception $e){
            $result['msg']          = $e->getMessage();
            $result['data']         = null;
            $result['success']      = false;
            $result['code']         =   "401";
        }
        return response()->json($result);
    }

    public function deleteEvent(Request $request,$id){
        $post = Post::where("id",$id)->first();

        try{

            if($post->delete()){
                $result['success']      =   true;
                $result['msg']          =   "Event Created on server Successfully";
                $result['data']         =   $post->title;
                $result['code']         =   "200";
            }else{
                //$result               =   array();
                $result['success']      =   false;
                $result['msg']          =   " Unexpected Error! Event could not be created. Please try again ";
                $result['data']         = null;
                $result['code']         =   "501";
                //throw new \Exception("Customer could not be created"); //return "error"; //unsuccessful
            }
        }catch(Exception $e){
            $result['msg']          = $e->getMessage();
            $result['data']         = null;
            $result['success']      = false;
            $result['code']         =   "401";
        }
        return response()->json($result);
    }

    public function getSearchOptionData(){
        $country = \DB::table('posts')->lists('country');
        $zipcode = \DB::table('posts')->lists('zip_code');
        $address = DB::table('posts')->lists('address');

        $subcollection = collect($country);
        $submerge = $subcollection->merge($zipcode);
        $finalmerge = $submerge->merge($address);

        $final = $finalmerge->all();

        $collection = collect($final)->map(function ($name) {
            return strtoupper($name);
        })
            ->reject(function ($name) {
                return empty($name);
            });

        if(count($final)>0){
            $result['success']  ="true";
            $result['datum']     = $collection;
            $result['msg']      ="Data Updated";
            $result['code']     ="200";
        }else{
            $result['success']  ="false";
            $result['data']     ="null";
            $result['msg']      ="Invalid Query";
            $result['code']     ="401";
        }

        return response()->json($result);
    }
    //
    public function getEventWithFilter($filterData){
        $events = Post::where("country","LIKE","%".$filterData."%")->orWhere("zip_code","LIKE","%".$filterData."%")->orWhere("zip_code","LIKE","%".$filterData."%")->get();

        if(count($events)>0){
            $result['success']  ="true";
            $result['datum']     = $events;
            $result['msg']      ="Data Updated";
            $result['code']     ="200";
        }else{
            $result['success']  ="false";
            $result['data']     ="null";
            $result['msg']      ="Invalid Query";
            $result['code']     ="401";
        }

        return response()->json($result);
    }

    //public function post
} 