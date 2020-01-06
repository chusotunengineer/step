<template>
  <div class="p-index">
    <div class="p-index__search">
      <div class="c-form__row u-pt_0">
        <label for="category_id" class="c-form__label">カテゴリー</label>
        <div class="c-form__inputWrap">
          <select id="category_id" class="c-form__select" name="category_id" v-model="category">
            <option value="0" selected>未選択</option>
            <option value="1">語学</option>
            <option value="2">プログラミング</option>
            <option value="3">デザイン</option>
            <option value="4">創作</option>
            <option value="5">文系資格</option>
            <option value="6">理系資格</option>
            <option value="7">その他</option>
          </select>
        </div>
      </div>
      <div class="c-form__row u-mb_s">
        <label for="category_id" class="c-form__label">表示順</label>
        <div class="c-form__inputWrap">
          <select id="category_id" class="c-form__select" name="category_id" v-model="order">
            <option value="0" selected>登録順</option>
            <option value="1">新着順</option>
          </select>
        </div>
      </div>
      <button @click="request" type="submit" class="c-button u-mx_auto">検索</button>
    </div>
    <div v-if="items.length !== 0 || !Array.isArray(items)" class="p-index__content">
      <a class="c-panel" v-for="item in items" :key="item.id" :href="'steps/?id=' + item.id">
        <div class="c-panel__imgWrap">
          <img :src="item.image" alt="step_image" class="c-panel__img" />
        </div>
        <div class="c-panel__content">
          <h4 class="c-panel__title">{{ item.name }}</h4>
          <p class="c-panel__txt" style="white-space: pre-wrap;" v-text="item.content"></p>
        </div>
      </a>
    </div>
    <div v-else class="p-index__notFound">
      <p>ステップはまだ登録されていません。</p>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      items: [],
      category: 0,
      order: 0
    };
  },
  methods: {
    // ステップ一覧ページに表示するために、指定されたカテゴリーと並び順をGETパラメータで渡して、リクエストする
    request() {
      axios
        .get("index/ajax?category=" + this.category + "&order=" + this.order)
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
