<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use Livewire\Component;

class ChatList extends Component
{
    // Được truyền từ hàm mount của Chat.php
    public $selectedConversation; 
    public $query;  
    // ===end===

    protected $listeners=['refresh'=>'$refresh'];  //Khi có sự thay đổi từ component con thì sẽ refresh lại component cha

    
   public function deleteByUser($id) {

    $userId= auth()->id();
    $conversation= Conversation::find(decrypt($id));




    $conversation->messages()->each(function($message) use($userId){

        if($message->sender_id===$userId){

            $message->update(['sender_deleted_at'=>now()]);
        }
        elseif($message->receiver_id===$userId){

            $message->update(['receiver_deleted_at'=>now()]);
        }


    } );


    $receiverAlsoDeleted =$conversation->messages()
            ->where(function ($query) use($userId){

                $query->where('sender_id',$userId)
                      ->orWhere('receiver_id',$userId);
                   
            })->where(function ($query) use($userId){

                $query->whereNull('sender_deleted_at')
                        ->orWhereNull('receiver_deleted_at');

            })->doesntExist();



    if ($receiverAlsoDeleted) {

        $conversation->forceDelete();
        # code...
    }



    return redirect(route('chat.index'));

    
    
   }



    public function render()
    {

        // Hàm auth() -> user() là hàm laravel dùng để lấy thông tin người dùng đang đăng nhập
        $user = auth()->user(); 

        return view('livewire.chat.chat-list',[
        //Gọi đến hàm conversations() trong User.php   
        'conversations'=>$user->conversations()->latest('updated_at')->get() 
        ]);
    }
}
