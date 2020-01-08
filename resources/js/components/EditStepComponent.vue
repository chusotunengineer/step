<template>
  <div>
    <div v-if="items.length" class="u-d_flex">
      <a class="c-panel" v-for="item in items" :key="item.id" :href="'edit?id=' + item.id">
        <div class="c-panel__imgWrap">
          <img :src="item.image" alt="step_image" class="c-panel__img" />
        </div>
        <div class="c-panel__content">
          <h4 class="c-panel__title">{{ item.name }}</h4>
          <p class="c-panel__txt" style="white-space: pre-wrap;" v-text="item.content"></p>
        </div>
      </a>
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
    // 編集するステップを選択させるために、自分の登録したステップ情報をリクエストして、結果をitemsに格納する
    // 自分の登録したステップ情報なので、マイページ用のコントローラーを併用する
    request() {
      axios
        .get("mypage/my-step")
        .then(res => {
          console.log(res.data);
          let result = res.data;
          this.items = result;
        })
        .catch(error => console.log(error));
    }
  },
  // DOM作成前にrequestメソッドを実行
  created() {
    this.request();
  }
};
</script>
