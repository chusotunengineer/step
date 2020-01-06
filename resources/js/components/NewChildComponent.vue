<template>
  <div>
    <div v-for="i in count" :key="i">
      <input type="hidden" name="count" :value="i" />
      <div class="c-form__row">
        <label :for="'step_' + i" class="c-form__label">ステップ{{i}}</label>
        <div class="c-form__inputWrap">
          <input :id="'step_' + i" type="text" class="c-form__input" :name="'name' + i" />
        </div>
      </div>
      <div class="c-form__row">
        <label :for="'step_' + i + '_content'" class="c-form__label">内容</label>
        <div class="c-form__inputWrap">
          <textarea :id="'step_' + i + '_content'" class="c-form__textarea" :name="'content' + i"></textarea>
        </div>
      </div>
    </div>
    <div @click="add" class="c-button c-button--wide u-mx_auto u-mt_s">追加</div>
    <button type="submit" class="c-button c-button--wide u-mx_auto u-mt_s">登録</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      errors: [],
      count: 1
    };
  },
  methods: {
    // 追加ボタンが押されたらフォームを追加するために、countを1増やす
    add() {
      this.count++;
    }
  }
};
</script>
