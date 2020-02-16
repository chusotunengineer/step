<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Step;
use App\ChildStep;
use App\User;
use App\Category;
use Illuminate\Support\Facades\Auth;

class StepsController extends Controller
{
    // トップページのviewを返す
    public function top(){
        return view('top');
    }

    // 親ステップ一覧のviewとカテゴリテーブルの全レコードを返す
    public function index(){
        $category = Category::all();
        return view('index', compact('category'));
    }

    // 親ステップ一覧の検索結果をjsonで返す
    public function indexAjax(){
        // カテゴリーと並び順がGETで渡ってくるので、変数に格納
        $category = $_GET['category'];
        $order = $_GET['order'];

        // 並び順が指定されていれば変更して、DBを検索
        if($order){
            $steps = Step::orderBy('created_at', 'desc')->get();
        }else{
            $steps = Step::all();
        }

        // カテゴリーが指定されていれば、上の検索結果からさらに絞り込む
        if($category){
            $steps = $steps->where('category_id', $category);
        }

        // 検索結果をjsonして返す
        return $steps;
    }

    // ステップ詳細ページのviewと親子ステップ情報、作成者情報を返す
    public function detail()
    {
        // 親ステップのIDをGETで受け取る
        $id = $_GET['id'];

        // 親ステップのIDを元に子ステップを検索し、子ステップが登録されていなければ一覧ページにリダイレクトする
        $child_step = ChildStep::where('parent_id', $id)->first();
        if(!$child_step){
            return redirect(route('index'));
            exit;
        }

        $step = Step::find($id);
        $author = User::find($step['user_id']);

        return view('detail', compact('step', 'author'));
    }

    // 親ステップ作成ページのviewとカテゴリテーブルの全レコードを返す
    public function new(){
        $category = Category::all();
        return view('new', compact('category'));
    }

    // 自分の登録した親ステップをjsonで返す
    public function myStep(){
        $user_id = Auth::id();
        $mySteps = Step::where('user_id', $user_id)->get();
        return $mySteps;
    }

    // postで送られてきたリクエストをもとに親ステップをDBに保存する
    public function create(Request $request){
        $request->validate([
            'name' => 'required|string|max:30',
            'content' => 'required|string|max:500',
            'time' => 'integer|nullable|max:10000',
            'category_id' => 'required|integer',
            'image' => 'image|max:500',
        ],[
            'name.required'=>'タイトルは入力必須です',
            'name.max'=>'タイトルは30文字以下でご入力ください',
            'time.max'=>'10000時間以下に設定してください',
            'time.integer'=>'数字でご入力ください',
            'content.required'=>'ステップの説明は入力必須です',
            'content.max'=>'ステップの説明は500文字以下でご入力ください',
            'image.image' => '対応している拡張子は「jpg、png、bmp、gif、svg」のみです',
            'uploaded' => '不具合が発生しました。時間をおいて再度お試しください。'
        ]);

        $user_id = Auth::id();

        // イメージ画像とそれ以外を分けて配列に保存
        $post = $request->except('image');
        $image = $request->file('image');

        // イメージ画像が送られていれば画像を保存して、読み込み用にパスを書き換え、DBに保存
        // なければno_imageの画像のパスをDBに保存
        if(file_exists($image)){
            $save_path = $image->store('public');
            $read_path = str_replace('public/', 'storage/', $save_path);
        }else{
            $read_path = asset('img/no_image.png');
        }

        // 上で分けて保存した配列に読み込み用のパスとユーザーIDを追加
        $post += array('image' => $read_path, 'user_id' => $user_id);

        // モデルを使って、DBに登録する値をセット
        $step = Step::create($post);

        $id = $step->id;

        // リダイレクトする
        return redirect()->action('ChildStepsController@new', compact('id'));
    }

    // 編集するステップを選択するviewを返す
    public function choice(){
        return view('choice');
    }

    // 親ステップ編集用のviewとカテゴリーテーブルの全レコードを返す
    public function edit(){
        $id = $_GET['id'];
        $user_id = Auth::id();
        $step = Step::find($id);
        $category = Category::all();

        // GETで取得した親ステップのレコードに保存された作成者IDと、現在ログインしているユーザーのIDが違った場合はマイページにリダイレクトする
        if((int)$step['user_id'] !== $user_id){
            return redirect(route('mypage'));
            exit;
        }
        return view('edit', compact('step', 'id', 'category'));
    }

    // postで送られてきた親ステップの変更リクエストをもとにレコードを更新する
    public function update(Request $request){
        $request->validate([
            'name' => 'required|string|max:30',
            'content' => 'required|string|max:500',
            'time' => 'integer|nullable|max:10000',
            'category_id' => 'required|integer',
            'image' => 'image|max:500',
        ],[
            'name.required'=>'タイトルは入力必須です',
            'name.max'=>'タイトルは30文字以下でご入力ください',
            'time.max'=>'10000時間以下に設定してください',
            'time.integer'=>'数字でご入力ください',
            'content.required'=>'ステップの説明は入力必須です',
            'content.max'=>'ステップの説明は500文字以下でご入力ください',
            'image.image' => '対応している拡張子は「jpg、png、bmp、gif、svg」のみです',
            'uploaded' => '不具合が発生しました。時間をおいて再度お試しください。'
        ]);

        // リクエストを配列に格納して、親ステップのIDを変数に格納
        $post = $request->all();
        $id = $post['id'];

        // もし画像が送られていなければ配列からimageキーを取り除く（レコードがnullで更新されることを防ぐ）
        if(empty($post['image'])){
            unset($post['image']);
        }else{
            $image = $post['image'];
            $save_path = $image->store('public');
            $read_path = str_replace('public/', 'storage/', $save_path);
            $post['image'] = $read_path;
        }

        $step = Step::find($id);
        $step->fill($post)->save();

        return redirect()->action('ChildStepsController@edit', compact('id'));
    }

    // 削除するステップを選択するviewを返す
    public function choiceDelete(){
        return view('choiceDelete');
    }
    // GETで送られた情報をもとに該当ステップを削除する
    public function delete(){
      $id = $_GET['id'];
      $user_id = Auth::id();

      $step = Step::find($id);
      // 現在ログインしているユーザーがステップの作成者かどうか判定
      if((int)$step['user_id'] !== $user_id){
        // 作成者以外なら処理をせずにマイページへリダイレクト
        return redirect(route('mypage'));
        exit;
      }

      // 親ステップを削除
      Step::destroy($id);
      // 子ステップを削除
      childStep::where('parent_id', $id)->delete();

      // マイページへリダイレクト
      return redirect(route('mypage'));
    }
}
