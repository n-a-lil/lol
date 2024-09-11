<?php
    namespace App\Http\Controllers;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Http\Request;
    use App\Models\User;
    use App\Models\Notification;
    use App\Models\Friends;
    use App\Models\Image;
    use App\Models\Message;
    use App\Models\User_music;
    use App\Models\Music;
    use App\Models\Post;
    use App\Models\PostComment;
    use App\Models\PostLike;


    class UserController extends Controller
    {
        public function result(Request $request)
        {
            $name = $request->input('name');
            $surname = $request->input('surname');
            $password = $request->input('password');
            $email = $request->input('email');
            $age = $request->input('age');

            $users = User::all();
            $flag = 0;

            foreach ($users as $user) {
                if ($user->name == $name || $user->email == $email) {
                    $flag = 1;
                    break;
                }
            }

            if ($flag == 0) {
                $user = new User();
                $user->name = $name;    
                $user->surname = $surname;          
                $user->password = $password;   
                $user->email = $email;
                $user->age = $age;
                $user->save();

                return redirect('/vkbot')->with('message', 'Registration successful!');
            } else {
                return redirect('/vkbot')->with('error', 'User with the same name or email already exists!');
            }
        }
  
        
        public function form()
        {
            return view('post.form');
        }

        public function result1(Request $request)
        {
            $name = $request->input('name');
            $password = $request->input('password');

            $user = User::where('name', $name)->first(); 

            if ($user && $user->password === $password) {
                session(['user_id' => $user->id]); 
                return redirect('/vk');
            } else {
                return redirect('/vkbot')->with('error', 'Invalid credentials!');
            }
        }

        public function showLoginForm()
        {
            return view('post.layout1');
        }

        public function showRegistrationForm()
        {
            return view('post.layout1');
        }

        public function showMyAccount()
        {
            $userId = session('user_id');

            if ($userId) {
                $user = User::find($userId);
                return view('post.my_account', ['user' => $user]);
            } else {
                return redirect('/vkbot')->with('error', 'Unauthorized access!');
            }
        }

        public function edit(Request $request, $id)
        {
            $user = User::find($id);
            if (!$user) {
                return redirect('/vkbot')->with('error', 'User not found!');
            }

            $user->name = $request->input('name');
            $user->surname = $request->input('surname');
            $user->email = $request->input('email');
            $user->age = $request->input('age');
            $user->save();

            return redirect('/myAccount');
        }

        public function showFriends()
        {
            $userId = session('user_id');

            if ($userId) {
                $user = User::find($userId);
                $friends = $user->friends;

                $users = User::where('id', '!=', $userId)->get();

                foreach ($users as $user) {
                    $user->isFriend = $this->isFriend($user, $friends);
                    $user->friendRequestSent = $this->friendRequestSent($user->id, $userId);
                }

                return view('post.friends', ['users' => $users]);
            } else {
                return redirect('/vkbot');
            }
        }

        private function isFriend($user, $friends)
        {
            foreach ($friends as $friend) {
                if ($friend->id === $user->id) {
                    return true;
                }
            }
            return false;
        }

        private function friendRequestSent($userId, $senderId)
        {
            return Notification::where('user_id', $userId)
                            ->where('sender_id', $senderId)
                            ->exists();
        }


        public function showMyFriends()
        {
            $userId = session('user_id');

            if ($userId) {
                $user = User::find($userId);
                $friends = $user->friends;
                return view('post.my_friends', ['userFriends' => $friends]);
            } else {
                return redirect('/vkbot')->with('error', 'Unauthorized access!');
            }
        }
        
        public function searchFriends(Request $request)
        {
            $search = $request->input('search');

            $users = User::where('name', 'LIKE', "%$search%")
                        ->orWhere('surname', 'LIKE', "%$search%")
                        ->get();

            $userId = session('user_id');
            $currentUser = User::find($userId);
            $friends = $currentUser->friends;

            foreach ($users as $user) {
                $user->isFriend = $this->isFriend($user, $friends);
                $user->friendRequestSent = $this->friendRequestSent($user->id, $userId);
            }

            return view('post.search_friends', ['users' => $users, 'search' => $search]);
        }

        public function searchMyFriends(Request $request)
        {
            $userId = session('user_id');
            $search = $request->input('search');

            if ($userId) {
                $user = User::find($userId);
                $friends = $user->friends()->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%$search%")
                        ->orWhere('surname', 'LIKE', "%$search%");
                })->get();

                return view('post.search_my_friends', ['userFriends' => $friends, 'search' => $search]);
            } 
        }

        public function showNotifications()
        {
            $userId = session('user_id');

            if ($userId) {
                $notifications = Notification::with(['receiver', 'sender'])->where('user_id', $userId)->get();
                return view('post.notifications', ['notifications' => $notifications]);
            } else {
                return redirect('/vkbot')->with('error', 'Unauthorized access!');
            }
        }
        
        public function addFriend($senderId)
        {
            $userId = session('user_id');
        
            Notification::where('sender_id', $senderId)->where('user_id', $userId)->delete();
        
            Friends::create([
                'user_id' => $userId,
                'friend_id' => $senderId,
            ]);
        
            Friends::create([
                'user_id' => $senderId,
                'friend_id' => $userId,
            ]);
        
            return redirect('/myFriends')->with('message', 'Friend request accepted!');
        }


        public function rejectFriend($notificationId)
        {
            Notification::find($notificationId)->delete();

        }
        
        public function addToFriend($userId)
        {
            $senderId = session('user_id');

            Notification::create([
                'user_id' => $userId,
                'sender_id' => $senderId,
            ]);

            return redirect('/myFriends')->with('message', 'Friend request sent!');
        }


        public function showUserProfile($id)
        {
            $user = User::find($id);
            $userId = session('user_id');


            $mainImage = Image::where('user_id', $user->id)
                            ->where('main', 1)
                            ->first();

            $isFriend = false;
            $friendRequestSent = false;

            if ($userId) {
                $friendship = Friends::where('user_id', $userId)
                                    ->where('friend_id', $id)
                                    ->first();

                if ($friendship) {
                    $isFriend = true;
                } else {
                    $friendRequestSent = Notification::where('user_id', $id)
                                                    ->where('sender_id', $userId)
                                                    ->exists();
                }
            }

            return view('post.user_profile', [
                'user' => $user,
                'mainImage' => $mainImage, 
                'isFriend' => $isFriend,
                'friendRequestSent' => $friendRequestSent
            ]);
        }

        public function cancelFriendRequest($userId)
        {
            $senderId = session('user_id');

            Notification::where('user_id', $userId)
                        ->where('sender_id', $senderId)
                        ->delete();

            return redirect('/user/'.$userId)->with('message', 'Friend request cancelled!');
        }

        public function removeFromFriends($friendId)
        {
            $userId = session('user_id');

            Friends::where('user_id', $userId)
                ->where('friend_id', $friendId)
                ->delete();

            Friends::where('user_id', $friendId)
                ->where('friend_id', $userId)
                ->delete();

            return redirect('/myFriends')->with('message', 'Friend removed successfully!');
        }
        
        public function showMessages()
        {
            $userId = session('user_id');
            
            if ($userId) {
                $messages = Message::with(['sender', 'receiver'])
                    ->where('receiver_id', $userId)
                    ->orWhere('sender_id', $userId)
                    ->get();
        
                return view('post.messages', ['messages' => $messages]);
            } else {
                return redirect('/vkbot')->with('error', 'Unauthorized access!');
            }
        }

        public function showDialog(Request $request, $userId)
        {
            $user = User::find($userId); 
        
            $messages = Message::where(function ($query) use ($userId) {
                $query->where('sender_id', session('user_id'))
                    ->where('receiver_id', $userId);
            })->orWhere(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                    ->where('receiver_id', session('user_id'));
            })->get();
        
            return view('post.messageDialog', compact('messages', 'user'));
        }   
        
        public function sendMessage(Request $request, $userId)
        {
            $senderId = session('user_id');
            $text = $request->input('text');

            $message = new Message();
            $message->receiver_id = $userId;
            $message->sender_id = $senderId;
            $message->text = $text;
            $message->save();

            return redirect('/messages');
        }

        public function showMusic()
        {
            $userId = session('user_id');
        
            if ($userId) {
                $userMusic = User_music::where('user_id', $userId)->get();
        
                return view('post.music', ['userMusic' => $userMusic]);
            }
        }     

        public function showAllMusic()
        {
            $Musics = Music::all();
 
            return view('post.allmusic',['Musics' => $Musics]);

        }     

        public function searchAllMusic(Request $request)
        {
            $search = $request->input('search');
        
            $musics = Music::where('music_title', 'LIKE', "%$search%")
                        ->orWhere('music_artist', 'LIKE', "%$search%")
                        ->get();
        
            return view('post.search_music', ['musics' => $musics, 'search' => $search]);
        }
        
        public function searchMyMusic(Request $request)
        {
            $userId = session('user_id');
            $search = $request->input('search');
        
            if ($userId) {
                $userMusics = User_music::where('user_id', $userId)
                                ->where(function ($query) use ($search) {
                                    $query->where('music_title', 'LIKE', "%$search%")
                                        ->orWhere('music_artist', 'LIKE', "%$search%");
                                })
                                ->get();
        
                return view('post.search_my_music', ['userMusics' => $userMusics, 'search' => $search]);
            } 
        }

        public function showPosts()
        {
            $posts = Post::all();
            return view('post.allposts', ['posts' => $posts]);
        }

        public function addPosts()
        {
            return view('post.addposts');
        }

        public function addPost(Request $request)
        {
            $userId = session('user_id');
        
            if ($userId) {
                $post = new Post();
                $post->title = $request->input('title');
                $post->text = $request->input('text');
                $post->image = $request->input('image');
                
                $post->user_id = $userId;
                
        
                $post->save();

                return view('post.addposts');
            }
        }
        public function showPost($id)
        {
            $post = Post::find($id);
            $comments = PostComment::where('post_id', $id)->with('user')->get();
        
            return view('post.posts', ['post' => $post, 'comments' => $comments]);
        }
        
    
        public function likePost(Request $request)
        {
            $postId = $request->input('post_id');
            $userId = session('user_id');
        
            if ($userId) {
                $existingLike = PostLike::where('post_id', $postId)
                                        ->where('user_id', $userId)
                                        ->first();
        
                if ($existingLike) {
                    $existingLike->delete();
                } else {
                    $like = new PostLike();
                    $like->post_id = $postId;
                    $like->user_id = $userId;
                    $like->save();
                }

                $likeCount = Post::find($postId)->likes()->count();
        
                return $likeCount;
            }
        }

        public function addComment(Request $request, $postId)
        {
            $userId = session('user_id');
            $commentText = $request->input('comment_text');

            if ($userId) {
                $comment = new PostComment();
                $comment->post_id = $postId;
                $comment->user_id = $userId;
                $comment->comment_text = $commentText;
                $comment->save();

                return $comment->user->name . ': ' . $comment->comment_text;
            } else {
                return 'Unauthorized access!';
            }
        }
    }
?>