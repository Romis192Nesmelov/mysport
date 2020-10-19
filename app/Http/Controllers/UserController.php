<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Helper;

class UserController extends StaticController
{
    use HelperTrait;

    protected $directionsFields = [];
    protected $ignoreFields = [];
    protected $executorsIds = [];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.creds');
    }

    public function index()
    {
        return redirect('/profile/user');
    }

//    public function profile(Request $request)
//    {
//        $this->data['user'] = Auth::user();
//        $this->breadcrumbs['profile'] = trans('auth.your_profile');
//        if ($request->has('unsubscribe') && $request->input('unsubscribe')) {
//            $this->data['user']->send_mail = 0;
//            $this->data['user']->save();
//            Session::flash('message',trans('auth.unsubscribe'));
//        }
//        return $this->showView('user');
//    }
  
//    private function sortByUserRating($items)
//    {
//        $collection = collect();
//        foreach ($items as $item) {
//            $collection->push([
//                'item' => $item,
//                'rating' => $item->user->rating
//            ]);
//        }
//        $this->data['items'] = $collection->sortBy('rating')->paginate(10);
//    }

//    public function search(Request $request)
//    {
//        $this->validate($request,['search' => 'required|min:3']);
//        $this->data['search'] = $request->input('search');
//        $this->data['words'] = preg_split('/[\s,\.;]+/', $this->data['search']);
//
//        if (Gate::allows('contracts')) {
//            $this->data['block'] = 'resume';
//            $this->data['item_name'] = 'resume';
//            $this->sortByUserRating($this->searching(new MyResume(), 'skills', 'resumeDirections'));
//        } else {
//            $this->data['block'] = 'contract_cover';
//            $this->data['item_name'] = 'contract';
//            $this->sortByUserRating($this->searching(new Contract(), 'description', 'contractDirections'));
//        }
//        return $this->showView('search');
//    }

//    private function searching(Model $model, $secondField, $dependenceField)
//    {
//        $selected = [];
//        $items = $model->where('status',2)->get();
//        foreach ($items as $item) {
//            $match = false;
//            foreach ($this->data['words'] as $word) {
//                if (
//                    preg_match('/'.$word.'/ui',$item->name) ||
//                    preg_match('/'.$word.'/ui',$item[$secondField])
//                ){
//                    $selected[] = $item;
//                    $match = true;
//                    break;
//                }
//            }
//
//            if (!$match) {
//                foreach ($this->data['words'] as $word) {
//                    foreach ($item[$dependenceField] as $field) {
//                        if (
//                            preg_match('/'.$word.'/ui',$field->direction->name_en) ||
//                            preg_match('/'.$word.'/ui',$field->direction->name_ru)
//                        ){
//                            $selected[] = $item;
//                            $match = true;
//                            break;
//                        }
//                    }
//                    if ($match) break;
//                }
//            }
//        }
//        return $selected;
//    }

//    public function deleteProfile()
//    {
//        $user = Auth::user();
//        $user->active = 0;
//        $user->save();
//        Auth::logout();
//        return redirect('/')->with('message', trans('auth.account_has_been_deleted'));
//    }

//    private function deleteItem(Request $request, Model $model, $contractCondition, $dependenceFieldId, $parent=null)
//    {
//        $this->validate($request, ['id' => 'required|integer|exists:'.$model->getTable().',id']);
//        $item = $model->find($request->input('id'));
//        if ( (!$contractCondition || $item->status != 4) && (!$parent ? Gate::denies('is_owner',$item) : Gate::denies('is_owner', $item[$parent]) ) ) abort(403);
//        $item->status = 4;
//        $item->save();
//        $this->dampingMessages($item->id, $dependenceFieldId);
//        return response()->json(['success' => true]);
//    }
}
