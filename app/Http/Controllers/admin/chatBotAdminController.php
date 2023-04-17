<?php

namespace App\Http\Controllers\admin;

use App\Models\BotMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class chatBotAdminController extends Controller
{
    public function index()
    {
        return view('admin.app');
    }

    public function userShowByIP()
    {
        $data['userListIpes'] = BotMessage::all();
        return view('admin.user-info.user-info-by-ip',$data);
    }

    public function MakeChatShow(Request $request)
    {
        return view('admin.user-info.make_chat');
    }

    public function MakeChatReply(Request $request)
    {
        # code...
    }
}
