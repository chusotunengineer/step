<template>
  <div>
    <div v-for="item in items" :key="item.id">
      <input type="hidden" name="count" :value="item.order" />
      <div class="c-form__row">
        <label :for="'step_' + item.order" class="c-form__label">ステップ{{item.order}}</label>
        <div class="c-form__inputWrap">
          <input
            :id="'step_' + item.order"
            type="text"
            class="c-form__input"
            :name="'name' + item.order"
            :value="item.name"
          />
        </div>
      </div>
      <div class="c-form__row">
        <label :for="'step_' + item.order + '_content'" class="c-form__label">内容</label>
        <div class="c-form__inputWrap">
          <textarea
            :id="'step_' + item.order + '_content'"
            class="c-form__textarea"
            :name="'content' + item.order"
          >{{item.content}}</textarea>
        </div>
      </div>
    </div>
    <button type="submit" class="c-button c-button--wide u-mx_auto u-mt_s">保存</button>
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
  props: {
    parent_id: 0
  },
  methods: {
    // 編集する子ステップ情報をリクエストして、結果をitemsに格納する
    request() {
      axios
        .get("edit/ajax?id=" + this.parent_id)
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
