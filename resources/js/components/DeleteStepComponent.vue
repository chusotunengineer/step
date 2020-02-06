<template>
  <div>
    <div v-if="items.length" class="u-d_flex">
      <div
        class="c-panel"
        v-for="item in items"
        :key="item.id"
        @click="deleteStep(item.id, item.name, item.content)"
      >
        <div class="c-panel__imgWrap">
          <img :src="item.image" alt="step_image" class="c-panel__img" />
        </div>
        <div class="c-panel__content">
          <h4 class="c-panel__title">{{ item.name }}</h4>
          <p class="c-panel__txt" style="white-space: pre-wrap;" v-text="item.content"></p>
        </div>
      </div>
    </div>
    <div v-else>
      <p class="p-mypage__txt">登録されているステップはありません。</p>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      items: []
    };
  },
  methods: {
    // 削除するステップを選択させるために、自分の登録したステップ情報をリクエストして、結果をitemsに格納する
    // 自分の登録したステップ情報なので、マイページ用のコントローラーを使用する
    request() {
      axios
        .get("mypage/my-step")
        .then(res => {
          console.log(res.data);
          let result = res.data;
          this.items = result;
        })
        .catch(error => console.log(error));
    },
    deleteStep(id, name, content) {
      // タイトルと説明文を確認のため表示し、OKが渡ったら削除用ページにリダイレクトする
      let deleteFlg = confirm(
        "タイトル：" +
          name +
          "\n説明：" +
          content +
          "\n\nこちらのステップを削除します。\n本当によろしいですか？"
      );

      if (deleteFlg) {
        location.href = "./delete?id=" + id;
      }
    }
  },
  // DOM作成前にrequestメソッドを実行
  created() {
    this.request();
  }
};
</script>
