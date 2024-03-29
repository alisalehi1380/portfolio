<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Post\Requests\CreatePostRequest;
use App\Http\Controllers\Post\Requests\DeletePostRequest;
use App\Http\Controllers\Post\Requests\ShowCommentsPostRequest;
use App\Http\Controllers\Writer\Requests\UpdateWriterPostRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;

class WriterController extends Controller
{
    public function newPost()
    {
        $categories = Category::all();
        return view('writer.create', compact('categories'));
    }
    
    public function storePost(CreatePostRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $tags = $request->tags;
            $tag_ids = [];
            foreach ($tags as $tag) {
                $tag_ids[] = Tag::query()->where(Tag::SLUG, SLUG($tag))->orWhere(Tag::TITLE, $tag)
                    ->firstOrCreate([
                        Tag::SLUG  => SLUG($tag),
                        Tag::TITLE => $tag
                    ]);
            }
            
            $cats = $request->categories;
            $cat_ids = [];
            foreach ($cats as $cat) {
                $cat_ids[] = Category::query()->findOrFail($cat);
            }
            
            $post = Post::query()->create([
                Post::WRITER_ID => Auth::id(),
                Post::TITLE     => $request->title,
                Post::SLUG      => SLUG(rand(0, 3) . $request->title),
                Post::COVER     => $request->cover,
                Post::BODY      => $request->body,
            ]);
            
            $post->categories()->saveMany($cat_ids);
            $post->tags()->saveMany($tag_ids);
            
            DB::commit();
            
            return redirect()->route('new.post.writer')->with('msg', 'New Post Created Successfully');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect()->route('new.post.writer')->with('msg', 'Fail To create New Post . Try again');
        }
    }
    
    public function showPostsList()
    {
        //TODO : complete me=> writer can see just its posts
        $posts = Post::query()->where(Post::WRITER_ID, Auth::id())->paginate(5);
        
        return view('writer.list', compact('posts'));
    }
    
    public function editWriterPost(Requests\EditPostRequest $request, Post $post)
    {
        $categories = Category::all();
        //TODO create request(policy) writer just can edit its posts
        return view('writer.editpost', compact('post', 'categories'));
    }
    
    public function updateWriterPost(UpdateWriterPostRequest $request, Post $post)
    {
        try {
            DB::beginTransaction();
            $post->update($request->only(['title', 'slug', 'cover', 'body']));
            $cat_id_sync = [];
            $post->categories()->sync($request->categories);
            
            //ذخیره آی دی تگ ها و در نهایت سینک کردن آی دی های موجود در این آرایه
            $tag_ids = [];
            
            //برای تگ ابتدا چک میکنیم که تگ ها در جدل تگ وجود داره یا نه
            //اگه وجود نداشت یک تگ جدید در جدول تگ ایجاد میشه
            //اگه وجود داشت فقط id اون تگ رو از جدول تگ رو در ارایه ذخیره میکنیم
            foreach ($request->tags as $tag) {
                
                $is_tag_exist = Tag::query()->where('title', $tag)->orWhere('slug', SLUG($request->slug))->get();
                if ($is_tag_exist->count() === 0) {
                    $tag_id = Tag::query()->create([
                        Tag::TITLE => $tag,
                        Tag::SLUG  => SLUG($tag)
                    ]);
                    
                    //ذخیره آی دی تگ جدید ذخیره شده در جدول تگ به صورت کی ولیو
                    $tag_ids[$tag_id->id] = $tag_id->id;
                    
                } else {
                    //tag was exist in tags table
                    //ذخیره آی دی تگ موجود در جدول تگ به صورت کی ولیو
                    $tag_ids[$is_tag_exist[0]['id']] = $is_tag_exist[0]['id'];
                }
            }
            $post->tags()->sync($tag_ids);
            
            DB::commit();
            return redirect(route('list.post.writer'))->with('update-succ', 'post Updated Successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect(route('list.post.writer'))->with('update-fail', 'Oops,we can not update the post,try a gain later');
        }
    }
    
    public function deletePost(DeletePostRequest $request, Post $post)
    {
        try {
            DB::beginTransaction();
            $post->tags()->detach();
            $post->categories()->detach();
            $post->delete();
            DB::commit();
            return redirect(route('list.post.writer'))->with('delete-succ', 'Post Deleted SuccessFully');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }
    
    public function showPostComments(ShowCommentsPostRequest $request, Post $post)
    {
        $post = Post::with('comments.user')->where('id', $post->id)->get()->toArray();
        return view('writer.commentlist', compact('post'));
    }
    
    public function changeStateComment(Comment $comment)
    {
        $comment->update([
            Comment::SHOW => $comment->show ? false : true
        ]);
        return redirect()->back()->with('state', 'comment show state changed');
    }
    
    public function getWriterPosts(User $user)
    {
        if (!$user->type === User::WRITER){ abort(404); };
        $posts = $user->posts()->paginate(2);
        
        return view('postlist', compact('user', 'posts'));
    }
}

