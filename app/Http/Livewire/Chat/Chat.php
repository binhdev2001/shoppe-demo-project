<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use Livewire\Component;

class Chat extends Component
{

    public $query; //Truyền vào ID của cuộc trò chuyện để truy vấn 
    public $selectedConversation; //Chứa thông tin cuộc trò chuyện được chọn

    // Hàm mount giống như hàm constructor, nó sẽ chạy ngay khi component được khởi tạo
    public function mount()
    {
        //Lấy thông tin cuộc trò chuyện được chọn
        $this->selectedConversation= Conversation::findOrFail($this->query); 
       /// dd($selectedConversation);


       #Check xem người dùng đã xem tin nhắn chưa
       Message::where('conversation_id',$this->selectedConversation->id)
                ->where('receiver_id',auth()->id())
                ->whereNull('read_at')
                ->update(['read_at'=>now()]);

    }


    public function render()
    {
        return view('livewire.chat.chat');
    }
}
