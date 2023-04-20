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
        $data['userListIpes'] = BotMessage::select('id','user_ip_adress','user_message')->paginate('3');
        return view('admin.user_info.user_info',$data);
    }

    public function deleteUserInfo($id)
    {
        $botMessage = BotMessage::find($id);

        if ($botMessage) {
            $botMessage->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Bot Message Delete Successfully'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Bot Message Id Not Found'
            ]);
        }
        

    }

    // pagination
    public function pagination()
    {
        $data['userListIpes'] = BotMessage::select('id','user_ip_adress','user_message')->paginate('3');
        return view('admin.user_info.pagination',$data);
    }


}
