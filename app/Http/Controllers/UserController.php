<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Question;
use App\Models\PostComment;
use Illuminate\Http\Request;
use App\Models\QuestionAnswer;

class UserController extends Controller
{
    public function index() {
        $users = User::get();
        $category = Category::get();
        $posts = Post::orderBy('created_at','desc')->where('status',1)->paginate(3);
        return view('user.index',[
            'posts'=>$posts,
            'category'=>$category,
            'users'=>$users
        ]);
    }
    public function single_post_view($id) {
        // return $id;
        $single_post_view = Post::find($id);
        $comments = PostComment::where('post_id',$id)->paginate(2);
        return view('user.single_post_view',[
            'post'=>$single_post_view,
            'comments'=>$comments
        ]);
    }
    public function filter_by_category($category_id) {
        // return $category_id;
        $filter_by_categories = Category::find($category_id);
        $categories = $filter_by_categories->posts;
        return view('user.filter_by_category',['categories'=>$categories]);
    }
    public function comment_store(Request $request,$id) {
        // return $id;
        $post_comment = new PostComment();
        $post_comment->post_id = $id;
        $post_comment->user_id = auth()->user()->id;
        $post_comment->comment = $request->comment;
        $post_comment->save();
        return redirect()->back()->with('postCommentMsg','Comment Posted');
    }
    public function comment_delete($id) {
        PostComment::find($id)->delete();
        return redirect()->back()->with('commentDeleteMsg','Comment Deleted');
    }
    public function questions() {
        $questions = Question::paginate(2);
        $category = Category::all();
        $QuestionAnswer = QuestionAnswer::all();
        return view('user.question',[
            'category'=>$category,
            'questions'=>$questions,
            'QuestionAnswer'=>$QuestionAnswer
        ]);
    }
    public function questions_store(Request $request) {
        $request->validate([
            'category_id'=> 'required',
            'question'=>'required'
        ]);
        // return $request->all();
        $data = [
            'user_id' => auth()->user()->id,
            'category_id'=>$request->category_id,
            'question'=>$request->question
        ];
        Question::create($data);
        return redirect()->back()->with('questionMsg','Question Added');
    }
    public function question_delete($id) {
        Question::find($id)->delete();
        return redirect()->back()->with('deleteMsg','Deleted Question');
    }
    public function questions_answers($id) {
        $question_answers = QuestionAnswer::paginate(3);
        $question = Question::find($id);
        return view('user.question_answer',[
            'question'=>$question,
            'question_answers'=>$question_answers
        ]);
    }
    public function question_answer_store(Request $request,$id) {
        $request->validate([
            'answer'=>'required'
        ]);
        $answer = new QuestionAnswer();
        $answer->user_id = auth()->user()->id;
        $answer->question_id = $id;
        $answer->answer = $request->answer;
        $answer->save();
        return redirect()->back()->with('answerMsg','Answered Message');
    }
    public function questionanswer_delete($id) {
        QuestionAnswer::find($id)->delete();
        return redirect()->back()->with('questionanswerDelete','Delete question answer');
    }
}
