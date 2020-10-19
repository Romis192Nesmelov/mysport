<?php

namespace App\Http\Controllers;

//use App\Http\Requests;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Settings;
use Illuminate\Support\Facades\Helper;

class AdminController extends UserController
{
    use HelperTrait;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth.admin');
    }

    public function index()
    {
        return redirect('/admin/users');
    }

//    public function seo()
//    {
//        $this->breadcrumbs = ['seo' => 'SEO'];
//        $this->data['metas'] = $this->metas;
//        $this->data['seo'] = Settings::getSeoTags();
//        return $this->showView('seo');
//    }

//    public function users(Request $request, $slug=null)
//    {
//        $this->breadcrumbs = ['users' => trans('admin.users')];
//        if ($request->has('id')) {
//            $this->data['user'] = User::find($request->input('id'));
//            if (!$this->data['user']) abort(404);
//            $this->breadcrumbs['users?id='.$this->data['user']->id] = $this->data['user']->nick ? $this->data['user']->nick : $this->data['user']->email;
//            return $this->showView('user');
//        } else if ($slug && $slug == 'add') {
//            $this->breadcrumbs['users/add'] = trans('admin.adding_user');
//            return $this->showView('user');
//        } else {
//            $this->data['users'] = User::orderBy('id','desc')->get();
//            return $this->showView('users');
//        }
//    }

//    public function tickets(Request $request)
//    {
//        $this->breadcrumbs = ['tickets' => trans('content.tickets')];
//        if ($request->has('id')) {
//            $this->validate($request, ['id' => 'required|integer|exists:tickets']);
//            $this->data['ticket'] = Ticket::find($request->input('id'));
//            $this->data['ticket']->save();
//            $this->breadcrumbs['tickets?id='.$request->input('id')] = $this->data['ticket']->head;
//            $this->dampingMessages($request->input('id'), 'ticket_id');
//            return $this->showView('ticket');
//        } else {
//            $this->data['tickets'] = Ticket::orderBy('id','desc')->get();;
//            return $this->showView('tickets');
//        }
//    }
 
//    public function settings()
//    {
//        $this->breadcrumbs = ['settings' => trans('admin.settings')];
//        return $this->showView('settings');
//    }

//    public function editSeo(Request $request)
//    {
//        $this->validate($request, [
//            'title_en' => 'required|regex:/^((\w+)\s(\w+))$/',
//            'title_ru' => 'required|regex:/^((\w+)\s(\w+))$/ui',
//            'meta_description' => 'max:4000',
//            'meta_keywords' => 'max:4000',
//            'meta_twitter_card' => 'max:255',
//            'meta_twitter_size' => 'max:255',
//            'meta_twitter_creator' => 'max:255',
//            'meta_og_url' => 'max:255',
//            'meta_og_type' => 'max:255',
//            'meta_og_title' => 'max:255',
//            'meta_og_description' => 'max:4000',
//            'meta_og_image' => 'max:255',
//            'meta_robots' => 'max:255',
//            'meta_googlebot' => 'max:255',
//            'meta_google_site_verification' => 'max:255',
//        ]);
//        Settings::saveSeoTags($request);
//        return redirect('/admin/seo')->with('message',trans('content.save_complete'));
//    }

//    public function editSettings(Request $request)
//    {
//        $this->validate($request, [
//            'email' => 'required|email'
//        ]);
//        Settings::saveSettings($this->processingFields($request));
//        return redirect()->back()->with('message',trans('content.save_complete'));
//    }
    
//    public function editUser(Request $request)
//    {
//        $validationArr = [
//            'email' => 'required|email|unique:users,email',
//            'phone' => $this->validationPhone,
//            'type' => 'required|integer|min:1|max:3',
//            'avatar' => $this->validationImage,
//            'document' => $this->validationImage
//        ];
//
//        $validationArr = array_merge($validationArr,$this->requisites);
//
//        $fields = $this->processingFields($request, ['active','confirmed','send_mail'], ['avatar','password','password_confirmation']);
//        if ($request->has('password') && $request->input('password')) $fields['password'] = bcrypt($request->input('password'));
//
//        if ($request->has('id')) {
//            $validationArr['id'] = $this->validationUser;
//            $validationArr['email'] .= ','.$request->input('id');
//
//            if ($request->input('password')) {
//                $validationArr['old_password'] = 'required|min:8|max:50';
//                $validationArr['password'] = $this->validationPassword;
//            } else unset($fields['password']);
//
//            $this->validate($request, $validationArr);
//            $user = User::find($request->input('id'));
//            
//            if (!$user->confirmed && $fields['confirmed']) $fields['rating'] += 30;
//            
//            $user->update($fields);
//        } else {
//            $validationArr['password'] = $this->validationPassword;
//            $this->validate($request, $validationArr);
//
//            if ($fields['confirmed']) $fields['rating'] += 30;
//            
//            $user = User::create($fields);
//        }
//
//        if ($request->hasFile('avatar')) {
//            $fields = $this->processingImage($request, $user, 'avatar', 'avatar'.$user->id, 'images/avatars');
//            $user->update($fields);
//        }
//
//        if ($request->hasFile('document')) {
//            $fields = $this->processingImage($request, $user, 'document', 'document'.$user->id, 'images/documents');
//            $user->update($fields);
//        }
//        
//        return redirect('/admin/users')->with('message',trans('content.save_complete'));
//    }
    
//    public function editTicket(Request $request)
//    {
//        $this->validate($request, [
//            'id' => 'required|integer|exists:tickets,id',
//            'status' => 'min:0|max:1'
//        ]);
//        $fields = $this->processingFields($request);
//        $ticket = Ticket::find($request->input('id'));
//
//        if ($fields['status'] == 1 && !$ticket->status && $ticket->user->email && $ticket->user->send_mail) {
//            $this->userNotice(
//                $ticket->user->email,
//                'profile/tickets?id='.$ticket->id,
//                'ticket_id',
//                $ticket->id,
//                'Contact Technical Support #'.Helper::ticketNumber($ticket).', has been closed',
//                'Обращение в службу технической поддержики №'.Helper::ticketNumber($ticket).' было закрыто'
//            );
//        }
//        
//        $ticket->update($fields);
//        return redirect('/admin/tickets')->with('message',trans('content.save_complete'));
//    }

//    public function deleteUser(Request $request)
//    {
//        $this->validate($request, ['id' => 'required|integer|exists:users,id']);
//        $user = User::find($request->input('id'));
//        if (count($user->myResumes)) {
//            foreach ($user->myResumes as $resume) {
//                $this->deleteItemResume($resume);
//            }
//        }
//        if ($user->avatar) $this->unlinkFile($user, 'avatar');
//        return response()->json(['success' => true]);
//    }
    
//    public function showView($view)
//    {
//        $submenuChapters = [];
//        $this->data['chapters'] = Chapter::all();
//        foreach ($this->data['chapters'] as $chapter) {
//            $submenuChapters[] = ['href' => '?id='.$chapter->id,'name' => $chapter['head_'.App::getLocale()]];
//        }
//
//        $menus = [
//            ['href' => 'seo', 'name' => 'SEO', 'icon' => 'icon-price-tags'],
//            ['href' => 'settings', 'name' => trans('admin.settings'), 'icon' => 'icon-gear'],
//            ['href' => 'requisites', 'name' => trans('admin.requisites'), 'icon' => 'icon-stamp'],
//            ['href' => 'users', 'name' => trans('admin.users'), 'icon' => 'icon-users'],
//            ['href' => 'resumes', 'name' => trans('content.resumes'), 'icon' => 'icon-magazine'],
//            ['href' => 'chapters', 'name' => trans('admin.chapters'), 'icon' => 'icon-files-empty2', 'submenu' => $submenuChapters],
//            ['href' => 'questions', 'name' => trans('content.faq'), 'icon' => 'icon-question4'],
//            ['href' => 'directions', 'name' => trans('admin.directions'), 'icon' => 'icon-direction'],
//            ['href' => 'contracts', 'name' => trans('content.contracts'), 'icon' => 'icon-certificate'],
//            ['href' => 'tickets', 'name' => trans('content.tickets'), 'icon' => 'icon-ticket'],
//            ['href' => 'messages', 'name' => trans('admin.messages'), 'icon' => 'icon-bubbles4'],
//        ];
//
//        return view('admin.'.$view, [
//            'breadcrumbs' => $this->breadcrumbs,
//            'data' => $this->data,
//            'menus' => $menus,
//            'messages' => Message::where('for_admin',1)->where('status',0)->orderBy('id','desc')->get(),
//            'adminMode' => $this->adminMode,
//            'urlPrefix' => $this->urlPrefix
//        ]);
//    }
    
    
//    public function deleteSomething(Request $request, Model $model, $files=null)
//    {
//        $this->validate($request, ['id' => 'required|integer|exists:'.$model->getTable().',id']);
//        $item = $model->find($request->input('id'));
//
//        if ($files) {
//            if (is_array($files)) {
//                foreach ($files as $file) {
//                    $this->unlinkFile($item, $file);
//                }
//            } else $this->unlinkFile($item, $files);
//        }
//        $item->delete();
//
//        return response()->json(['success' => true]);
//    }
}