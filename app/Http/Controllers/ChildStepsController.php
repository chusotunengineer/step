<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Step;
use App\ChildStep;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;

class ChildStepsController extends Controller
{

    // チャレンジ詳細で子ステップの目次を表示するために、親ステップに紐付いている子ステップをjsonで返す
    public function detailAjax(){
        $id = $_GET['id'];
        $childStep = ChildStep::where('parent_id', $id)->get();
        return $childStep;
    }

    // 子ステップを新規作成するためのviewを返す
    public function new(){
        $id = $_GET['id'];
        $user_id = Auth::id();
        $step = Step::find($id);
        // もし親ステップの作成者IDと現在のユーザーIDが違う場合はマイページにリダイレクトする
        if((int)$step['user_id'] !== $user_id){
            return redirect(route('mypage'));
            exit;
        }
        return view('newChild', compact('id'));
    }

    // リクエストを元に子ステップをDBに保存する
    public function create(Request $request){
        // リクエストを配列に格納して、現在ログインしているユーザーのIDを配列に追加
        $posts = $request->all();
        $user_id = Auth::id();
        $posts += array('user_id' => $user_id);

        $parent_id = $posts['parent_id'];
        $step = Step::find($parent_id);

        // もし親ステップの作成者IDと現在のユーザーIDが違う場合はマイページにリダイレクトする
        if((int)$step['user_id'] !== $user_id){
            return redirect(route('mypage'));
            exit;
        }

        // DBに保存された子ステップの個数を確認するための変数を定義
        $count = 0;
        // リクエストで何個のフォームが作成されたかを確認
        for($i=1; $i<=$posts['count']; $i++){
            $name = 'name'.$i;
            $content = 'content'.$i;
            // フォームが作成されただけで、入力されていなかった場合を除き、1レコードずつDBに保存する
            if(!empty($posts[$name]) && !empty($posts[$content])){
                $record = array('name' => $posts[$name], 'content' => $posts[$content], 'order' => $i, 'parent_id' => $parent_id);
                $childStep = ChildStep::create($record);
                $count++;
            }
        }

        // 親ステップに子ステップの数を保存する
        $step->fill(array('child_num' => $count))->save();

        return redirect(route('mypage'));
    }

    // 子ステップを編集するためのviewを返す
    public function edit(){
        $id = $_GET['id'];
        $user_id = Auth::id();
        $step = Step::find($id);

        // もし親ステップの作成者IDと現在のユーザーIDが違う場合はマイページにリダイレクトする
        if((int)$step['user_id'] !== $user_id){
            return redirect(route('mypage'));
            exit;
        }

        // この親ステップに紐付いた子ステップがあるか確認し、存在しなければ子ステップ新規作成ページにリダイレクト
        $childStep = ChildStep::where('parent_id', $id)->exists();
        if(!$childStep){
            return redirect()->action('ChildStepsController@new', compact('id'));
            exit;
        }

        return view('editChild', compact('id'));
    }

    // 子ステップ編集フォームでDBに保存されているデータを取得するために、DBの子ステップ情報をjsonで返す
    public function editAjax(){
      $childStep = ChildStep::where('parent_id', $_GET['id'])->get();
      return $childStep;
    }

    // リクエストをもとに子ステップの情報を更新する
    public function update(Request $request){
      $posts = $request->all();

      // リクエストで何個のフォームが作成されたかを確認して、その回数レコードを更新する
      for($i=1; $i<=$posts['count']; $i++){
        $childStep = ChildStep::where([['parent_id', $posts['parent_id']],['order', $i]])->first();

        $name = 'name'.$i;
        $content = 'content'.$i;

        $post = array('name' => $posts[$name], 'content' => $posts[$content]);

        $childStep->fill($post)->save();
      }

      return redirect(route('mypage'));
    }
}
