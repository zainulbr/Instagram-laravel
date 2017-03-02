<?php
/**
 
 */

namespace App\Repositories\UserApi;
use App\Friendship;
use Illuminate\Http\Request;

class FriendshipRepository {

    private $request, $friendship;

    public function __construct(Request $request, Friendship $fr) {
        $this->request = $request;
        $this->friendship = $fr;
    }

    public function countFollower($id) {
        return $this->friendship->where('friend_id', $id)->count();
    }

    public function countFollowing($id) {
        return $this->friendship->where('user_id', $id)->count();
    }

    public function follow() {
        $friendId = $this->request->input('friend_id');

        $findResult = $this->friendship->where([
            'user_id' => auth()->user()->id,
            'friend_id' => $friendId
        ])->first();

        if ($findResult == null) {
            $newFollow = new Friendship();
            $newFollow->user_id = auth()->user()->id;
            $newFollow->friend_id = $friendId;

            $newFollow->save();

            $strFollower = ($this->countFollower($friendId) <= 1) ? ' Follower' : ' Followers';

            return [
                'error' => false,
                'message' => 'berhasil follow',
                'follower_count' => $this->countFollower($friendId) . $strFollower,
                'following_count' => $this->countFollowing($friendId) . " Following"
            ];
        } else {
            return [
                'error' => true,
                'message' => 'gagal follow'
            ];
        }
    }

    public function unfollow() {
        $friendId = $this->request->input('friend_id');

        $findResult = $this->friendship->where([
            'user_id' => auth()->user()->id,
            'friend_id' => $friendId
        ])->first();

        if ($findResult != null) {
            $findResult->delete();
            $strFollower = ($this->countFollower($friendId) <= 1) ? ' Follower' : ' Followers';

            return [
                'error' => false,
                'message' => 'berhasil follow',
                'follower_count' => $this->countFollower($friendId) . $strFollower,
                'following_count' => $this->countFollowing($friendId) . " Following"
            ];
        } else {
            return [
                'error' => true,
                'message' => 'gagal unfollow'
            ];
        }
    }

}