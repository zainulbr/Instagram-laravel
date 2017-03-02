<?php


namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller {

    private $user, $message;

    public function __construct(User $user, Message $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    private function getLastMessage($data)
    {
        return $this->message
            ->where([
                'sender_id' => auth()->user()->id,
                'recipient_id' => $data
            ])
            ->orWhere([
                'sender_id' => $data,
                'recipient_id' => auth()->user()->id
            ])
            ->orderBy('id', 'desc')
            ->first();
    }

    public function index()
    {

        $lists = $this->message
            ->where('sender_id', auth()->user()->id)
            ->orWhere('recipient_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->groupBy(['recipient_id', 'sender_id'])
            ->get();

        $data = $lists->map(function($d){
            if($d->recipient->id == auth()->user()->id){
                $message = $this->getLastMessage($d->sender->id);
                return [
                    'message_id' => $message->id,
                    'message' => $message->message,
                    'username' => $d->sender->username,
                    'id' => $d->sender->id,
                    'full_name' => $d->sender->full_name,
                    'created_at' => $message->created_at(),
                    'avatar' => $d->sender->avatar
                ];
            }
            if ($d->sender->id == auth()->user()->id){
                $message = $this->getLastMessage($d->recipient->id);
                return [
                    'message_id' => $message->id,
                    'message' => $message->message,
                    'username' => $d->recipient->username,
                    'id' => $d->recipient->id,
                    'full_name' => $d->recipient->full_name,
                    'created_at' => $message->created_at(),
                    'avatar' => $d->recipient->avatar
                ];
            }
        });

        $data = $data->unique('username');
        return View('user/message', ['messages' => $data->sortByDesc('message_id')]);
    }

    public function conversation($id)
    {
        $cek = $this->user->find($id);
        if(!$cek || auth()->user()->id == $id) return redirect()->route('user-home');

        $result = $this->message->where([
            'sender_id' => auth()->user()->id,
            'recipient_id' => $cek->id
        ])->orWhere([
            'sender_id' => $cek->id,
            'recipient_id' => auth()->user()->id
        ])->get();

        $message = $result->map(function($m) {
            return [
                'id' => $m->id,
                'sender_id' => $m->sender->id,
                'sender_name' => $m->sender->full_name,
                'sender_username' => $m->sender->username,
                'recipient_id' => $m->recipient->id,
                'recipient_username' => $m->recipient->username,
                'recipient_name' => $m->recipient->full_name,
                'message' => $m->message,
                'created_at' => $m->created_at()
            ];
        });
        
        return View('user/conversation', ['messages' => $message, 'user' => $cek] );
    }

    public function conversationSave(Request $request, $id)
    {
        $this->message->create([
            'sender_id' => auth()->user()->id,
            'recipient_id' => $id,
            'message' => $request->input('message')
        ]);

        return redirect()->route('user-conversation', ['id' => $id]);
    }
}