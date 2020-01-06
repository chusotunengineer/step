<template>
  <div>
    <div v-if="items.steps == 0">
      <p class="p-mypage__txt">挑戦中のステップはありません。</p>
    </div>
    <div v-else class="u-d_flex">
      <a
        class="c-panel"
        v-for="(step, i) in items.steps"
        :key="step.id"
        :href="'steps/challenge?id=' + step.id"
      >
        <div class="c-panel__imgWrap">
          <img :src="step.image" alt="step_image" class="c-panel__img" />
        </div>
        <div class="c-panel__content">
          <h4 class="c-panel__title">{{ step.name }}</h4>
          <p class="c-panel__txt" style="white-space: pre-wrap;" v-text="step.content"></p>
        </div>
        <span
          class="c-panel__badge"
        >{{ Math.round(items.challenges[i].progress / step.child_num * 100) + '%' }}</span>
      </a>
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
    // 挑戦中のステップ情報をリクエストして、結果をitemsに格納する
    request() {
      axios
        .get("mypage/challenge-step")
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
